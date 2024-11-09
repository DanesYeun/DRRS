@props(['type', 'name', 'label'])
<div class="col-12 col-md-6 mb-2">
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}">
    <small for="{{ $name }}" class="px-2 d-flex justify-content-start text-primary">{{ $label }}</small>
</div>