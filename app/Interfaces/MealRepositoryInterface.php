<?php

namespace App\Interfaces;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Collection;

interface MealRepositoryInterface
{
    /**
     * Get all meals
     */
    public function all(): Collection;

    /**
     * Find meal by ID
     */
    public function find(int $id): ?Meal;

    /**
     * Create new meal
     */
    public function create(array $data): Meal;

    /**
     * Update meal
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete meal
     */
    public function delete(int $id): bool;

    /**
     * Get meals by partner ID
     */
    public function getByPartner(int $partnerId): Collection;

    /**
     * Get available meals
     */
    public function getAvailableMeals(): Collection;

    /**
     * Get meals by type
     */
    public function getByType(string $type): Collection;
}
