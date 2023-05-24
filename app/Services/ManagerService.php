<?php

namespace App\Services;

use App\Exceptions\InvalidManagerException;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;

readonly class ManagerService
{
    private const TOP_GRADE = 5;

    public function __construct(private EmployeeRepository $repository)
    {
    }

    /**
     * @throws InvalidManagerException
     */
    public function assignManager(Employee $employee, int $managerId): void
    {
        if ($this->isSubordinate($managerId, $employee->id)) {
            throw new InvalidManagerException('Cannot assign a manager who is a subordinate of the employee.');
        }

        $employeeHierarchyLevel = $this->getHierarchyLevel($employee);
        $manager = $this->repository->getByID($managerId);
        $managerHierarchyLevel = $this->getHierarchyLevel($manager);
        if ($managerHierarchyLevel < $employeeHierarchyLevel) {
            throw new InvalidManagerException('The manager must have a higher grade than the employee being assigned to.');
        }

        if ($employeeHierarchyLevel >= self::TOP_GRADE) {
            throw new InvalidManagerException('Cannot assign a manager to the top-grade manager.');
        }

        $employee->manager_id = $managerId;
    }

    public function getHierarchyLevel(Employee $employee): int
    {
        $level = 1;
        while ($employee->manager !== null) {
            $employee = $employee->manager;
            $level++;
        }
        return $level;
    }

    private function isSubordinate(int $managerId, int $employeeId): bool
    {
        $manager = $this->repository->getByID($managerId);
        return $manager->subordinates()->where('id', $employeeId)->exists();
    }
}
