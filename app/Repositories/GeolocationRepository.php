<?php

namespace App\Repositories;

use App\Interfaces\GeolocationRepositoryInterface;
use App\Models\Geolocation;
use Illuminate\Database\Eloquent\Collection;

class GeolocationRepository implements GeolocationRepositoryInterface
{
    public function __construct(protected Geolocation $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Geolocation
    {
        return $this->model->find($id);
    }

    public function create(array $data): Geolocation
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $geolocation = $this->find($id);
        return $geolocation ? $geolocation->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $geolocation = $this->find($id);
        return $geolocation ? $geolocation->delete() : false;
    }

    public function findByUserId(int $userId): ?Geolocation
    {
        return $this->model->where('userID', $userId)->first();
    }

    public function findByPartnerId(int $partnerId): ?Geolocation
    {
        return $this->model->where('partnerID', $partnerId)->first();
    }
}
