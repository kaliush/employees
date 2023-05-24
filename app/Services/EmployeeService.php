<?php


namespace App\Services;

use App\Dtos\Employee\CreateEmployeeDto;
use App\Dtos\Employee\UpdateEmployeeDto;
use App\Exceptions\EmployeeCreationException;
use App\Exceptions\EmployeeDeleteException;
use App\Exceptions\EmployeeUpdateException;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

readonly class EmployeeService
{
    public function __construct(private EmployeeRepository $repository, private ManagerService $managerService)
    {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $id): Employee
    {
        return $this->repository->getByID($id);
    }

    /**
     * @throws EmployeeCreationException
     */
    public function create(CreateEmployeeDto $dto): Employee
    {
        try {
            return Employee::create($dto->toArray());
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new EmployeeCreationException('Failed to create employee.');
        }
    }

    /**
     * @throws EmployeeUpdateException
     */
    public function update(Employee $employee, UpdateEmployeeDto $dto): bool
    {
        try {
            if (($dto->manager_id) !== null) {
                $this->managerService->assignManager($employee, $dto->manager_id);
            }

            return $employee->update($dto->toArray());
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new EmployeeUpdateException($e->getMessage());
        }
    }

    /**
     * @throws EmployeeDeleteException
     */
    public function delete(Employee $employee): bool
    {
        try {
            $employee->delete();

        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new EmployeeDeleteException('Failed to delete employee.');
        }
        return true;
    }
}
