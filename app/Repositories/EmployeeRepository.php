<?php

namespace App\Repositories;


use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


readonly class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(): Collection
    {
        return Employee::query()->get();
    }

    public function getByID(int $id): Employee
    {
        return Employee::findOrFail($id);
    }

    public function findByName(string $name): ?Employee
    {
        return Employee::where('name', $name)->first();
    }
}
