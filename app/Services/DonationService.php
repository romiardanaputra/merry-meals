<?php

namespace App\Services;

use App\Interfaces\DonationRepositoryInterface;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Collection;

class DonationService
{
    public function __construct(
        protected DonationRepositoryInterface $donationRepository
    ) {}

    /**
     * Get all donations
     */
    public function getAllDonations(): Collection
    {
        return $this->donationRepository->all();
    }

    /**
     * Get donation by ID
     */
    public function getDonationById(int $id): ?Donation
    {
        return $this->donationRepository->find($id);
    }

    /**
     * Process new donation
     */
    public function processDonation(array $data): Donation
    {
        return $this->donationRepository->create($data);
    }

    /**
     * Get donations by donator email
     */
    public function getDonationsByEmail(string $email): Collection
    {
        return $this->donationRepository->getByEmail($email);
    }

    /**
     * Get total donation amount
     */
    public function getTotalDonations(): float
    {
        return $this->donationRepository->getTotalAmount();
    }

    /**
     * Get donation statistics
     */
    public function getDonationStats(): array
    {
        $donations = $this->getAllDonations();

        return [
            'total_amount' => $this->getTotalDonations(),
            'total_count' => $donations->count(),
            'average_amount' => $donations->count() > 0
                ? $this->getTotalDonations() / $donations->count()
                : 0,
        ];
    }
}
