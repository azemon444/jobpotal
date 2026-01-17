@extends('layouts.app')
@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
  <div class="card shadow-lg border-0 p-4" style="max-width: 400px; width: 100%;">
    <h3 class="mb-3 text-center fw-bold text-primary">Reset Password</h3>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token ?? '' }}">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password" name="password" required placeholder="New password">
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Repeat new password">
      </div>
      <button type="submit" class="btn btn-primary w-100">Reset Password</button>
    </form>
    @if ($errors->any())
      <div class="alert alert-danger mt-3">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="mt-3 text-center">
      <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
    </div>
  </div>
</div>
@endsection
