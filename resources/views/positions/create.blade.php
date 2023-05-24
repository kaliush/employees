@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <div class="col-md-6 mb-2">
        <h1>Positions</h1>
    </div>
@stop

@section('content')
    <x-adminlte-card title="Create Position" class="col-md-6">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <x-adminlte-input name="name" label="Name" placeholder="Enter position name" :max="256">
                <x-slot name="bottomSlot">
                    <span class="text-muted float-right">
                        <span id="count">0</span> / 256
                    </span>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button class="btn-primary mt-2" label="Save" type="submit" />
            <x-adminlte-button class="btn-secondary mt-2" label="Cancel" href="{{ route('positions.index') }}" />
        </form>
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
