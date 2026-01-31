<?php

namespace App\Interfaces;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection;

interface PartnerRepositoryInterface
{
    /**
     * Get all partners
     */
    public function all(): Collection;

    /**
     * Find partner by ID
     */
    public function find(int $id): ?Partner;

    /**
     * Create new partner
     */
    public function create(array $data): Partner;

    /**
     * Update partner
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete partner
     */
    public function delete(int $id): bool;

    /**
     * Find partner by user ID
     */
    public function findByUserId(int $userId): ?Partner;

    /**
     * Get partners by food type
     */
    public function getByFoodType(string $foodType): Collection;
}
