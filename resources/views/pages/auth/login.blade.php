@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row m-md-5">
        <div class="p-2 p-md-5 d-flex flex-column justify-content-center">
            <h1 class="text-primary"><< LOGO HERE>></h1>
            <p class="text-muted">Disaster Respose and Recovery on your hands!</p>
        </div>
        <div class="flex-fill p-md-5 d-flex">
            <div class="border rounded bg-white shadow p-3 mx-md-5 flex-fill">
                
                <!-- Display success or error message -->
                @if(session('error'))
                    <x-alert response="error"/>
                @endif

                <form method="post" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    
                    <x-floating-input type="text" name="username" label="Username"/>
                    <x-floating-input type="password" name="password" label="Password"/>

                    <div class="d-flex align-items-center mb-3">
                        <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" value="1">
                        <label for="showPassword" class="ms-2 mt-2">Show Password</label>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Import password toggle js -->
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection