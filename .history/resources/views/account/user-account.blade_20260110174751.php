@extends('layouts.account')

@section('content')
<div class="container py-5">
	<div class="row">
		<!-- Sidebar -->
		<div class="col-md-4 col-12 mb-4 mb-md-0">
			<div class="profile-sidebar p-4 border shadow-sm h-100" style="background:#0dcaf0; color:#fff;">
				<div class="text-center mb-3">
					<img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" class="rounded-circle border profile-avatar" style="width:110px;height:110px;object-fit:cover;object-position:center;box-shadow:0 0 12px #fff; background:#fff;" alt="Profile Picture">
				</div>
				<h4 class="fw-bold text-center mb-1" style="color:#fff;">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : $profile->full_name ?? '') }}</h4>
				<div class="text-center mb-3">
					<span class="badge bg-white text-primary px-3 py-2 mb-2" style="font-size:1em; font-weight:600;">{{ auth()->user()->email }}</span>
				</div>
				<div class="d-grid gap-2 mb-3">
					<a href="{{ route('account.edit') }}" class="btn btn-light btn-sm"><i class="fas fa-user-edit"></i> Edit Profile</a>
					@if($profile && $profile->cv)
					<a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-light btn-sm"><i class="fas fa-file-download"></i> Download CV</a>
					@endif
				</div>
				@php
					$fields = ['full_name','address','phone','dob','gender','nationality','about','education','experience','skills','references','cv'];
					$filled = 0;
					foreach($fields as $f) { if(!empty($profile->$f)) $filled++; }
					$percent = round($filled/count($fields)*100);
				@endphp
				<div class="mb-2">
					<div class="progress" style="height: 8px; background:#e3f0ff;">
						<div class="progress-bar bg-white text-primary" role="progressbar" style="width: {{ $percent }}%; color:#0a58ca;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<small class="d-block text-center mt-1" style="color:#fff;">Profile completeness: {{ $percent }}%</small>
				</div>
			</div>
		</div>
		<!-- Main Content -->
		<div class="col-md-8 col-12">
			<div class="profile-main p-4 bg-white border shadow-sm h-100">
				<h5 class="fw-bold mb-4 text-primary">Account Settings</h5>
				<div class="row g-4 mb-3">
					<div class="col-sm-6">
						<div class="info-block mb-4 p-4 rounded-3 shadow-sm bg-light">
							<div class="mb-3"><span class="info-label">Full Name:</span> <span class="info-value">{{ $profile->full_name ?? '' }}</span></div>
							<div class="mb-3"><span class="info-label">Address:</span> <span class="info-value">{{ $profile->address ?? '' }}</span></div>
							<div class="mb-3"><span class="info-label">Phone:</span> <span class="info-value">{{ $profile->phone ?? '' }}</span></div>
							<div class="mb-3"><span class="info-label">Date of Birth:</span> <span class="info-value">{{ $profile->dob ?? '' }}</span></div>
							<div class="mb-3"><span class="info-label">Gender:</span> <span class="info-value">{{ $profile->gender ?? '' }}</span></div>
							<div><span class="info-label">Nationality:</span> <span class="info-value">{{ $profile->nationality ?? '' }}</span></div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="info-block mb-4 p-4 rounded-3 shadow-sm bg-light">
							<div class="mb-3"><span class="info-label">About:</span> <span class="info-value">{{ $profile->about ?? '' }}</span></div>
							@if($profile && $profile->education)
								<div class="mb-3"><span class="info-label">Education:</span> <span class="info-value">{{ $profile->education }}</span></div>
							@endif
							@if($profile && $profile->experience)
								<div class="mb-3"><span class="info-label">Experience:</span> <span class="info-value">{{ $profile->experience }}</span></div>
							@endif
							@if($profile && $profile->skills)
								<div class="mb-3"><span class="info-label">Skills (English):</span> <span class="info-value">{{ $profile->skills }}</span></div>
							@endif
							@if($profile && $profile->references)
								<div><span class="info-label">References:</span> <span class="info-value">{{ $profile->references }}</span></div>
							@endif
						</div>
					</div>
				</div>
			 <div class="d-flex flex-wrap gap-2 mt-4">
				 <!-- Edit Profile button removed since /profile/edit is deprecated -->
				 <!-- Change Password and Close Account buttons removed as requested -->
			 </div>
			</div>
		</div>
	</div>
</div>
@push('css')
<style>
	.info-block {
		background: #f8fafc !important;
		border-radius: 1.2rem;
		box-shadow: 0 2px 12px #0a58ca11;
		margin-bottom: 1.5rem;
	}
	.info-label {
		font-weight: 600;
		color: #0a58ca;
		min-width: 120px;
		display: inline-block;
		letter-spacing: 0.5px;
	}
	.info-value {
		color: #222;
		font-weight: 400;
		margin-left: 0.5em;
	}
	.info-block .mb-3 {
		margin-bottom: 1.2rem !important;
	}
	.profile-sidebar {
		border-radius: 8px;
		min-height: 420px;
		background: #fff;
	}
	.profile-main {
		border-radius: 8px;
		background: #fff;
	}
	.profile-avatar {
		border: 3px solid #0dcaf0;
		box-shadow: 0 0 12px #0dcaf0;
		width: 110px;
		height: 110px;
		object-fit: cover;
		object-position: center;
		margin-bottom: 1rem;
	}
	@media (max-width: 767px) {
		.profile-sidebar, .profile-main {
			border-radius: 0 !important;
			padding: 1.2rem !important;
		}
		.profile-avatar {
			width: 80px !important;
			height: 80px !important;
		}
	}
</style>
@endpush
@endsection
