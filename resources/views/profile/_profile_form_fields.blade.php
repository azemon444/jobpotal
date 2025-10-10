<div class="form-group">
    <label for="profile_pic">Profile Picture</label><br>
    @if($profile && $profile->profile_pic)
        <img src="{{ asset($profile->profile_pic) }}" alt="Profile Picture" class="img-thumbnail mb-2" style="max-width:100px;">
    @endif
    <input type="file" name="profile_pic" class="form-control-file">
</div>
<div class="form-group">
    <label for="cv">CV/Resume (PDF)</label>
    @if($profile && $profile->cv)
        <a href="{{ asset($profile->cv) }}" target="_blank">Download Current CV</a><br>
    @endif
    <input type="file" name="cv" class="form-control-file" accept="application/pdf">
</div>
<div class="form-group">
    <label for="full_name">Full Name</label>
    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $profile->full_name ?? '') }}">
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $profile->address ?? '') }}">
</div>
<div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone ?? '') }}">
</div>
<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" class="form-control" value="{{ old('dob', $profile->dob ?? '') }}">
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" class="form-control">
        <option value="">Select</option>
        <option value="Male" {{ (old('gender', $profile->gender ?? '') == 'Male') ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ (old('gender', $profile->gender ?? '') == 'Female') ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ (old('gender', $profile->gender ?? '') == 'Other') ? 'selected' : '' }}>Other</option>
    </select>
</div>
<div class="form-group">
    <label for="nationality">Nationality</label>
    <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $profile->nationality ?? '') }}">
</div>
<div class="form-group">
    <label for="education">Education</label>
    <textarea name="education" class="form-control">{{ old('education', $profile->education ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="experience">Experience</label>
    <textarea name="experience" class="form-control">{{ old('experience', $profile->experience ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="skills">Skills</label>
    <textarea name="skills" class="form-control">{{ old('skills', $profile->skills ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="references">References</label>
    <textarea name="references" class="form-control">{{ old('references', $profile->references ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="about">About</label>
    <textarea name="about" class="form-control">{{ old('about', $profile->about ?? '') }}</textarea>
</div>
