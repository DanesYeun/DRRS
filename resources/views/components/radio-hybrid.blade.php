@props(['datas', 'label', 'name'])

<div class="col-12 col-md-6 mb-2">
    <h6>{{ $label }}</h6>
    @foreach ($datas as $data)
        <div class="form-check">
            <!-- Parent radio button -->
            <input class="form-check-input" type="radio" value="{{ $data['id'] }}" name="{{ $name }}" id="{{ strtolower($data['name']) }}">
            <label class="form-check-label" for="{{ strtolower($data['name']) }}">
                {{ $data['name'] }}
            </label>

            <!-- for broken -->
            @if ($data['name'] === 'Broken')
                <div class="form-check ms-4">
                    <input class="form-control" type="text" name="{{ $name }}_broken" placeholder="Specify broken part" id="{{ strtolower($data['name']) }}_input">
                </div>
            @endif

            @isset($data['subdata'])
                <div class="sub-options ms-4"> 
                    @foreach ($data['subdata'] as $subdata)
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" value="{{ $subdata['id'] }}" name="{{ $name }}_sub" id="{{ strtolower($subdata['name']) }}">
                            <label class="form-check-label" for="{{ strtolower($subdata['name']) }}">
                                {{ $subdata['name'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const brokenRadio = document.getElementById('{{ strtolower($datas[3]['name']) }}'); 
    const brokenInput = document.getElementById('{{ strtolower($datas[3]['name']) }}_input');

    function toggleBrokenInput() {
        // heck if the broken is checked
        if (brokenRadio.checked) {
            brokenInput.disabled = false;
        } else {
            brokenInput.disabled = true;
        }
    }

    toggleBrokenInput();

    const radios = document.getElementsByName('{{ $name }}');
    radios.forEach(function(radio) {
        radio.addEventListener('change', toggleBrokenInput);
    });
});

</script>
