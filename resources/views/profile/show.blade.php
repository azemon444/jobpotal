@extends('layouts.account')
@section('content')
<div class="container">
    <h2>Personal Information</h2>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @if(isset($profile) && $profile && $profile->profile_pic)
@push('css')
<style>
    .profile-crop.profile-show {
        width: 120px;
        height: 120px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }
</style>
@endpush
                    <img src="{{ asset($profile->profile_pic) }}" class="profile-crop profile-show mb-2" alt="Profile Picture">
                @else
                    <img src="{{ asset('images/user-profile.png') }}" class="profile-crop profile-show mb-2" alt="Profile Picture">
                @endif
            </div>
            <p><strong>Full Name:</strong> {{ $profile->full_name ?? '' }}</p>
            <p><strong>Address:</strong> {{ $profile->address ?? '' }}</p>
            <p><strong>Phone:</strong> {{ $profile->phone ?? '' }}</p>
            <p><strong>Date of Birth:</strong> {{ $profile->dob ?? '' }}</p>
            <p><strong>Gender:</strong> {{ $profile->gender ?? '' }}</p>
            <p><strong>Nationality:</strong> {{ $profile->nationality ?? '' }}</p>
            <p><strong>About:</strong> {{ $profile->about ?? '' }}</p>
            @if($profile && $profile->education)
                <p><strong>Education:</strong> {{ $profile->education }}</p>
            @endif
            @if($profile && $profile->experience)
                <p><strong>Experience:</strong> {{ $profile->experience }}</p>
            @endif
            @if($profile && $profile->skills)
                <p><strong>Skills:</strong> {{ $profile->skills }}</p>
            @endif
            @if($profile && $profile->references)
                <p><strong>References:</strong> {{ $profile->references }}</p>
            @endif
            @if($profile && $profile->cv)
                <div class="my-2">
                    <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center" style="gap: 0.5em;">
                        <i class="fas fa-file-download"></i> Download CV (PDF)
                    </a>
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('profile.edit') }}" class="btn btn-secondary mt-3">Edit Information</a>
</div>
@endsection
