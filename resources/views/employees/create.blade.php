@extends('adminlte::page')

@section('title', 'Create Employee')

@section('content_header')
    <h1>Create Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card theme-mode="outline" theme="primary" title="Create Employee">
                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                    @csrf
                    <img id="preview" src="#" alt="Preview" width="300" height="300" style="display: none; margin-bottom: 10px;">
                    <x-adminlte-input-file name="photo" label="Photo*" placeholder="Choose file" onchange="previewFile()" accept="image/*">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-primary text-white">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                    <p class="text-muted text-sm mb-3">
                        File format: jpg, png; up to 5mb; minimum size of 300x300px.
                    </p>
                    <x-adminlte-input name="name" label="Name*" placeholder="Enter name" :value="old('name')"/>
                    <x-adminlte-input name="phone" label="Phone*" placeholder="+380" :value="old('phone')"/>
                    <x-adminlte-input name="email" label="Email*" type="email" placeholder="Enter email"
                                      :value="old('email')"/>
                    <x-adminlte-select name="position_id" label="Position*" placeholder="Choose Position">
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input name="salary" label="Salary*" placeholder="Enter salary" :value="old('salary')"/>
                    @component('components.forms.add-manager-autocomplete', ['managers' => $managers])
                    @endcomponent
                    <x-adminlte-input name="hire_date" label="Hire Date*" type="date" placeholder="dd.mm.yy"
                                      :value="old('hire_date')"/>
                    <div class="float-right">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                        <x-adminlte-button class="ml-2" label="Create" type="submit" theme="primary"/>
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
    </script>
@stop
