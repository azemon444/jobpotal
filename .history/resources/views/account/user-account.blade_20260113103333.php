@extends('layouts.account')

@section('content')
<style>
	.modern-profile-sidebar {
		background: linear-gradient(120deg, #0a58ca 60%, #0dcaf0 100%);
		color: #fff;
		border-radius: 1.5rem;
		box-shadow: 0 6px 32px rgba(13,202,240,0.10);
		padding: 2.5rem 1rem 2rem 1rem;
		text-align: center;
		margin-bottom: 2rem;
		position: relative;
		overflow: visible;
	}
	.modern-profile-avatar {
		width: 120px;
		height: 120px;
		object-fit: cover;
		object-position: center;
		border-radius: 50%;
		border: 5px solid #fff;
		box-shadow: 0 0 24px #0dcaf0;
		background: #fff;
		margin-top: -80px;
		margin-bottom: 1rem;
		transition: transform 0.2s;
	}
	.modern-profile-avatar:hover {
		transform: scale(1.05);
		box-shadow: 0 0 32px #0a58ca;
	}
	.modern-profile-badge {
		display: inline-block;
		background: #e3f2fd;
		color: #0a58ca;
		border-radius: 0.5rem;
		padding: 0.22em 0.8em;
		font-size: 1em;
		margin-right: 0.5em;
		margin-bottom: 0.3em;
		font-weight: 500;
	}
	.modern-profile-progress {
		height: 8px;
		background: #e3f0ff;
		border-radius: 4px;
		overflow: hidden;
	}
	.modern-profile-progress-bar {
		background: #fff;
		color: #0a58ca;
		height: 100%;
		border-radius: 4px;
		transition: width 0.4s;
	}
	.modern-profile-main {
		border-radius: 1.5rem;
		box-shadow: 0 2px 24px rgba(13,202,240,0.13);
		border: none;
		background: #fff;
		padding: 2.5rem 2rem 2rem 2rem;
	}
	.modern-profile-section-title {
		font-size: 1.15rem;
		font-weight: 700;
		color: #0a58ca;
		margin-bottom: 0.7rem;
		margin-top: 1.7rem;
		letter-spacing: 0.5px;
	}
	.modern-profile-info-list div {
		margin-bottom: 0.5rem;
		font-size: 1.07rem;
		color: #222;
	}
	@media (max-width: 767px) {
		.modern-profile-main { padding: 1.2rem 0.5rem 1.5rem 0.5rem; }
		.modern-profile-sidebar { padding: 2rem 0.5rem 1.5rem 0.5rem; }
	}
</style>
<div class="container py-5">
	<div class="row">
		<!-- Sidebar -->
		<div class="col-md-4 col-12 mb-4 mb-md-0">
			<div class="modern-profile-sidebar">
				<img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" class="modern-profile-avatar" alt="Profile Picture">
				<h4 class="fw-bold text-center mb-1" style="color:#fff;">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : $profile->full_name ?? '') }}</h4>
				<div class="text-center mb-3">
					<span class="modern-profile-badge">{{ auth()->user()->email }}</span>
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
					<div class="modern-profile-progress">
						<div class="modern-profile-progress-bar" style="width: {{ $percent }}%; background:#fff; color:#0a58ca;">&nbsp;</div>
					</div>
					<small class="d-block text-center mt-1" style="color:#fff;">Profile completeness: {{ $percent }}%</small>
				</div>
			</div>
		</div>
		<!-- Main Content -->
		<div class="col-md-8 col-12">
			<div class="modern-profile-main">
				<h5 class="fw-bold mb-4 text-primary">Account Overview</h5>
				<div class="row g-4 mb-3">
					<div class="col-sm-6">
						<div class="mb-4 p-4 rounded-3 shadow-sm bg-light modern-profile-info-list">
							<div><span class="modern-profile-badge"><i class="fas fa-user"></i> Full Name</span> {{ $profile->full_name ?? '' }}</div>
							<div><span class="modern-profile-badge"><i class="fas fa-map-marker-alt"></i> Address</span> {{ $profile->address ?? '' }}</div>
							<div><span class="modern-profile-badge"><i class="fas fa-phone"></i> Phone</span> {{ $profile->phone ?? '' }}</div>
							<div><span class="modern-profile-badge"><i class="fas fa-birthday-cake"></i> Date of Birth</span> {{ $profile->dob ?? '' }}</div>
							<div><span class="modern-profile-badge"><i class="fas fa-venus-mars"></i> Gender</span> {{ $profile->gender ?? '' }}</div>
							<div><span class="modern-profile-badge"><i class="fas fa-flag"></i> Nationality</span> {{ $profile->nationality ?? '' }}</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mb-4 p-4 rounded-3 shadow-sm bg-light modern-profile-info-list">
							<div><span class="modern-profile-badge"><i class="fas fa-info-circle"></i> About</span> {{ $profile->about ?? '' }}</div>
							@if($profile && $profile->education)
								<div><span class="modern-profile-badge"><i class="fas fa-graduation-cap"></i> Education</span> {{ $profile->education }}</div>
							@endif
							@if($profile && $profile->experience)
								<div><span class="modern-profile-badge"><i class="fas fa-briefcase"></i> Experience</span> {{ $profile->experience }}</div>
							@endif
							@if($profile && $profile->skills)
								<div><span class="modern-profile-badge"><i class="fas fa-language"></i> Skills</span> {{ $profile->skills }}</div>
							@endif
							@if($profile && $profile->references)
								<div><span class="modern-profile-badge"><i class="fas fa-users"></i> References</span> {{ $profile->references }}</div>
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
	<!-- Admin Feedback Section for Author's Job Posts -->
	@php
		$myPosts = \App\Models\Post::where('user_id', auth()->id())->orderByDesc('created_at')->get();
	@endphp
	@if($myPosts->count())
	<div class="mt-5">
		<h5 class="fw-bold text-primary mb-3">Admin Comments on Your Job Posts</h5>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Job Title</th>
						<th>Admin Comment</th>
						<th>Your Reply</th>
					</tr>
				</thead>
				<tbody>
				@foreach($myPosts as $post)
					@if($post->admin_feedback)
					<tr>
						<td>{{ $post->job_title }}</td>
						<td>{{ $post->admin_feedback }}</td>
						<td>
							<form action="{{ route('author.replyFeedback', $post->id) }}" method="POST">
								@csrf
								<textarea name="author_reply" class="form-control mb-1" rows="2" placeholder="Reply to admin...">{{ $post->author_reply }}</textarea>
								<button class="btn btn-primary btn-sm" type="submit">Send Reply</button>
							</form>
						</td>
					</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
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
