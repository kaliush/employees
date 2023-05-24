@props(['label', 'name', 'options', 'selected'])

@php
    $options = \App\Models\Position::pluck('name', 'id')->toArray();
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
        <option value="">-- Select --</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @error($name)
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
