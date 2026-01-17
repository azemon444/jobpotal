@extends('layouts.account')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-lg border-0 mb-4" style="border-radius: 1.5rem; background: #f8f9fa;">
                <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem 1.5rem 0 0;">
                    <h2 class="fw-bold mb-0">Edit Profile</h2>
                </div>
                <div class="card-body p-4">
                    <!-- Dashboard and Profile buttons removed for cleaner UI -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Left column fields -->
                                <div class="form-group mb-3">
                                    <label for="profile_pic">Profile Picture</label><br>
                                    @if($profile && $profile->profile_pic)
                                        <img src="{{ asset($profile->profile_pic) }}" alt="Profile Picture" class="img-thumbnail mb-2" style="max-width:100px;">
                                    @endif
                                    <input type="file" name="profile_pic" class="form-control-file">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cv">CV/Resume (PDF)</label>
                                    @if($profile && $profile->cv)
                                        <a href="{{ asset($profile->cv) }}" target="_blank">Download Current CV</a><br>
                                    @endif
                                    <input type="file" name="cv" class="form-control-file" accept="application/pdf">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $profile->full_name ?? '') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $profile->address ?? '') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone ?? '') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $profile->dob ?? '') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Male" {{ (old('gender', $profile->gender ?? '') == 'Male') ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ (old('gender', $profile->gender ?? '') == 'Female') ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ (old('gender', $profile->gender ?? '') == 'Other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $profile->nationality ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Right column fields -->
                                <div class="form-group mb-3">
                                    <label for="education">Education</label>
                                    <textarea name="education" class="form-control" rows="2">{{ old('education', $profile->education ?? '') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="experience">Experience</label>
                                    <textarea name="experience" class="form-control" rows="2">{{ old('experience', $profile->experience ?? '') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="skills">Skills</label>
                                    <textarea name="skills" class="form-control" rows="2">{{ old('skills', $profile->skills ?? '') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="references">References</label>
                                    <textarea name="references" class="form-control" rows="2">{{ old('references', $profile->references ?? '') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control" rows="3">{{ old('about', $profile->about ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card {
        border-radius: 1.5rem;
    }
    .form-control, .form-control-file, .form-select {
        border-radius: 0.5rem;
        min-height: 44px;
        font-size: 1rem;
    }
    .form-group label {
        font-weight: 500;
        color: #0a58ca;
    }
    .img-thumbnail {
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(13,202,240,0.12);
    }
    .btn-primary {
        background: linear-gradient(90deg, #0dcaf0 60%, #0a58ca 100%);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #0a58ca 60%, #0dcaf0 100%);
    }
    .card-header {
        border-bottom: none;
    }
    body, .card, .card-body {
        background: #f8f9fa !important;
        color: #23272b !important;
    }
    @media (max-width: 767px) {
        .card-body .row > div {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endsection
