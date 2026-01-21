@extends('layouts.account')

@section('content')
<div class="container pt-4 pb-5" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: #f4f7fb; min-height: 100vh;">
   <div class="row justify-content-center">
	   <!-- Main Content -->
	   <div class="col-12 d-flex justify-content-center">
		   <div class="profile-main-modern bg-white border-0 shadow-lg rounded-4" style="max-width:1100px;width:90vw;padding:2.5rem 3.5rem 2rem 3.5rem; margin-top:0;">
				<div class="row mb-3">
					<div class="col-12">
						   <div class="profile-section-card rounded-4 shadow-sm bg-white mb-4" style="max-width:1000px;margin:auto;padding:2rem 2.5rem;">
							   <div class="d-flex flex-column align-items-center mb-3">
								   <div class="profile-avatar-wrapper mx-auto mb-2 position-relative">
									   <img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" alt="Profile Picture" class="profile-avatar-modern shadow" style="width:100px;height:100px;">
									   <span class="profile-status-badge bg-success"></span>
								   </div>
								   <h3 class="fw-bold mb-1 text-dark">{{ $profile->full_name ?? '' }}</h3>
								   <div class="text-muted mb-2">{{ $profile->address ?? '' }}</div>
								   <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2" style="font-size:1em; font-weight:600; border-radius: 1em;">{{ auth()->user()->email }}</span>
								   <div class="d-flex justify-content-center gap-2 mb-3">
									   <a href="{{ route('account.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="fas fa-user-edit me-1"></i> Edit Profile</a>
									   @if($profile && $profile->cv)
									   <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-file-download me-1"></i> CV</a>
									   @endif
								   </div>
								   @php
									   $fields = ['full_name','address','phone','dob','gender','nationality','about','education','experience','skills','references','cv'];
									   $filled = 0;
									   foreach($fields as $f) { if(!empty($profile->$f)) $filled++; }
									   $percent = round($filled/count($fields)*100);
								   @endphp
								   <div class="mb-2 w-100" style="max-width:500px;margin:auto;">
									   <div class="progress modern-progress" style="height: 10px; background:#e9ecef; border-radius: 6px;">
										   <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $percent }}%; border-radius: 6px; background: linear-gradient(90deg, #0dcaf0 0%, #0a58ca 100%);" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
									   </div>
									   <small class="d-block text-center mt-2 text-muted">Profile completeness: <span class="fw-bold text-primary">{{ $percent }}%</span></small>
								   </div>
							   </div>
							   <div class="row g-3 mb-3">
								   <div class="col-md-6">
									   <div class="d-flex align-items-center mb-2"><i class="fas fa-phone text-primary me-2"></i><span>{{ $profile->phone ?? '' }}</span></div>
									   <div class="d-flex align-items-center mb-2"><i class="fas fa-birthday-cake text-primary me-2"></i><span>{{ $profile->dob ?? '' }}</span></div>
								   </div>
								   <div class="col-md-6">
									   <div class="d-flex align-items-center mb-2"><i class="fas fa-venus-mars text-primary me-2"></i><span>{{ $profile->gender ?? '' }}</span></div>
									   <div class="d-flex align-items-center mb-2"><i class="fas fa-flag text-primary me-2"></i><span>{{ $profile->nationality ?? '' }}</span></div>
								   </div>
							   </div>
						   </div>
					</div>
				</div>
				<!-- Removed the Account Settings header and adjusted the layout for full-width sections -->
				<div class="row mb-3">
					<div class="col-12">
						<!-- About Section -->
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-info-circle text-primary me-2"></i>About</h5>
								<div class="ps-1">{{ $profile->about ?? 'No about info provided.' }}</div>
							</div>
						</div>
						<!-- Education Section -->
						@if($profile && $profile->education)
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-graduation-cap text-primary me-2"></i>Education</h5>
								<div class="ps-1">{{ $profile->education }}</div>
							</div>
						</div>
						@endif
						<!-- Experience Section -->
						@if($profile && $profile->experience)
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-briefcase text-primary me-2"></i>Experience</h5>
								<div class="ps-1">{{ $profile->experience }}</div>
							</div>
						</div>
						@endif
						<!-- Skills Section -->
						@if($profile && $profile->skills)
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-lightbulb text-success me-2"></i>Skills</h5>
								<div class="ps-1">
									@foreach(explode(',', $profile->skills) as $skill)
									   <span class="badge bg-success bg-opacity-10 text-success fw-semibold me-2 mb-2" style="font-size:1em; border-radius:1em;">{{ trim($skill) }}</span>
									@endforeach
								</div>
							</div>
						</div>
						@endif
						<!-- References Section -->
						@if($profile && $profile->references)
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-users text-primary me-2"></i>References</h5>
								<div class="ps-1">{{ $profile->references }}</div>
							</div>
						</div>
						@endif
						<!-- Email Highlighting -->
						@if($profile && $profile->email)
						<div class="card shadow-sm rounded-4 mb-4">
							<div class="card-body">
								<h5 class="fw-bold mb-2"><i class="fas fa-envelope text-warning me-2"></i>Email</h5>
								<div class="ps-1">
									<span class="badge bg-warning bg-opacity-10 text-warning fw-semibold" style="font-size:1em; border-radius:1em;">{{ $profile->email }}</span>
								</div>
							</div>
						</div>
						@endif
					</div>
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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
	body, .container {
		font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
	}
	.profile-sidebar-modern {
		border-radius: 1.5rem;
		background: #fff;
		box-shadow: 0 4px 32px #0a58ca18;
		min-height: 480px;
		padding-top: 2.5rem !important;
	}
	.profile-avatar-modern {
		border: 4px solid #0dcaf0;
		box-shadow: 0 0 18px #0dcaf044;
		width: 120px;
		height: 120px;
		object-fit: cover;
		object-position: center;
		border-radius: 50%;
		background: #fff;
		z-index: 2;
		position: relative;
	}
	.profile-avatar-wrapper {
		width: 130px;
		height: 130px;
		display: flex;
		align-items: center;
		justify-content: center;
		position: relative;
	}
	.profile-status-badge {
		position: absolute;
		bottom: 12px;
		right: 18px;
		width: 18px;
		height: 18px;
		border-radius: 50%;
		border: 2px solid #fff;
		box-shadow: 0 0 0 2px #0dcaf0;
		z-index: 3;
	}
	.modern-progress .progress-bar {
		transition: width 0.6s cubic-bezier(.4,0,.2,1);
	}
	.profile-main-modern {
		border-radius: 1.5rem;
		background: #fff;
		box-shadow: 0 4px 32px #0a58ca18;
		min-height: 480px;
	}
	.profile-section-card {
		background: #f8fafc !important;
		border-radius: 1.2rem;
		box-shadow: 0 2px 12px #0a58ca11;
		margin-bottom: 1.5rem;
		padding: 2rem 1.5rem;
	}
	.info-label {
		font-weight: 600;
		color: #0a58ca;
		min-width: 110px;
		display: inline-block;
		letter-spacing: 0.5px;
	}
	.info-value {
		color: #222;
		font-weight: 400;
		margin-left: 0.5em;
		word-break: break-word;
	}
	@media (max-width: 991px) {
		.profile-sidebar-modern, .profile-main-modern {
			border-radius: 1rem !important;
			padding: 1.2rem !important;
		}
		.profile-avatar-modern {
			width: 90px !important;
			height: 90px !important;
		}
		.profile-avatar-wrapper {
			width: 100px;
			height: 100px;
		}
		.info-card-modern {
			padding: 1.2rem 0.7rem;
		}
	}
	@media (max-width: 767px) {
		.profile-sidebar-modern, .profile-main-modern {
			border-radius: 0 !important;
			padding: 1.2rem !important;
		}
		.profile-avatar-modern {
			width: 70px !important;
			height: 70px !important;
		}
		.profile-avatar-wrapper {
			width: 80px;
			height: 80px;
		}
		.info-card-modern {
			padding: 0.7rem 0.3rem;
		}
	}
</style>
@endpush
@endsection
