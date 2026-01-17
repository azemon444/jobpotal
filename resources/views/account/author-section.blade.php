@extends('layouts.account')

@section('content')
  <div class="account-layout  border">
    <div class="account-hdr text-white border-0 text-center py-4 position-relative" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem 1.5rem 0 0; box-shadow: 0 4px 24px rgba(13,202,240,0.08);">
            <div class="position-absolute top-0 start-50 translate-middle-x" style="margin-top: -60px;">
                <img src="{{ isset($profile) && $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/user-profile.png') }}" class="rounded-circle border border-4" style="width:110px;height:110px;object-fit:cover;object-position:center;box-shadow:0 0 16px #0dcaf0; background:#fff;" alt="Profile Picture">
            </div>
            <h3 class="mt-5 mb-1 fw-bold">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : explode(' ', auth()->user()->name)[0]) }}</h3>
            <h5 class="mb-2 text-light">{{ $company->title ?? '' }}</h5>
            <span class="badge" style="font-size:1rem; font-weight:500; background: rgba(255,255,255,0.85); color: #0a58ca; border: none; box-shadow: 0 1px 4px rgba(13,202,240,0.08); padding: 0.5em 1.2em;">{{ auth()->user()->email }}</span>
            <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                <a href="{{ route('profile.show') }}" class="btn btn-outline-light btn-sm" style="font-weight:500; border: 1.5px solid #fff; background: transparent;"><i class="fas fa-user"></i> View Profile</a>
                @unlessrole('admin')
                    <a href="{{ route('company.edit') }}" class="btn btn-outline-light btn-sm" style="font-weight:500; border: 1.5px solid #fff; background: transparent;"><i class="fas fa-building"></i> Edit Company</a>
                    <a href="{{ route('post.create') }}" class="btn btn-outline-light btn-sm" style="font-weight:500; border: 1.5px solid #fff; background: transparent;"><i class="fas fa-plus"></i> New Job</a>
                @endunlessrole
            </div>
            <!-- Author stats -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                            <h6 class="text-uppercase">My Posts</h6>
                            <h3 class="fw-bold">{{$company? $company->posts->count() : 0}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-th fa-2x text-info mb-2"></i>
                            <h6 class="text-uppercase">Live Posts</h6>
                            <h3 class="fw-bold">{{$livePosts?? 0}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
                            <h6 class="text-uppercase">Total Applications</h6>
                            <h3 class="fw-bold">{{$applications? $applications->count():0}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <section class="author-company-info">
          <div class="row">
              <div class="col-sm-12 col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Manage Company Details</h4>
                          <p class="mb-3 alert alert-info">For job listings you need to add Company details.</p>
                          
                          <div class="mb-3 d-flex">
                            @if(!$company)
                            <a href="{{route('company.create')}}" class="btn primary-btn mr-2">Create Company</a>
                            @else
                            @unlessrole('admin')
                                <a href="{{route('company.edit')}}" class="btn secondary-btn mr-2">Edit Company</a>
                            @endunlessrole
                            <div class="ml-auto">
                                <form action="{{route('company.destroy')}}" id="companyDestroyForm" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" id="companyDestroyBtn" class="btn danger-btn">Delete Company</a>
                                </form>
                            </div>
                            @endif
                          </div>
                          @if($company)
                          <div class="row">
                              <div class="col-sm-12 col-md-12">
                                  <div class="card">
                                      <div class="card-body text-center">
                                          <img src="{{asset($company->logo)}}" width="100px" class="img-fluid border p-2" alt="">
                                          <h5>{{$company->title}}</h5>
                                          <small>{{$company->getCategory->category_name}}</small>
                                        <a class="d-block" href="{{$company->website}}"><i class="fas fa-globe"></i></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="author-posts">
        <div class="row my-4">
          <div class="col-lg-12 col-md-8 col-sm-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">Manage Posts (Jobs)</h4>
                @unlessrole('admin')
                    <a href="{{route('post.create')}}" class="btn primary-btn">Create new job listing</a>
                @endunlessrole
              </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Level</th>
                            <th>No of vacancies</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($company)
                            @foreach($company->posts as $index=>$post)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td> <a href="{{route('post.show',['job'=>$post])}}" target="_blank" title="Go to this post">{{$post->job_title}}</a></td>
                                <td>{{$post->job_level}}</td>
                                <td>{{$post->vacancy_count}}</td>
                                <td>@php 
                                    $date = new DateTime($post->deadline);
                                    $timestamp =  $date->getTimestamp();
                                    $dayMonthYear = date('d/m/Y',$timestamp);
                                    $daysLeft = date('d', $timestamp - time()) .' days remaining';
                                    echo "$dayMonthYear <br> <span class='text-danger'> $daysLeft </span>";
                                @endphp</td>
                                <td>
                                    @if($post->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($post->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @unlessrole('admin')
                                        <a href="{{route('post.edit',['post'=>$post->id])}}" class="btn primary-btn">Edit</a>
                                        <form action="{{route('post.destroy',['post'=>$post->id])}}" class="d-inline-block" id="delPostForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delPostBtn" class="btn danger-btn">Delete</button>
                                        </form>
                                    @endunlessrole
                                </td> 
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>You havent created a company yet.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      <!--/row-->
      </section>

    </div>
  </div>
@endSection

@push('js')
<script>
    $(document).ready(function(){
        //delete author company
        $('#companyDestroyBtn').click(function(e){
            e.preventDefault();
            if(window.confirm('Are you sure you want delete the company?')){
                $('#companyDestroyForm').submit();
            }
        })
    })
</script>    
@endpush