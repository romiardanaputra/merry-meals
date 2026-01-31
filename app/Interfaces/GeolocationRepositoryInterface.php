<?php

namespace App\Interfaces;

use App\Models\Geolocation;
use Illuminate\Database\Eloquent\Collection;

interface GeolocationRepositoryInterface
{
    /**
     * Get all geolocations
     */
    public function all(): Collection;

    /**
     * Find geolocation by ID
     */
    public function find(int $id): ?Geolocation;

    /**
     * Create new geolocation
     */
    public function create(array $data): Geolocation;

    /**
     * Update geolocation
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete geolocation
     */
    public function delete(int $id): bool;

    /**
     * Find geolocation by user ID
     */
    public function findByUserId(int $userId): ?Geolocation;

    /**
     * Find geolocation by partner ID
     */
    public function findByPartnerId(int $partnerId): ?Geolocation;
}
