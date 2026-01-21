@extends('layouts.account')

@section('content')
<style>
    .profile-header-pro {
        background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%);
        color: #fff;
        border-radius: 1.5rem 1.5rem 0 0;
        box-shadow: 0 4px 24px rgba(13,202,240,0.08);
        padding: 2.5rem 1rem 1.5rem 1rem;
        text-align: center;
        margin-bottom: -60px;
        position: relative;
    }
    .profile-avatar-pro {
        width: 120px;
        height: 120px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 0 16px #0dcaf0;
        background: #fff;
        margin-top: -60px;
        margin-bottom: 1rem;
    }
    .profile-card-pro {
        border-radius: 1.5rem;
        box-shadow: 0 2px 16px rgba(13,202,240,0.10);
        border: none;
        margin-top: 0;
        background: #fff;
    }
    .profile-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0a58ca;
        margin-bottom: 0.5rem;
        margin-top: 1.5rem;
    }
    .profile-info-list p {
        margin-bottom: 0.4rem;
        font-size: 1rem;
    }
    .profile-badge {
        display: inline-block;
        background: #e3f2fd;
        color: #0a58ca;
        border-radius: 0.5rem;
        padding: 0.2em 0.7em;
        font-size: 0.95em;
        margin-right: 0.5em;
        margin-bottom: 0.3em;
    }
    .profile-action-btns .btn {
        margin-right: 0.5em;
        margin-bottom: 0.5em;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="profile-header-pro">
                <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" alt="Profile Picture" class="profile-avatar-pro">
                <h2 class="fw-bold mb-1 text-capitalize">{{ $user->first_name ?? $user->name }}</h2>
                <div class="text-light mb-2">{{ $profile->about ?? 'No bio provided.' }}</div>
                @if($profile && $profile->cv)
                    <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-light btn-sm d-inline-flex align-items-center profile-action-btns" style="gap: 0.5em;"><i class="fas fa-file-download"></i> Download CV</a>
                @endif
                <a href="mailto:{{ $user->email }}" title="click to send email" class="btn btn-light btn-sm profile-action-btns"><i class="fas fa-envelope"></i> Email</a>
            </div>
            <div class="card profile-card-pro p-4">
                <div class="row">
                    <div class="col-md-6 profile-info-list">
                        <div class="profile-section-title">Contact & Personal</div>
                        <p><span class="profile-badge"><i class="fas fa-envelope"></i> Email</span> {{ $user->email }}</p>
                        <p><span class="profile-badge"><i class="fas fa-phone"></i> Phone</span> {{ $profile->phone ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-map-marker-alt"></i> Address</span> {{ $profile->address ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-venus-mars"></i> Gender</span> {{ $profile->gender ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-birthday-cake"></i> DOB</span> {{ $profile->dob ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-flag"></i> Nationality</span> {{ $profile->nationality ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 profile-info-list">
                        <div class="profile-section-title">Background</div>
                        <p><span class="profile-badge"><i class="fas fa-graduation-cap"></i> Education</span> {{ $profile->education ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-briefcase"></i> Experience</span> {{ $profile->experience ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-language"></i> Skills</span> {{ $profile->skills ?? '-' }}</p>
                        <p><span class="profile-badge"><i class="fas fa-users"></i> References</span> {{ $profile->references ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection