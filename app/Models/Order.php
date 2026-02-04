<?php

namespace App\Models;

use App\Services\DashboardCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Order Model
 * Represents meal delivery orders with state machine transitions
 */
class Order extends Model
{
    use HasFactory;

    /**
     * Order Status Constants
     * Based on DELIVERY_FLOW.md specifications
     */
    const STATUS_PENDING = 'pending';

    const STATUS_PREPARATION = 'preparation';

    const STATUS_READY = 'ready_for_pickup';

    const STATUS_ASSIGNED = 'assigned';

    const STATUS_PICKED_UP = 'picked_up';

    const STATUS_IN_TRANSIT = 'in_transit';

    const STATUS_DELIVERED = 'delivered';

    const STATUS_CANCELLED = 'cancelled';

    /**
     * Valid status transitions map
     */
    protected static array $validTransitions = [
        self::STATUS_PENDING => [self::STATUS_PREPARATION, self::STATUS_CANCELLED],
        self::STATUS_PREPARATION => [self::STATUS_READY, self::STATUS_CANCELLED],
        self::STATUS_READY => [self::STATUS_ASSIGNED],
        self::STATUS_ASSIGNED => [self::STATUS_PICKED_UP, self::STATUS_ASSIGNED], // reassign allowed
        self::STATUS_PICKED_UP => [self::STATUS_IN_TRANSIT],
        self::STATUS_IN_TRANSIT => [self::STATUS_DELIVERED],
        self::STATUS_DELIVERED => [], // final state
        self::STATUS_CANCELLED => [], // final state
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'userID',
        'partnerID',
        'mealID',
        'volunteerID',
        'mealPackage',
        'range',
        'foodTemperature',
        'status',
        'deliveryNotes',
        'pickupTime',
        'deliveryTime',
        'pickupTemperature',
        'deliveryTemperature',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'pickupTime' => 'datetime',
        'deliveryTime' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'statusLabel',
        'statusColor',
        'statusMeta',
    ];

    /**
     * Get comprehensive status metadata for UI
     */
    public function getStatusMetaAttribute(): array
    {
        return match ($this->status) {
            self::STATUS_PENDING => [
                'bg' => 'bg-yellow-500/10',
                'text' => 'text-yellow-600',
                'label' => 'Processing',
                'description' => 'Awaiting kitchen preparation',
            ],
            self::STATUS_PREPARATION => [
                'bg' => 'bg-blue-500/10',
                'text' => 'text-blue-600',
                'label' => 'Preparing',
                'description' => 'Chefs are crafting your meal',
            ],
            self::STATUS_READY => [
                'bg' => 'bg-indigo-500/10',
                'text' => 'text-indigo-600',
                'label' => 'Ready',
                'description' => 'Waiting for driver pickup',
            ],
            self::STATUS_ASSIGNED => [
                'bg' => 'bg-primary/10',
                'text' => 'text-primary',
                'label' => 'Out for Delivery',
                'description' => 'Driver has been assigned',
            ],
            self::STATUS_PICKED_UP, self::STATUS_IN_TRANSIT => [
                'bg' => 'bg-purple-500/10',
                'text' => 'text-purple-600',
                'label' => 'In Transit',
                'description' => 'Meal is on the way',
            ],
            self::STATUS_DELIVERED => [
                'bg' => 'bg-green-500/10',
                'text' => 'text-green-600',
                'label' => 'Success',
                'description' => 'Meal safely delivered',
            ],
            self::STATUS_CANCELLED => [
                'bg' => 'bg-red-500/10',
                'text' => 'text-red-600',
                'label' => 'Cancelled',
                'description' => 'Order could not be fulfilled',
            ],
            default => [
                'bg' => 'bg-dark/5',
                'text' => 'text-dark/40',
                'label' => str_replace('_', ' ', $this->status),
                'description' => 'Status unknown',
            ],
        };
    }

    /**
     * Boot the model and register event listeners
     */
    protected static function booted(): void
    {
        // Clear related caches when order is created/updated/deleted
        static::saved(function (Order $order) {
            app(DashboardCacheService::class)->clearOrderRelatedCaches($order);
        });

        static::deleted(function (Order $order) {
            app(DashboardCacheService::class)->clearOrderRelatedCaches($order);
        });
    }

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'mealID', 'id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partnerID', 'id');
    }

    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteerID', 'id');
    }

    // ==========================================
    // LOCAL SCOPES
    // ==========================================

    /**
     * Scope: Active orders (assigned, picked_up, in_transit)
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [
            self::STATUS_ASSIGNED,
            self::STATUS_PICKED_UP,
            self::STATUS_IN_TRANSIT,
        ]);
    }

    /**
     * Scope: Orders for a specific driver
     */
    public function scopeForDriver(Builder $query, int $driverId): Builder
    {
        return $query->where('volunteerID', $driverId);
    }

    /**
     * Scope: Orders for a specific partner
     */
    public function scopeForPartner(Builder $query, int $partnerId): Builder
    {
        return $query->where('partnerID', $partnerId);
    }

    /**
     * Scope: Orders for a specific user
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('userID', $userId);
    }

    /**
     * Scope: Orders created today
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope: Orders with specific status
     */
    public function scopeWithStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Delivered orders
     */
    public function scopeDelivered(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_DELIVERED);
    }

    /**
     * Scope: Pending orders
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // ==========================================
    // STATE MACHINE METHODS
    // ==========================================

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PREPARATION,
            self::STATUS_READY,
            self::STATUS_ASSIGNED,
            self::STATUS_PICKED_UP,
            self::STATUS_IN_TRANSIT,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * Check if transition to new status is valid
     */
    public function canTransitionTo(string $newStatus): bool
    {
        $currentStatus = $this->status ?? self::STATUS_PENDING;
        $allowedTransitions = self::$validTransitions[$currentStatus] ?? [];

        return in_array($newStatus, $allowedTransitions);
    }

    /**
     * Transition to new status with validation
     */
    public function transitionTo(string $newStatus): bool
    {
        if (! $this->canTransitionTo($newStatus)) {
            return false;
        }

        $this->status = $newStatus;

        // Set timestamps for tracking
        if ($newStatus === self::STATUS_PICKED_UP) {
            $this->pickupTime = now();
        } elseif ($newStatus === self::STATUS_DELIVERED) {
            $this->deliveryTime = now();
        }

        return $this->save();
    }

    /**
     * Check if order is in final state
     */
    public function isFinalState(): bool
    {
        return in_array($this->status, [self::STATUS_DELIVERED, self::STATUS_CANCELLED]);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Get status label for display
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PREPARATION => 'In Preparation',
            self::STATUS_READY => 'Ready for Pickup',
            self::STATUS_ASSIGNED => 'Driver Assigned',
            self::STATUS_PICKED_UP => 'Picked Up',
            self::STATUS_IN_TRANSIT => 'In Transit',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CANCELLED => 'Cancelled',
            default => 'Unknown'
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'gray',
            self::STATUS_PREPARATION => 'amber',
            self::STATUS_READY => 'blue',
            self::STATUS_ASSIGNED => 'indigo',
            self::STATUS_PICKED_UP => 'purple',
            self::STATUS_IN_TRANSIT => 'orange',
            self::STATUS_DELIVERED => 'green',
            self::STATUS_CANCELLED => 'red',
            default => 'gray'
        };
    }
}
