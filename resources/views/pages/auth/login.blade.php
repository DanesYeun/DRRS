@extends('layouts.layout')

@section('content')
    <div class="row m-md-5">
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
            <img src="images/stories/login.png" alt="login.jpg" class="img-fluid d-none d-sm-inline" style="width: 400px; object-fit: cover;">
            <h4 class="text-primary d-none d-sm-inline">Disaster Respose and Recovery on your hands!</h4>
        </div>
        <div class="col-12 col-md-6 p-md-5 my-5 py-5">
            <div class="border rounded bg-white shadow p-3 mx-md-5">          
                @if(session('error'))
                    <x-alert response="error" color="danger"/>
                @elseif(session('success'))
                    <x-alert response="success" color="success"/>
                @endif
                <form method="post" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf               
                    <x-floating-input type="text" name="username" label="Username"/>
                    <x-floating-input type="password" name="password" label="Password"/>

                    <div class="d-flex align-items-center mb-3">
                        <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" value="1">
                        <label for="showPassword" class="ms-2 mt-2">Show Password</label>
                    </div>
                    <div class="d-grid">
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