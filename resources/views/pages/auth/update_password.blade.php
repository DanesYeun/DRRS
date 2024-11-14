@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Update Password</h3>
            <x-alert response="error"/>
            <a class="btn btn-danger col-4 col-md-2 mb-3 " href="{{ url()->previous() }}">
                <i class="bi bi-backspace-fill p-2"></i>
                Back
            </a>
        </div>

        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('save.password') }}" class="needs-validation" novalidate>
                @csrf
                
                <x-floating-input type="password" name="password" label="New Password" required="true"/>
                <x-floating-input type="password" name="password_confirmation" label="Confirm New Password" required="true"/>

                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" value="1">
                    <label for="showPassword" class="ms-2 mt-2">Show Password</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection