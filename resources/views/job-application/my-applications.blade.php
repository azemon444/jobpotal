@extends('layouts.account')
@section('content')
  <div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
      My Applications
    </div>
    <div class="account-bdy p-3">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <p class="mb-3 alert alert-primary">These are the jobs you have applied for.</p>
          <div class="table-responsive pt-3">
            <table class="table table-hover table-striped small">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Job Title</th>
                  <th>Company</th>
                  <th>Applied On</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if($applications && $applications->count())
                  @foreach($applications as $i => $application)
                  <tr>
                    <td>{{ $applications->firstItem() + $i }}</td>
                    <td><a href="{{ route('post.show', ['job' => $application->post->id]) }}">{{ $application->post->job_title }}</a></td>
                    <td>{{ $application->post->company->title ?? '-' }}</td>
                    <td>{{ $application->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('post.show', ['job' => $application->post->id]) }}" class="btn btn-outline-primary btn-sm">View Job</a></td>
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5">You haven't applied for any jobs yet.</td>
                  </tr>
                @endif
              </tbody>
            </table>
            @if($applications)
              {{ $applications->links() }}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
