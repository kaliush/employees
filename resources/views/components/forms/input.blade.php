@props(['label', 'name', 'type' => 'text', 'value', 'placeholder' => ''])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
    @error($name)
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
