@extends('layouts.account')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">User Profile Information</h5>
                    <small>Below is the detailed information of the selected user/applicant.</small>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-12 text-center mb-3 mb-md-0">
                            <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" alt="Profile Picture" class="rounded-circle border profile-avatar" style="width:110px;height:110px;object-fit:cover;object-position:center;box-shadow:0 0 12px #ccc; background:#fff;">
                        </div>
                        <div class="col-md-9 col-12">
                            <h4 class="text-primary text-capitalize fw-bold mb-1">{{ $user->first_name ?? $user->name }}</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $user->email }}</p>
                                    <p class="mb-1"><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $profile->phone ?? '-' }}</p>
                                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> {{ $profile->address ?? '-' }}</p>
                                    <p class="mb-1"><strong>Gender:</strong> {{ $profile->gender ?? '-' }}</p>
                                    <p class="mb-1"><strong>DOB:</strong> {{ $profile->dob ?? '-' }}</p>
                                    <p class="mb-1"><strong>Nationality:</strong> {{ $profile->nationality ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>About:</strong> {{ $profile->about ?? '-' }}</p>
                                    <p class="mb-1"><strong>Education:</strong> {{ $profile->education ?? '-' }}</p>
                                    <p class="mb-1"><strong>Experience:</strong> {{ $profile->experience ?? '-' }}</p>
                                    <p class="mb-1"><strong>Skills (English):</strong> {{ $profile->skills ?? '-' }}</p>
                                    <p class="mb-1"><strong>References:</strong> {{ $profile->references ?? '-' }}</p>
                                </div>
                            </div>
                            @if($profile && $profile->cv)
                                <div class="my-2">
                                    <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center" style="gap: 0.5em;"><i class="fas fa-file-download"></i> Download CV (PDF)</a>
                                </div>
                            @endif
                            <a href="mailto:{{ $user->email }}" title="click to send email" class="btn primary-btn mt-2">Send user an email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection