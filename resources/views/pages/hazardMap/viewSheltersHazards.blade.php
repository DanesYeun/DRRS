@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Hazards & Shelters</h3>
        <div class="mx-2 mb-3 p-2">
            <x-hazards-table label="Hazard History" :datas="$hazards"/>
        </div>
    </div>
@endsection

@section('js')
@endsection