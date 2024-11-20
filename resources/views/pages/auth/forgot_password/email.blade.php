@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Forgot Password</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
</div>
@endsection
