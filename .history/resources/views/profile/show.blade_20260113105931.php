@extends('layouts.account')
@section('content')
<div class="container py-5" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: #f4f7fb; min-height: 100vh;">
    <div class="row justify-content-center">
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-5 col-12 mb-4 mb-lg-0">
            <div class="profile-sidebar-modern p-4 border-0 shadow-lg h-100 text-center bg-white position-relative rounded-4">
                <div class="profile-avatar-wrapper mx-auto mb-3 position-relative">
                    <img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" class="profile-avatar-modern shadow" alt="Profile Picture">
                    <span class="profile-status-badge bg-success"></span>
                </div>
                <h3 class="fw-bold mb-1 text-dark">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : $profile->full_name ?? '') }}</h3>
                <div class="mb-2 text-muted" style="font-size:1.1em;">{{ $profile->company ?? '' }}</div>
                <div class="mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2" style="font-size:1em; font-weight:600; border-radius: 1em;">{{ auth()->user()->email }}</span>
                </div>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="fas fa-edit me-1"></i> Edit Profile</a>
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
                <div class="mb-2">
                    <div class="progress modern-progress" style="height: 10px; background:#e9ecef; border-radius: 6px;">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $percent }}%; border-radius: 6px; background: linear-gradient(90deg, #0dcaf0 0%, #0a58ca 100%);" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="d-block text-center mt-2 text-muted">Profile completeness: <span class="fw-bold text-primary">{{ $percent }}%</span></small>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-lg-8 col-md-7 col-12">
            <div class="profile-main-modern p-5 bg-white border-0 shadow-lg h-100 rounded-4">
                <h4 class="fw-bold mb-4 text-primary"><i class="fas fa-user-circle me-2"></i>Personal Information</h4>
                <div class="row g-4 mb-3">
                    <div class="col-sm-6">
                        <div class="info-block-modern p-4 rounded-4 shadow-sm bg-light h-100">
                            <div class="mb-3"><span class="info-label">Full Name:</span> <span class="info-value">{{ $profile->full_name ?? '' }}</span></div>
                            <div class="mb-3"><span class="info-label">Company:</span> <span class="info-value">{{ $profile->company ?? '' }}</span></div>
                            <div class="mb-3"><span class="info-label">Address:</span> <span class="info-value">{{ $profile->address ?? '' }}</span></div>
                            <div class="mb-3"><span class="info-label">Phone:</span> <span class="info-value">{{ $profile->phone ?? '' }}</span></div>
                            <div class="mb-3"><span class="info-label">Date of Birth:</span> <span class="info-value">{{ $profile->dob ?? '' }}</span></div>
                            <div class="mb-3"><span class="info-label">Gender:</span> <span class="info-value">{{ $profile->gender ?? '' }}</span></div>
                            <div><span class="info-label">Nationality:</span> <span class="info-value">{{ $profile->nationality ?? '' }}</span></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-block-modern p-4 rounded-4 shadow-sm bg-light h-100">
                            <div class="mb-3"><span class="info-label">About:</span> <span class="info-value">{{ $profile->about ?? '' }}</span></div>
                            @if($profile && $profile->education)
                                <div class="mb-3"><span class="info-label">Education:</span> <span class="info-value">{{ $profile->education }}</span></div>
                            @endif
                            @if($profile && $profile->experience)
                                <div class="mb-3"><span class="info-label">Experience:</span> <span class="info-value">{{ $profile->experience }}</span></div>
                            @if($profile && $profile->skills)
                                <div class="mb-3"><span class="info-label">Skills:</span> <span class="info-value">{{ $profile->skills }}</span></div>
                            @endif
                            @if($profile && $profile->references)
                                <div><span class="info-label">References:</span> <span class="info-value">{{ $profile->references }}</span></div>
                            @endif
                        </div>
                    </div>
                </div>
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
    .info-block-modern {
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
    .info-block-modern .mb-3 {
        margin-bottom: 1.2rem !important;
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
    }
</style>
@endpush
        </div>
    </div>
</div>
@push('css')
<style>
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
