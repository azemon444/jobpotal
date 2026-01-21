@extends('layouts.post')

@section('content')
<section class="show-page pt-4 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <div class="job-listing border">
          <div class="company-info">
            <div class="company-banner">
              <div class="banner-overlay"></div>
              @if($company->cover_img == 'nocover')
              <img src="{{asset('images/companies/nocover.jpg')}}" class="company-banner-img img-fluid" alt="">
              @else
              <img src="{{asset($company->cover_img)}}" class="company-banner-img img-fluid" alt="">
              @endif
              <div class="company-media">
                <img src="{{asset($company->logo)}}" alt="" class="company-logo">
                <div>
                  <a href="{{route('account.employer',['employer'=>$company])}}" class="secondary-link">
                    <p class="font-weight-bold">{{$company->title}}</p>
                    <p class="company-category">{{$company->getCategory->category_name}}</p>
                  </a>
                </div>
              </div>
              <div class="company-website">
                <a href="{{$company->website}}" target="_blank"><i class="fas fa-globe"></i></a>
              </div>
            </div>

            {{-- company information --}}
            <div class="p-3">
              <p>{{$company->description}}</p>
            </div>
          </div>

          {{-- job information --}}
          <div class="job-info">
            <div class="job-hdr p-3">
              <p class="job-title">{{$post->job_title}}</p>
              <div class="">
                <p class="job-views">
                  <span class="text-success">Views: {{$post->views}} </span> |
                  <span class="text-danger">Apply Before: {{date('d',$post->remainingDays())}} days</span>
                </p>
              </div>
            </div>
            <div class="job-bdy p-3 my-3">
              <div class="job-level-description">
                <p class="font-weight-bold">Basic job level description</p>
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td width="33%">Job Category</td>
                      <td width="3%">:</td>
                      <td width="64%"><a href="/jobs">{{$company->getCategory->category_name}}</a></td>
                    </tr>
                    <tr>
                      <td width="33%">Job Level</td>
                      <td width="3%">:</td>
                      <td width="64%">{{$post->job_level}}</td>
                    </tr>
                    <tr>
                      <td width="33%">No of vacancy[s]</td>
                      <td width="3%">:</td>
                      <td width="64%">[ <strong>{{$post->vacancy_count}}</strong> ]</td>
                    </tr>
                    <tr>
                      <td width="33%">Employment type</td>
                      <td width="3%">:</td>
                      <td width="64%">{{$post->employment_type}}</td>
                    </tr>
                    <tr>
                      <td width="33%">Offered Salary(Monthly)</td>
                      <td width="3%">:</td>
                      <td width="64%">{{$post->salary}}</td>
                    </tr>
                    <tr>
                      <td width="33%">Apply before(Deadline)</td>
                      <td width="3%">:</td>
                      <td width="64%" class="text-danger">{{date('l, jS \of F Y',$post->deadlineTimestamp())}}, ({{ date('d',$post->remainingDays())}} days from now)</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="job-level-description">
                <p class="font-weight-bold">Job Specification</p>
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td width="33%">Education level</td>
                      <td width="3%">:</td>
                      <td width="64%"><a href="/jobs"> {{$post->education_level}}</a></td>
                    </tr>
                    <tr>
                      <td width="33%">Experience Required</td>
                      <td width="3%">:</td>
                      <td width="64%">{{$post->experience}}</td>
                    </tr>
                    <tr>
                      <td width="33%">Key Skills (English)</td>
                      <td width="3%">:</td>
                      <td width="64%">
                        @foreach($post->getSkills() as $skill)
                        <span class="badge badge-primary">{{ $skill }}</span>
                        @endforeach
                      </td>
                    </tr>
                    <tr>
                      <td width="33%">Job Location</td>
                      <td width="3%">:</td>
                      <td width="64%">
                        <span class="badge badge-info">{{ $post->job_location }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="job-level-description">
                {{-- <p class="font-weight-bold">More Specifications</p> --}}
                <p class="py-2">{!!$post->specifications!!}</p>
              </div>
              <br>
              <hr>
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
                <div>
                  @if(!Auth::user() || Auth::user()->hasRole('user') || Auth::user()->hasRole('jobseeker'))
                    <a href="{{route('account.applyJob',['post_id'=>$post])}}" class="btn primary-btn">Apply now</a>
                    <a href="{{route('savedJob.store',['id'=>$post])}}" class="btn primary-outline-btn"><i class="fas fa-star"></i> Save job</a>
                  @endif
                </div>
                <div class="social-links">
                  <a href="https://www.facebook.com"  target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>
                  <a href="https://www.twitter.com" target="_blank"  class="btn btn-primary"><i class="fab fa-twitter"></i></a>
                  <a href="https://www.linkedin.com"  target="_blank" class="btn btn-primary"><i class="fab fa-linkedin"></i></a>
                  <a href="https://www.gmail.com" target="_blank"  class="btn btn-primary"><i class="fas fa-envelope"></i></a>
                </div>
                @if(Auth::check() && Auth::user()->hasRole('admin'))
                  @if($post->status === 'pending')
                  <div class="admin-action-modern card shadow-sm border-0 p-4 mb-4" style="max-width:540px; background: #f8fafc;">
                    <div class="row g-2 mb-3">
                      <div class="col-12 col-md-6">
                        <form action="{{ route('admin.approvePost', $post->id) }}" method="POST">
                          @csrf
                          <button class="btn btn-success w-100 py-2 fw-semibold rounded-pill d-flex align-items-center justify-content-center gap-2" type="submit" style="font-size:1.1em; box-shadow:0 2px 8px rgba(40,167,69,0.08);">
                            <i class="fas fa-check-circle"></i> Approve
                          </button>
                        </form>
                      </div>
                      <div class="col-12 col-md-6">
                        <form action="{{ route('admin.rejectPost', $post->id) }}" method="POST">
                          @csrf
                          <button class="btn btn-danger w-100 py-2 fw-semibold rounded-pill d-flex align-items-center justify-content-center gap-2" type="submit" style="font-size:1.1em; box-shadow:0 2px 8px rgba(220,53,69,0.08);">
                            <i class="fas fa-times-circle"></i> Reject
                          </button>
                        </form>
                      </div>
                    </div>
                    <form action="{{ route('admin.sendFeedback', $post->id) }}" method="POST" class="mt-2">
                      @csrf
                      <label for="admin_feedback" class="form-label fw-bold text-primary mb-1">Admin Comment</label>
                      <textarea name="admin_feedback" id="admin_feedback" class="form-control mb-3 rounded-4 shadow-sm border-0" rows="3" placeholder="Leave a comment for the author..." style="resize:vertical; background:#f4f7fb;"></textarea>
                      <button class="btn btn-warning w-100 py-2 fw-semibold rounded-pill d-flex align-items-center justify-content-center gap-2" type="submit" style="font-size:1.1em; box-shadow:0 2px 8px rgba(255,193,7,0.08);">
                        <i class="fas fa-paper-plane"></i> Send Comment
                      </button>
                    </form>
                  </div>
                  @endif
                  @if($post->admin_feedback)
                    <div class="card shadow-sm border-0 p-4 mt-4" style="max-width:540px; background: #f8fafc;">
                      <div class="mb-2 fw-bold text-primary"><i class="fas fa-comments me-2"></i>Admin Comment</div>
                      <div class="ps-2 mb-2"><strong>Admin:</strong> {{ $post->admin_feedback }}</div>
                      @if($post->author_reply)
                        <div class="ps-2 mt-2"><strong>Author:</strong> {{ $post->author_reply }}</div>
                      @endif
                    </div>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="card d-none d-md-block mb-3">
          <div class="card-header">
            Job Action
          </div>
          <div class="card-body">
            <div class="btn-group w-100">
              @if(!Auth::user() || Auth::user()->hasRole('user') || Auth::user()->hasRole('jobseeker'))
                <a href="{{route('account.applyJob',['post_id'=>$post->id])}}" class="btn primary-outline-btn float-left">Apply Now</a>
                <a href="{{route('savedJob.store',['id'=>$post->id])}}" class="btn primary-btn"><i class="fas fa-star"></i> Save job</a>
              @endif
            </div>
          </div>
        </div>
        <div class="card ">
          <div class="card-header">
            Similar Jobs
          </div>
          <div class="card-body">
            <div class="similar-jobs">
              @if($similarJobs && $similarJobs->count())
                @foreach ($similarJobs as $job)
                  <div class="job-item border-bottom row">
                    <div class="col-4">
                      <img src="{{asset($job->company->logo)}}" class="company-logo" alt="">
                    </div>
                    <div class="job-desc col-8">
                      <a href="{{route('post.show',['job'=>$job->id])}}" class="job-category text-muted font-weight-bold">
                        <p class="text-muted h6">{{$job->job_title}}</p>
                        <p class="small">{{$job->company->title}}</p>
                        <p class="font-weight-normal small text-danger">Deadline: {{$job->remainingDays()}} days</p>
                      </a>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="card">
                  <div class="card-header">
                    <p>No similar jobs</p>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('css')
<style>
  .company-banner {
    min-height: 20vh;
    position: relative;
    overflow: hidden;
  }
  .company-banner-img {
    width: 100%;
    height: auto;
    overflow: hidden;
  }
  .banner-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, .3));
    width: 100%;
    height: 200px;
  }
  .company-website {
    position: absolute;
    right: 20px;
    bottom: 20px;
    color: white;
  }
  .company-media {
    position: absolute;
    display: flex;
    align-items: center;
    left: 2rem;
    bottom: 1rem;
    color: #333;
    padding-right: 2rem;
    background-color:rgba(255,255,255,.8);
  }
  .company-logo {
    max-width: 100px;
    height: auto;
    margin-right: 1rem;
    padding: 1rem;
    background-color: white;
  }
  .company-category {
    font-size: 1.3rem;
  }
  .job-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--bs-primary, #185a91);
    margin-bottom: 0.5rem;
  }
  .job-hdr {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(to right, #e1edf7, #EDF2F7);
    border-radius: 0.5rem;
  }
  .job-views {
    font-size: 1rem;
    color: var(--bs-text-muted, #6c757d);
    margin-bottom: 0;
  }
  .table-hover td, .table-hover th {
    font-size: 1rem;
    color: var(--bs-text-color, #212529);
  }
  .badge-primary {
    background-color: var(--bs-primary, #185a91) !important;
    color: #fff !important;
    font-size: 0.95em;
    font-weight: 500;
    border-radius: 0.4em;
    padding: 0.4em 0.8em;
  }
  .badge-info {
    background-color: var(--bs-info, #0dcaf0) !important;
    color: #fff !important;
    font-size: 0.95em;
    font-weight: 500;
    border-radius: 0.4em;
    padding: 0.4em 0.8em;
  }
  .job-level-description p.font-weight-bold {
    font-size: 1.1rem;
    color: var(--bs-primary, #185a91);
    margin-bottom: 0.5rem;
  }
  .job-level-description p {
    color: var(--bs-text-color, #212529);
    font-size: 1rem;
  }
  .job-level-description table td {
    vertical-align: middle;
  }
  .job-level-description .badge {
    margin-right: 0.3em;
  }
  .job-level-description a {
    color: var(--bs-primary, #185a91);
    text-decoration: none;
    font-weight: 500;
  }
  .job-level-description a:hover {
    color: var(--bs-primary-hover, #023966);
    text-decoration: underline;
  }
  .job-bdy .btn, .job-bdy .btn-primary, .job-bdy .btn-primary-outline {
    font-size: 1rem;
    border-radius: 0.375rem;
    font-weight: 500;
  }
  .social-links .btn {
    border-radius: 50%;
    width: 2.2rem;
    height: 2.2rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    margin-right: 0.3rem;
    background: var(--bs-primary, #185a91);
    color: #fff;
    transition: background 0.2s;
  }
  .social-links .btn:hover {
    background: var(--bs-primary-hover, #023966);
    color: #fff;
  }
  .job-item {
    margin-bottom: .5rem;
    padding: .5rem 0;
    font-size: 1rem;
    color: var(--bs-text-color, #212529);
  }
  .job-item:hover {
    background-color: #eee;
  }
  .job-category, .job-category:visited {
    color: var(--bs-primary, #185a91);
    text-decoration: none;
    font-weight: 500;
  }
  .job-category:hover {
    color: var(--bs-primary-hover, #023966);
    text-decoration: underline;
  }
  .h6, h6, .h5, h5, .h4, h4, .h3, h3, .h2, h2, .h1, h1 {
    color: var(--bs-primary, #185a91);
    font-weight: 600;
  }
  /* Remove underline from all links by default in this view */
  a, a:visited {
    text-decoration: none;
    color: var(--bs-primary, #185a91);
  }
  a:hover {
    text-decoration: underline;
    color: var(--bs-primary-hover, #023966);
  }
</style>
@endpush

@push('js')

@endpush