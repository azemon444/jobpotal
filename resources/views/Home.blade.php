  <!-- Search bar now in navbar/header -->
@extends('layouts.post')

@section('content')
  <!-- ...search and heading removed; jobs list will show immediately... -->

  <!-- Modern homepage intro -->
  <div class="container-fluid py-5 homepage-hero-bg">
    <div class="row justify-content-center">
      <div class="col-lg-10 text-center animate-fade-in" style="animation: fadeInUp 1.2s;">
  <h2 class="fw-bold mb-2 homepage-hero-title">Find Your Next Job</h2>
  <p class="mb-3 homepage-hero-desc">Search and explore the latest job openings from top companies across Bangladesh.</p>
      </div>
    </div>
  </div>
  {{-- Jobs List --}}
  <section class="jobs-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-header animate-fade-in">
            <h2 class="section-title">Latest Job Opportunities</h2>
            <a href="{{ route('job.index') }}" class="btn btn-dark btn-lg animate-pulse">
              <i class="fas fa-list me-2"></i>Show All Jobs
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        @forelse($posts as $post)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card job-card h-100 animate-slide-up">
              <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                  <img src="{{ asset($post->company->logo) }}" alt="{{ $post->company->title }}" class="company-logo me-3">
                  <div class="flex-grow-1">
                    <h5 class="card-title mb-1">
                      <a href="{{ route('post.show', $post->id) }}" class="job-title-link">{{ $post->job_title }}</a>
<style>
@keyframes fadeInUp {
  0% { opacity: 0; transform: translateY(30px); }
  100% { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}
.job-title-link:hover {
  text-decoration: underline;
  color: #3949ab !important;
}
</style>
                    </h5>
                    <p class="company-name mb-1">{{ $post->company->title }}</p>
                    <p class="job-location mb-0"><i class="fas fa-map-marker-alt me-1"></i>{{ $post->job_location }}</p>
                  </div>
                </div>
                <div class="job-details mb-3">
                  <span class="badge me-2">{{ $post->job_level }}</span>
                  <span class="badge">{{ $post->employment_type }}</span>
                </div>
                <div class="job-meta">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="salary mb-0"><strong>{{ $post->salary }}</strong></p>
                    <p class="deadline text-muted mb-0">{{ date('M d, Y', strtotime($post->deadline)) }}</p>
                  </div>
                </div>
                <div class="card-footer bg-transparent border-0 p-0 mt-3">
                  <a href="{{ route('post.show', $post->id) }}" class="btn btn-info btn-sm w-100">
                    <i class="fas fa-eye me-1"></i>View Details
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="text-center py-5 animate-fade-in">
              <i class="fas fa-briefcase fa-3x mb-3 homepage-hero-icon"></i>
@push('css')
<style>
.homepage-hero-bg {
  background: linear-gradient(135deg, #e3f0ff 0%, #f8e8ff 100%);
  min-height:180px;
}
.homepage-hero-title {
  color: #1a237e;
  animation: fadeIn 1.5s;
}
.homepage-hero-desc {
  color: #374151;
  animation: fadeIn 2s;
}
.homepage-hero-icon {
  color: #3949ab;
}
</style>
@endpush
              <h4>No Jobs Available</h4>
              <p style="color:#607d8b;">Check back later for new job opportunities.</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  {{-- Top Employers --}}
  <section class="employers-section py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-header text-center animate-fade-in">
            <h2 class="section-title">Top Employers</h2>
            <p class="section-subtitle">Leading companies hiring on our platform</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        @foreach ($topEmployers as $employer)
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="employer-card text-center animate-slide-up">
              <a href="{{ route('account.employer', ['employer' => $employer]) }}" class="text-decoration-none">
                <div class="employer-logo-wrapper">
                  <img src="{{ asset($employer->logo) }}" alt="{{ $employer->title }}" class="employer-logo">
                </div>
                <h6 class="employer-name mt-2">{{ $employer->title }}</h6>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
