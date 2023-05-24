@extends('adminlte::page')

@section('title', 'View Employee')

@section('content_header')
    <h1>View Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card theme-mode="outline" theme="primary" title="Employee Details" class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name:</strong> {{ $employee->name }}</li>
                    <li class="list-group-item"><strong>Position:</strong> {{ $employee->position->name }}</li>
                    <li class="list-group-item"><strong>Hire Date:</strong> {{ $employee->hire_date }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $employee->phone }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $employee->email }}</li>
                    <li class="list-group-item"><strong>Salary:</strong> {{ $employee->salary }}</li>
                    <li class="list-group-item"><strong>Manager:</strong> {{ $employee->manager->name ?? 'N/A' }}</li>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Created At:</strong> {{ $employee->created_at->format('d.m.Y') }}</p>
                            <p><strong>Updated At:</strong> {{ $employee->updated_at->format('d.m.Y') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Admin Created ID:</strong> {{ $employee->admin_created_id }}</p>
                            <p><strong>Admin Updated ID:</strong> {{ $employee->admin_updated_id }}</p>
                        </div>
                    </div>
                </ul>

                <div class="float-right">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary mt-2">Edit</a>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Back</a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@stop
