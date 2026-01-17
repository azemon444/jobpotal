@extends('layouts.app')
@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
  <div class="card shadow-lg border-0 p-4" style="max-width: 400px; width: 100%;">
    <h3 class="mb-3 text-center fw-bold text-primary">Forgot Password</h3>
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Enter your email">
      </div>
      <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
    </form>
    @if (session('status'))
      <div class="alert alert-success mt-3">{{ session('status') }}</div>
    @endif
    <div class="mt-3 text-center">
      <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
    </div>
  </div>
</div>
@endsection
