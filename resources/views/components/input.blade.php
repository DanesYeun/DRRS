@props(['type', 'name', 'label', 'value' => '', 'required' => false, 'readOnly' => false])
<div class="col-12 col-md-6 mb-2">
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($required) required @endif {{ $readOnly ? 'readOnly' : ''}}>
    <small for="{{ $name }}" class="px-2 d-flex justify-content-start text-primary">{{ $label }}</small>
</div>