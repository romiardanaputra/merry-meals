<?php

namespace App\Interfaces;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Collection;

interface SurveyRepositoryInterface
{
    /**
     * Get all surveys
     */
    public function all(): Collection;

    /**
     * Find survey by ID
     */
    public function find(int $id): ?Survey;

    /**
     * Create new survey
     */
    public function create(array $data): Survey;

    /**
     * Update survey
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete survey
     */
    public function delete(int $id): bool;

    /**
     * Find survey by user ID
     */
    public function findByUserId(int $userId): ?Survey;

    /**
     * Get average overall rating
     */
    public function getAverageRating(): float;
}
