@extends('adminlte::page')

@section('title', 'Employee List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary"><i class="fas fa-user-plus mr-2"></i>Add
            Employee</a>
    </div>
@stop

@section('content')
    <x-adminlte-card title="Employee List" theme-mode="outline" theme="primary">
        <x-adminlte-datatable id="employee-table" :heads="[
            'Photo',
            'Name',
            'Position',
            'Hire Date',
            'Phone',
            'Email',
            'Salary',
            'Action'
        ]" striped>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        @if (Str::startsWith($employee->photo, ['http', 'https']))
                            <img src="{{ $employee->photo }}" alt="Employee Photo" width="60" height="60"
                                 style="border-radius: 50%">
                        @else
                            <img src="{{ asset('storage/'.$employee->photo) }}" alt="Employee Photo" width="60"
                                 height="60" style="border-radius: 50%">
                        @endif
                    </td>

                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d.m.y') }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>${{ $employee->salary }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i> </a>
                            <x-forms.delete-button route="{{ route('employees.destroy', $employee->id) }}"
                                                   id="{{ $employee->id }}"/>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-card>
@stop

