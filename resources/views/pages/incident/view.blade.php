@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        {{-- <h3 class="text-start mx-2 text-primary">Incident Reports</h3> --}}
        <x-incidents-table label="Incident Reports" :datas="$incidentReports"/>
    </div>
@endsection

@section('js')
@endsection