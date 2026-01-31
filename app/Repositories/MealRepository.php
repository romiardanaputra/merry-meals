<?php

namespace App\Repositories;

use App\Interfaces\MealRepositoryInterface;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Collection;

class MealRepository implements MealRepositoryInterface
{
    public function __construct(protected Meal $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Meal
    {
        return $this->model->find($id);
    }

    public function create(array $data): Meal
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $meal = $this->find($id);
        return $meal ? $meal->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $meal = $this->find($id);
        return $meal ? $meal->delete() : false;
    }

    public function getByPartner(int $partnerId): Collection
    {
        return $this->model->where('partnerID', $partnerId)->get();
    }

    public function getAvailableMeals(): Collection
    {
        return $this->model->where('mealAvailability', true)->get();
    }

    public function getByType(string $type): Collection
    {
        return $this->model->where('mealType', $type)->get();
    }
}
