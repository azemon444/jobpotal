@extends('layouts.employer')

@section('content')
  <div class="employer-content border bg-light">
    <div class="container py-4">
      <div class="row mb-4">
        <div class="col-md-3 text-center">
          <img src="{{asset($company->logo)}}" class="rounded-circle border border-3 mb-3" style="width:120px;height:120px;object-fit:cover;object-position:center;box-shadow:0 0 10px #aaa;" alt="Company Logo">
          <h4 class="fw-bold mt-2">{{ $company->title }}</h4>
          <span class="badge bg-info mb-2">{{ $company->website }}</span>
          <p class="small text-muted">Category: {{ $company->getCategory->category_name ?? '-' }}</p>
        </div>
        <div class="col-md-9">
          <div class="card shadow-sm mb-3">
            <div class="card-header bg-gradient-primary text-white">
              <h5 class="mb-0">Employer Profile</h5>
            </div>
            <div class="card-body">
              <p><strong>Company:</strong> {{ $company->title }}</p>
              <p><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
              <p><strong>Category:</strong> {{ $company->getCategory->category_name ?? '-' }}</p>
              <p><strong>Jobs Posted:</strong> {{ $company->posts->count() }}</p>
              <p><strong>Contact Email:</strong> {{ $company->email ?? '-' }}</p>
              <p><strong>Address:</strong> {{ $company->address ?? '-' }}</p>
              @unlessrole('admin')
              <div class="d-flex gap-2 mt-2">
                <a href="{{ route('company.edit') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Edit Company</a>
                <a href="{{ route('post.create') }}" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> New Job</a>
              </div>
              @endunlessrole
            </div>
          </div>
          <div class="card shadow-sm">
            <div class="card-header bg-gradient-secondary text-white">
              <h5 class="mb-0">Latest Vacancies</h5>
            </div>
            <div class="card-body">
              @forelse ($company->posts as $post)
              <div class="row mb-4 hover-shadow pb-2 pt-4">
                <div class="col-md-8">
                  <a href="{{route('post.show',['job'=>$post])}}" class="secondary-link pb-2 d-block"><h5 class="font-weight-bold">{{$post->job_title}}</h5></a>
                  <p class="h6">{{$company->title}}</p>
                  <p class="small"><i class="fas fa-map-marker-alt"></i> {{$post->job_location}}</p>
                  <p class="small"><i class="fas fa-lightbulb"></i> Skills (English): {{$post->skills}}</p>
                  <div class="d-flex justify-content-between py-3">
                    <div class="text-danger">
                      <i class="fas fa-clock"></i> <span class="">Apply Before: 
                        @php    
                        $date = new DateTime($post->deadline);  
                        echo date('d', $date->getTimestamp() - time());
                        @endphp day[s] from now</span>
                    </div>
                    <div class="text-info">
                      <i class="fas fa-eye"></i> <span>Views: {{$post->views}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 text-end">
                  @unlessrole('admin')
                  <a href="{{route('post.edit',['post'=>$post])}}" class="btn btn-outline-primary btn-sm">Edit</a>
                  <form action="{{route('post.destroy',['post'=>$post->id])}}" class="d-inline-block" id="delPostForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delPostBtn" class="btn btn-outline-danger btn-sm">Delete</button>
                  </form>
                  @endunlessrole
                </div>
              </div>
              @empty
              <p class="text-muted">No jobs posted yet.</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection

