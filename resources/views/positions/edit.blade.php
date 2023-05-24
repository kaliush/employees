@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <div class="col-md-6 mb-2">
        <h1>Positions</h1>
    </div>
@stop

@section('content')
    <x-adminlte-card title="Position edit" class="col-md-6">
        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <x-adminlte-input name="name" label="Name" :value="$position->name" placeholder="Enter position name" :max="256">
                <x-slot name="bottomSlot">
        <span class="text-muted float-right">
            <span id="count">{{ strlen($position->name) }}</span> / 256
        </span>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button class="btn-primary mt-2" label="Save Changes" type="submit" />
            <a href="{{ route('positions.index') }}" class="btn btn-secondary mt-2">Cancel</a>
        </form>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <p><strong>Created At:</strong> {{ $position->created_at->format('d.m.Y') }}</p>
                <p><strong>Updated At:</strong> {{ $position->updated_at->format('d.m.Y') }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Admin Created ID:</strong> {{ $position->admin_created_id }}</p>
                <p><strong>Admin Updated ID:</strong> {{ $position->admin_updated_id }}</p>
            </div>
        </div>
    </x-adminlte-card>
@endsection

@push('js')
    <script>
        const input = document.querySelector('#name');
        const count = document.querySelector('#count');
        input.addEventListener('input', () => {
            count.innerText = input.value.length;
        });
    </script>
@endpush
