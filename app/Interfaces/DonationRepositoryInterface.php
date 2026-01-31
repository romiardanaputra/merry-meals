<?php

namespace App\Interfaces;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Collection;

interface DonationRepositoryInterface
{
    /**
     * Get all donations
     */
    public function all(): Collection;

    /**
     * Find donation by ID
     */
    public function find(int $id): ?Donation;

    /**
     * Create new donation
     */
    public function create(array $data): Donation;

    /**
     * Update donation
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete donation
     */
    public function delete(int $id): bool;

    /**
     * Get donations by email
     */
    public function getByEmail(string $email): Collection;

    /**
     * Get total donation amount
     */
    public function getTotalAmount(): float;
}
