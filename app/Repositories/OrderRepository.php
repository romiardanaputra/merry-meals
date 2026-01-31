<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(protected Order $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Order
    {
        return $this->model->find($id);
    }

    public function create(array $data): Order
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $order = $this->find($id);
        return $order ? $order->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $order = $this->find($id);
        return $order ? $order->delete() : false;
    }

    public function getByUser(int $userId): Collection
    {
        return $this->model->where('userID', $userId)->get();
    }

    public function getByPartner(int $partnerId): Collection
    {
        return $this->model->where('partnerID', $partnerId)->get();
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    public function getByVolunteer(int $volunteerId): Collection
    {
        return $this->model->where('volunteerID', $volunteerId)->get();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $order = $this->find($id);
        return $order ? $order->update(['status' => $status]) : false;
    }
}
