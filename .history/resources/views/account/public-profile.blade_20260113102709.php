@extends('layouts.account')

@section('content')
<style>
    .profile-hero {
        background: linear-gradient(120deg, #0a58ca 60%, #0dcaf0 100%);
        color: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 6px 32px rgba(13,202,240,0.10);
        padding: 2.5rem 1rem 2rem 1rem;
        text-align: center;
        margin-bottom: -70px;
        position: relative;
        overflow: visible;
    }
    .profile-avatar-modern {
        width: 130px;
        height: 130px;
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
    .profile-avatar-modern:hover {
        transform: scale(1.05);
        box-shadow: 0 0 32px #0a58ca;
    }
    .profile-card-modern {
        border-radius: 1.5rem;
        box-shadow: 0 2px 24px rgba(13,202,240,0.13);
        border: none;
        margin-top: 0;
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
    }
    .profile-section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0a58ca;
        margin-bottom: 0.7rem;
        margin-top: 1.7rem;
        letter-spacing: 0.5px;
    }
    .profile-info-list p {
        margin-bottom: 0.5rem;
        font-size: 1.07rem;
        color: #222;
    }
    .profile-badge {
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
    .profile-action-btns .btn {
        margin-right: 0.5em;
        margin-bottom: 0.5em;
        font-weight: 600;
        border-radius: 2em;
        box-shadow: 0 2px 8px rgba(13,202,240,0.10);
        transition: background 0.2s, color 0.2s;
    }
    .profile-action-btns .btn-outline-light:hover, .profile-action-btns .btn-light:hover {
        background: #0dcaf0;
        color: #fff;
    }
    .profile-hero .profile-title {
        font-size: 2.1rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 0.2em;
    }
    .profile-hero .profile-bio {
        font-size: 1.1rem;
        color: #e3f2fd;
        margin-bottom: 1.2em;
    }
    @media (max-width: 767px) {
        .profile-card-modern { padding: 1.2rem 0.5rem 1.5rem 0.5rem; }
        .profile-hero { padding: 2rem 0.5rem 1.5rem 0.5rem; }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="profile-hero">
                <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" alt="Profile Picture" class="profile-avatar-modern">
                <div class="profile-title text-capitalize">{{ $user->first_name ?? $user->name }}</div>
                <div class="profile-bio">{{ $profile->about ?? 'No bio provided.' }}</div>
                <div class="profile-action-btns mb-2">
                    @if($profile && $profile->cv)
                        <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-light btn-sm d-inline-flex align-items-center" style="gap: 0.5em;"><i class="fas fa-file-download"></i> Download CV</a>
                    @endif
                    <a href="mailto:{{ $user->email }}" title="click to send email" class="btn btn-light btn-sm"><i class="fas fa-envelope"></i> Email</a>
                </div>
            </div>
            <div class="card profile-card-modern">
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