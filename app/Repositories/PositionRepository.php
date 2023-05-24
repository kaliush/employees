<?php

namespace App\Repositories;

use App\Models\Position;
use App\Dtos\Position\CreatePositionDto;
use App\Dtos\Position\UpdatePositionDto;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository implements PositionRepositoryInterface
{
    public function getAll(): Collection
    {
        return Position::all();
    }

    public function getById($id): Position
    {
        return Position::findOrFail($id);
    }

}
