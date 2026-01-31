<?php

namespace App\Repositories;

use App\Interfaces\DonationRepositoryInterface;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Collection;

class DonationRepository implements DonationRepositoryInterface
{
    public function __construct(protected Donation $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Donation
    {
        return $this->model->find($id);
    }

    public function create(array $data): Donation
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $donation = $this->find($id);
        return $donation ? $donation->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $donation = $this->find($id);
        return $donation ? $donation->delete() : false;
    }

    public function getByEmail(string $email): Collection
    {
        return $this->model->where('donatorEmail', $email)->get();
    }

    public function getTotalAmount(): float
    {
        return (float) $this->model->sum('donationAmount');
    }
}
