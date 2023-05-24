<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use App\Dtos\Employee\CreateEmployeeDto;
use App\Dtos\Employee\UpdateEmployeeDto;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface
{
    public function getAll(): ?Collection;

    public function getByID(int $id): Employee;

}
