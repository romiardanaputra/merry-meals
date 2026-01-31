<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * Get all users
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * Get user by ID
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Register new member
     */
    public function registerMember(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'member';

        return $this->userRepository->create($data);
    }

    /**
     * Update user profile
     */
    public function updateProfile(int $id, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }

    /**
     * Get users by role
     */
    public function getUsersByRole(string $role): Collection
    {
        return $this->userRepository->getByRole($role);
    }

    /**
     * Get all members
     */
    public function getAllMembers(): Collection
    {
        return $this->getUsersByRole('member');
    }

    /**
     * Get all riders/volunteers
     */
    public function getAllRiders(): Collection
    {
        return $this->getUsersByRole('rider');
    }
}
