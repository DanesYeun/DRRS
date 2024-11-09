@extends('layouts.layout')

@section('content')
    <div class="border d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Add Response Record</h3>
        <x-table label="Response History"/>

        <a href="#" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i> Create Response Record</a>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection