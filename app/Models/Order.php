<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected static $validTransitions = [
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
        if (!$this->canTransitionTo($newStatus)) {
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

    /**
     * Get status label for display
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
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
        return match($this->status) {
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

    // Relationships
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

    protected $fillable = [
        'userID',
        'partnerID',
        'mealID',
        'volunteerID',
        'mealPackage',
        'range',
        'foodTemperature',
        'status',
        // Delivery tracking fields
        'pickupTime',
        'deliveryTime',
        'pickupTemperature',
        'deliveryTemperature',
    ];

    protected $casts = [
        'pickupTime' => 'datetime',
        'deliveryTime' => 'datetime',
    ];

    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'statusLabel',
        'statusColor',
    ];
}
