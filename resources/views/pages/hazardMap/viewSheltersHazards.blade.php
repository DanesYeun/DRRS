@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Hazards and Shelters</h3>
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ route('hazard_map.index') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>
        <div class="mx-2 mb-3 p-2">
            <x-hazards-table label="Hazard History" :datas="$hazards"/>
            <hr>
            <x-shelters-table label="Shelters" :datas="$shelters"/>
        </div>
    </div>
@endsection

@section('js')
@endsection