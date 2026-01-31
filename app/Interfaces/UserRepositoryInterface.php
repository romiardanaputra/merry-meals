<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all users
     */
    public function all(): Collection;

    /**
     * Find user by ID
     */
    public function find(int $id): ?User;

    /**
     * Create new user
     */
    public function create(array $data): User;

    /**
     * Update user
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete user
     */
    public function delete(int $id): bool;

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Get users by role
     */
    public function getByRole(string $role): Collection;
}
