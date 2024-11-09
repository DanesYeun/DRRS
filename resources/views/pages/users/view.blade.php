@extends('layouts.layout')

@section('content')
    <div class="border d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Manage Users</h3>
        <x-table label="Users"/>

        <a href="#" class="btn btn-success mx-2"><i class="bi bi-person-fill-add p-2"></i> Add User</a>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection