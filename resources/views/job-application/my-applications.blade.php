@extends('layouts.account')
@section('content')
<div class="container py-4">
  <div class="account-layout border shadow-sm rounded">
    <div class="account-hdr bg-primary text-white border rounded-top px-4 py-3">
      <h4 class="mb-0">My Applications</h4>
    </div>
    <div class="account-bdy p-4">
      <p class="mb-3 alert alert-primary">These are the jobs you have applied for.</p>
      <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Job Title</th>
              <th scope="col">Company</th>
              <th scope="col">Applied On</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($applications && $applications->count())
              @foreach($applications as $i => $application)
              <tr>
                <td>{{ $applications->firstItem() + $i }}</td>
                <td><a href="{{ route('post.show', ['job' => $application->post->id]) }}" class="fw-bold text-primary">{{ $application->post->job_title }}</a></td>
                <td>{{ $application->post->company->title ?? '-' }}</td>
                <td>{{ $application->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('post.show', ['job' => $application->post->id]) }}" class="btn btn-outline-primary btn-sm">View Job</a></td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5" class="text-center">You haven't applied for any jobs yet.</td>
              </tr>
            @endif
          </tbody>
        </table>
        @if($applications)
          <div class="d-flex justify-content-center mt-3">
            {{ $applications->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
