@props(['type', 'name', 'label', 'value' => '', 'required' => false, 'readOnly' => false, 'mdSize' => 6, 'accept' => ''])
<div class="col-12 col-md-{{ $mdSize }} mb-2">
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($required) required @endif {{ $readOnly ? 'readOnly' : ''}}  @if($accept) accept="{{ $accept }}" @endif>
    <small for="{{ $name }}" class="px-2 d-flex justify-content-start text-primary">{{ $label }}</small>

    <div class="invalid-feedback text-start">
        <i class="bi bi-exclamation-circle-fill"></i>
        This field is required
    </div>
</div>