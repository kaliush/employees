@extends('adminlte::page')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card theme-mode="outline" theme="primary" title="Edit Employee" class="col-md-6">
                <form method="POST" action="{{ route('employees.update', $employee->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @if ($employee->photo)
                        <div id="preview-container" style="margin-bottom: 10px;">
                            @if (Str::startsWith($employee->photo, ['http', 'https']))
                                <img id="preview" src="{{ $employee->photo }}" alt="Employee Photo" width="200"
                                     height="200">
                            @else
                                <img id="preview" src="{{ asset('storage/'.$employee->photo) }}" alt="Employee Photo"
                                     width="200" height="200">
                            @endif
                        </div>
                    @else
                        <div id="preview-container"
                             style="width: 300px; height: 300px; background-color: #e9ecef; margin-bottom: 10px; display: flex; justify-content: center; align-items: center;">
                            <span style="color: #adb5bd; font-size: 20px;">No photo<br>JPG/PNG<br>300x300px</span>
                        </div>
                    @endif
                    <input type="file" name="photo" id="photo">
                    @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <p class="text-muted text-sm mb-3">
                        File format: jpg, png; up to 5mb; minimum size of 300x300px.
                    </p>
                    <x-adminlte-input name="name" label="Name*" placeholder="Enter name"
                                      :value="old('name', $employee->name)"/>
                    <x-adminlte-select name="position_id" label="Position*" placeholder="Choose Position">
                        @foreach($positions as $position)
                            <option
                                value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-input name="hire_date" label="Hire Date*" type="date" placeholder="dd.mm.yy"
                                      :value="old('hire_date', $employee->hire_date)"/>
                    <x-adminlte-input name="phone" label="Phone*" placeholder="+380"
                                      :value="old('phone', $employee->phone)"/>
                    <x-adminlte-input name="email" label="Email*" type="email" placeholder="Enter email"
                                      :value="old('email', $employee->email)"/>
                    <x-adminlte-input name="salary" label="Salary*" placeholder="Enter salary"
                                      :value="old('salary', $employee->salary)"/>
                    @component('components.forms.edit-manager-autocomplete', ['employee' => $employee, 'managers' => $managers])
                    @endcomponent
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
                    <div class="float-right">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Cancel</a>
                        <x-adminlte-button class="mt-2" label="Save" type="submit" theme="primary"/>
                    </div>
                </form>

            </x-adminlte-card>
        </div>
    </div>
@stop

@section('js')

    <script>
        function previewFile() {
            var preview = document.querySelector('#preview');
            var file = document.querySelector('input[name="photo"]').files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                preview.style.display = 'block';
            }
        }
        document.querySelector('input[name="photo"]').addEventListener("change", previewFile);
    </script>
@stop
