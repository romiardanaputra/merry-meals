<?php

namespace App\Repositories;

use App\Interfaces\SurveyRepositoryInterface;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Collection;

class SurveyRepository implements SurveyRepositoryInterface
{
    public function __construct(protected Survey $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Survey
    {
        return $this->model->find($id);
    }

    public function create(array $data): Survey
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $survey = $this->find($id);
        return $survey ? $survey->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $survey = $this->find($id);
        return $survey ? $survey->delete() : false;
    }

    public function findByUserId(int $userId): ?Survey
    {
        return $this->model->where('userID', $userId)->first();
    }

    public function getAverageRating(): float
    {
        return (float) $this->model->avg('overall') ?? 0;
    }
}
