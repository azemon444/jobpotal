@extends('layouts.account')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" alt="Profile Picture" class="profile-crop job-app">
                </div>
                <div class="col-9">
                    <h6 class="text-info text-capitalize">{{ $user->first_name ?? $user->name }}</h6>
                    <p class="my-2"><i class="fas fa-envelope"></i> Email: {{ $user->email }}</p>
                    <p class="my-2"><i class="fas fa-phone"></i> Phone: {{ $profile->phone ?? '-' }}</p>
                    <p class="my-2"><i class="fas fa-map-marker-alt"></i> Address: {{ $profile->address ?? '-' }}</p>
                    <p class="my-2">Gender: {{ $profile->gender ?? '-' }}, DOB: {{ $profile->dob ?? '-' }}</p>
                    <p class="my-2">Nationality: {{ $profile->nationality ?? '-' }}</p>
                    <p class="my-2">About: {{ $profile->about ?? '-' }}</p>
                    <p class="my-2"><strong>Education:</strong> {{ $profile->education ?? '-' }}</p>
                    <p class="my-2"><strong>Experience:</strong> {{ $profile->experience ?? '-' }}</p>
                    <p class="my-2"><strong>Skills (English):</strong> {{ $profile->skills ?? '-' }}</p>
                    <p class="my-2"><strong>References:</strong> {{ $profile->references ?? '-' }}</p>
                    @if($profile && $profile->cv)
                    <div class="my-2">
                        <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center" style="gap: 0.5em;"><i class="fas fa-file-download"></i> Download CV (PDF)</a>
                    </div>
                    @endif
                    <a href="mailto:{{ $user->email }}" title="click to send email" class="btn primary-btn">Send user an email</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection