@extends('layouts.account')

@section('content')
<div class="container py-4">
	<div class="row">
		<div class="col-md-4 col-12 mb-4 mb-md-0">
			<div class="profile-sidebar p-4 border shadow-sm h-100" style="background:#0dcaf0; color:#fff; border-radius: 1.2rem;">
				<div class="text-center mb-3">
					<img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" class="rounded-circle border profile-avatar" style="width:110px;height:110px;object-fit:cover;object-position:center;box-shadow:0 0 12px #fff; background:#fff;" alt="Profile Picture">
				</div>
				<h4 class="fw-bold text-center mb-1" style="color:#fff;">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : $profile->full_name ?? '') }}</h4>
				<div class="text-center mb-2" style="font-size:1.1em; color:#e3f0ff;">{{ $profile->company ?? '' }}</div>
				<div class="text-center mb-3">
					<span class="badge bg-white text-primary px-3 py-2 mb-2" style="font-size:1em; font-weight:600;">{{ auth()->user()->email }}</span>
				</div>
				<div class="d-grid gap-2 mb-3">
					<a href="{{ route('profile.edit') }}" class="btn btn-outline-light btn-sm"><i class="fas fa-edit"></i> Edit Profile</a>
					@if($profile && $profile->cv)
					<a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-light btn-sm"><i class="fas fa-file-download"></i> Download CV</a>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-8 col-12">
			<div class="profile-main p-4 bg-white border shadow-sm h-100" style="border-radius: 1.2rem;">
				<h3 class="fw-bold mb-3 text-primary">Welcome to Your Account Overview</h3>
				<p class="mb-4">Here you can manage your profile, view your applications, saved jobs, and access all account features using the navigation on the left.</p>
				<ul class="list-group mb-4">
					<li class="list-group-item"><i class="fas fa-id-card me-2 text-primary"></i> <strong>Full Name:</strong> {{ $profile->full_name ?? auth()->user()->name }}</li>
					<li class="list-group-item"><i class="fas fa-envelope me-2 text-primary"></i> <strong>Email:</strong> {{ auth()->user()->email }}</li>
					<li class="list-group-item"><i class="fas fa-building me-2 text-primary"></i> <strong>Company:</strong> {{ $profile->company ?? '-' }}</li>
					<li class="list-group-item"><i class="fas fa-phone me-2 text-primary"></i> <strong>Phone:</strong> {{ $profile->phone ?? '-' }}</li>
					<li class="list-group-item"><i class="fas fa-map-marker-alt me-2 text-primary"></i> <strong>Address:</strong> {{ $profile->address ?? '-' }}</li>
				</ul>
				<a href="{{ route('account.changePassword') }}" class="btn btn-outline-primary me-2"><i class="fas fa-key"></i> Change Password</a>
				<a href="{{ route('account.deactivate') }}" class="btn btn-outline-danger"><i class="fas fa-user-slash"></i> Close Account</a>
			</div>
		</div>
	</div>
</div>
@endsection
