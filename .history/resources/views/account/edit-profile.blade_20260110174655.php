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
                <h4 class="fw-bold text-center mb-1" style="color:#fff;">{{ auth()->user()->first_name ?? $profile->full_name ?? '' }}</h4>
                <div class="text-center mb-3">
                    <span class="badge bg-white text-primary px-3 py-2 mb-2" style="font-size:1em; font-weight:600;">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-8 col-12">
            <div class="profile-main p-4 bg-white border shadow-sm h-100">
                <h5 class="fw-bold mb-4 text-primary">Edit Profile</h5>
                <!-- Removed duplicate form and contents, only the modern layout remains -->
                    <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $profile->address ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $profile->phone ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $profile->dob ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">Select</option>
                                                <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ old('gender', $profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $profile->nationality ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="about" class="form-label">About</label>
                                            <textarea class="form-control" id="about" name="about" rows="2">{{ old('about', $profile->about ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="education" class="form-label">Education</label>
                                            <textarea class="form-control" id="education" name="education" rows="2">{{ old('education', $profile->education ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Experience</label>
                                            <textarea class="form-control" id="experience" name="experience" rows="2">{{ old('experience', $profile->experience ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Skills (English)</label>
                                            <textarea class="form-control" id="skills" name="skills" rows="2">{{ old('skills', $profile->skills ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="references" class="form-label">References</label>
                                            <textarea class="form-control" id="references" name="references" rows="2">{{ old('references', $profile->references ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="cv" class="form-label">CV (PDF)</label>
                                            <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf">
                                            @if($profile && $profile->cv)
                                                <a href="{{ asset($profile->cv) }}" target="_blank" class="d-block mt-2">Download current CV</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="profile_pic" class="form-label">Profile Picture</label>
                                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
                                            @if($profile && $profile->profile_pic)
                                                <img src="{{ asset($profile->profile_pic) }}" alt="Profile Picture" class="mt-2 rounded" style="width:80px;height:80px;object-fit:cover;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-light text-primary fw-bold"><i class="fas fa-save"></i> Save Changes</button>
                            <a href="{{ route('account.index') }}" class="btn btn-outline-secondary ms-2"><i class="fas fa-arrow-left"></i> Cancel</a>
                        </div>
                    </form>
                <!-- Removed duplicate form and contents, only the modern layout remains -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
