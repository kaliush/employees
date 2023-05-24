@extends('adminlte::page')

@section('title', 'Position List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Positions</h1>
        <a href="{{ route('positions.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add
            Position</a>
    </div>
@stop

@section('content')
    <x-adminlte-card title="Position list" theme-mode="outline" theme="primary">
        <x-adminlte-datatable id="positions-table" :heads="[
            'Name',
            'Last Update',
            'Action'
        ]" striped>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td style="width: 150px;">{{ \Carbon\Carbon::parse($position->updated_at)->format('d.m.y') }}</td>
                    <td style="width: 100px;">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary"
                               style="margin-right: 5px;"><i class="fas fa-edit fa-fw"></i></a>
                            <x-forms.delete-button route="{{ route('positions.destroy', $position->id) }}"
                                                   id="{{ $position->id }}"/>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-card>
@stop
