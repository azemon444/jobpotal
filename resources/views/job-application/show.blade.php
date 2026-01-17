@extends('layouts.account')

@section('content')
<div class="account-layout border">
  <div class="account-hdr bg-primary text-white border">
    Job Application
  </div>
  <div class="account-bdy p-3">
  <p class="alert alert-primary">User named <span class="text-capitalize"> ({{$applicant->name}})</span> applied for your listing on {{$application->created_at}}</p>
    <div class="row">
      <div class="col-sm-12 col-md-12 mb-5">
        <div class="card">
          <div class="card-header">
            User Profile (Applicant)
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                @if($profile && $profile->profile_pic)
@push('css')
<style>
  .profile-crop.job-app {
    width: 100px;
    height: 100px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
  }
</style>
@endpush
          <img src="{{ asset($profile->profile_pic) }}" class="profile-crop job-app" alt="Profile Picture">
                @else
                  <img src="{{ asset('images/user-profile.png') }}" class="profile-crop job-app" alt="Profile Picture">
                @endif
              </div>
              <div class="col-9">
                <h6 class="text-info text-capitalize">{{$profile->full_name ?? $applicant->name}}</h6>
                <p class="my-2"><i class="fas fa-envelope"></i> Email: {{$applicant->email}}</p>
                @if($profile)
                    <p class="my-2"><i class="fas fa-phone"></i> Phone: {{$profile->phone}}</p>
                    <p class="my-2"><i class="fas fa-map-marker-alt"></i> Address: {{$profile->address}}</p>
                    <p class="my-2">Gender: {{$profile->gender}}, DOB: {{$profile->dob}}</p>
                    <p class="my-2">Nationality: {{$profile->nationality}}</p>
                    <p class="my-2">About: {{$profile->about}}</p>
                    <!-- CV download button will be moved to the end -->
                    @if($profile->education)
                      <p class="my-2"><strong>Education:</strong> {{$profile->education}}</p>
                    @endif
                    @if($profile->experience)
                      <p class="my-2"><strong>Experience:</strong> {{$profile->experience}}</p>
                    @endif
                    @if($profile->skills)
                      <p class="my-2"><strong>Skills (English):</strong> {{$profile->skills}}</p>
                    @endif
                    @if($profile->references)
                      <p class="my-2"><strong>References:</strong> {{$profile->references}}</p>
                    @endif
                    @if($profile && $profile->cv)
                      <div class="my-2">
                        <a href="{{ asset($profile->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center" style="gap: 0.5em;">
                          <i class="fas fa-file-download"></i> Download CV (PDF)
                        </a>
                      </div>
                    @endif
                  @endif
                <a href="mailto:{{$applicant->email}}" class="btn primary-btn" title="click to send email">Send user an email</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-12">
        <div class="card">
          <div class="card-header">
            Key Job Requirements
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3 d-flex align-items-center border p-3">
                <img src="{{asset($company->logo)}}" class="img-fluid" alt="">
              </div>
              <div class="col-9">
                <p class="h4 text-info text-capitalize">
                  {{$post->job_title}}
                </p>
                <h6 class="text-uppercase">
                  <a href="{{route('account.employer',['employer'=>$company])}}">{{$company->title}}</a>
                </h6>
                <p class="my-2"><i class="fas fa-map-marker-alt"></i> Location: {{$post->job_location}}</p>
                <p class="text-danger small">{{date('l, jS \of F Y',$post->deadlineTimestamp())}}, ({{ date('d',$post->remainingDays())}} days from now)</p>
              </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
              <div class="my-2">
                <a href="{{route('post.show',['job'=>$post])}}" class="secondary-link"><i class="fas fa-briefcase"></i> View job</a>
              </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
              <div class="small">
                <a href="{{route('jobApplication.index')}}" class="btn primary-outline-btn">Go back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection