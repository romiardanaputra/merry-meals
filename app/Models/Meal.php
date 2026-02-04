<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Meal Model
 * Represents meals offered by partners
 */
class Meal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'partnerID',
        'mealName',
        'mealIngredient',
        'mealImage',
        'mealType',
        'mealAvailability',
        'mealDescription',
        'calories',
        'protein',
        'carbs',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    /**
     * Get the partner that owns this meal
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partnerID', 'id');
    }

    /**
     * Get all orders for this meal
     * Fixed: hasOne -> hasMany (a meal can have multiple orders)
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'mealID', 'id');
    }

    // ==========================================
    // LOCAL SCOPES
    // ==========================================

    /**
     * Scope: Available meals only
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('mealAvailability', 'available');
    }

    /**
     * Scope: Meals by partner
     */
    public function scopeForPartner(Builder $query, int $partnerId): Builder
    {
        return $query->where('partnerID', $partnerId);
    }

    /**
     * Scope: Meals by type
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('mealType', $type);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Check if meal is available
     */
    public function getIsAvailableAttribute(): bool
    {
        return strtolower($this->mealAvailability) === 'available';
    }

    /**
     * Get full image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->mealImage) {
            return null;
        }

        if (str_starts_with($this->mealImage, 'http')) {
            return $this->mealImage;
        }

        return asset('storage/'.$this->mealImage);
    }
}
