<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use App\Dtos\Employee\CreateEmployeeDto;
use App\Dtos\Employee\UpdateEmployeeDto;
use App\Models\Position;
use Illuminate\Support\Collection;

interface PositionRepositoryInterface
{
    public function getAll(): ?Collection;

    public function getByID(int $id): Position;

}
