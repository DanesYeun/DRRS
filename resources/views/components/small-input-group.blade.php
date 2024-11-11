@props(['label', 'datas'])
<div class="col-12 col-md-6 mb-2">
    <h6>{{ $label }}</h6>
    @foreach ($datas as $data)
        <div class="input-group input-group-sm mb-1">
            <span class="input-group-text">{{ $data['name'] }}</span>
            <input name="{{ strtolower($data['name']) }}" type="text" class="form-control">
        </div>
    @endforeach  
</div>