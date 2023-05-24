<?php

namespace App\Http\Controllers;

use App\Dtos\Employee\CreateEmployeeDto;
use App\Dtos\Employee\UpdateEmployeeDto;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use App\Services\EmployeeService;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeService $employeeService, private readonly FileService $fileService)
    {
    }

    public function index(): View
    {
        $employees = $this->employeeService->getAll();

        return view('employees.index', compact('employees'));
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function create(): View
    {
        $positions = Position::all();
        $managers = Employee::all(['id', 'name']);

        return view('employees.create', compact('positions', 'managers'));
    }

    public function store(CreateEmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $file = $request->file('photo');

        if ($file) {
            $data = $this->fileService->upload($data, $file);
        }
        $dto = new CreateEmployeeDto(
            $data['name'],
            $data['position_id'],
            $data['hire_date'],
            $data['phone'],
            $data['email'],
            $data['salary'],
            $data['photo'] ?? null,
            $data['manager_id'] ?? null,
        );
        $this->employeeService->create($dto);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    public function edit(int $id): View
    {
        $employee = $this->employeeService->getById($id);

        if (!$employee) {
            abort(404);
        }

        $positions = Position::all();
        $managers = Employee::where('id', '<>', $id)->get(['id', 'name']);

        return view('employees.edit', compact('employee', 'positions', 'managers'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $data = $request->validated();
        $file = $request->file('photo');

        if ($file) {
            $data = $this->fileService->upload($data, $file, $employee);
        }
        $dto = new UpdateEmployeeDto(
            $data['name'] ?? $employee->name,
            $data['position_id'] ?? $employee->position_id,
            $data['hire_date'] ?? $employee->hire_date,
            $data['phone'] ?? $employee->phone,
            $data['email'] ?? $employee->email,
            $data['salary'] ?? $employee->salary,
            $data['photo'] ?? $employee->photo,
            $data['manager_id'] ?? $employee->manager_id,
        );
        $result = $this->employeeService->update($employee, $dto);

        if (!$result) {
            return redirect()->back()->with('error', 'Failed to update employee.');
        }

        return redirect()->route('employees.store', $employee)->with('success', 'Employee updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $employee = $this->employeeService->getById($id);
        $result = $this->employeeService->delete($employee);
        $this->fileService->delete('public/' . $employee->photo);

        if (!$result) {
            abort(404);
        }

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
