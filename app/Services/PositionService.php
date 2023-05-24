<?php

namespace App\Services;

use App\Dtos\Position\CreatePositionDto;
use App\Dtos\Position\UpdatePositionDto;
use App\Exceptions\PositionDeleteException;
use App\Exceptions\PositionNotFoundException;
use App\Models\Position;

use App\Repositories\PositionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

readonly class PositionService
{
    public function __construct(private PositionRepository $repository)
    {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function create(CreatePositionDto $dto): Position
    {
        $position = new Position();
        $position->name = $dto->name;
        $position->save();

        return $position;
    }

    public function update(UpdatePositionDto $dto, $id): Position
    {
        $position = $this->repository->getById($id);

        $position->name = $dto->name;
        $position->save();

        return $position;
    }

    /**
     * @throws PositionNotFoundException
     * @throws PositionDeleteException
     */
    public function delete(Position $position): bool
    {
        if ($position->employees()->exists()) {
            throw new PositionDeleteException('Cannot delete position. It is associated with employees.');
        }

        try {
            $position->delete();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new PositionDeleteException('Failed to delete position: ' . $e->getMessage());
        }

        return true;
    }
}
