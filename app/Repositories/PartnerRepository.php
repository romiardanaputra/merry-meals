<?php

namespace App\Repositories;

use App\Interfaces\PartnerRepositoryInterface;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection;

class PartnerRepository implements PartnerRepositoryInterface
{
    public function __construct(protected Partner $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Partner
    {
        return $this->model->find($id);
    }

    public function create(array $data): Partner
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $partner = $this->find($id);
        return $partner ? $partner->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $partner = $this->find($id);
        return $partner ? $partner->delete() : false;
    }

    public function findByUserId(int $userId): ?Partner
    {
        return $this->model->where('userID', $userId)->first();
    }

    public function getByFoodType(string $foodType): Collection
    {
        return $this->model->where('foodType', $foodType)->get();
    }
}
