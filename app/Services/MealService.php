<?php

namespace App\Services;

use App\Interfaces\MealRepositoryInterface;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Collection;

class MealService
{
    public function __construct(
        protected MealRepositoryInterface $mealRepository
    ) {}

    /**
     * Get all meals
     */
    public function getAllMeals(): Collection
    {
        return $this->mealRepository->all();
    }

    /**
     * Get meal by ID
     */
    public function getMealById(int $id): ?Meal
    {
        return $this->mealRepository->find($id);
    }

    /**
     * Create new meal
     */
    public function createMeal(array $data): Meal
    {
        return $this->mealRepository->create($data);
    }

    /**
     * Update meal
     */
    public function updateMeal(int $id, array $data): bool
    {
        return $this->mealRepository->update($id, $data);
    }

    /**
     * Delete meal
     */
    public function deleteMeal(int $id): bool
    {
        return $this->mealRepository->delete($id);
    }

    /**
     * Get meals by partner
     */
    public function getMealsByPartner(int $partnerId): Collection
    {
        return $this->mealRepository->getByPartner($partnerId);
    }

    /**
     * Get available meals for ordering
     */
    public function getAvailableMeals(): Collection
    {
        return $this->mealRepository->getAvailableMeals();
    }

    /**
     * Toggle meal availability
     */
    public function toggleAvailability(int $id): bool
    {
        $meal = $this->mealRepository->find($id);
        if (! $meal) {
            return false;
        }

        return $this->mealRepository->update($id, [
            'mealAvailability' => ! $meal->mealAvailability,
        ]);
    }
}
