@props(['options', 'name', 'label', 'value' => null, 'required' => false])
<div class="col-12 col-md-6 mb-2">
   <select name="{{ $name }}" id="{{ $name }}" class="form-select text-primary" @if($required) required @endif>
      <option selected disabled hidden value="">Please Select</option>
      @foreach ($options as $option)
         <option value="{{ $option['id'] }}" 
            @if ($option['id'] == $value) selected @endif>
            {{ $option['name'] }}
         </option>
      @endforeach
   </select>
   <small for="{{ $name }}" class="px-2 d-flex justify-content-start text-primary">{{ $label }}</small>
</div>