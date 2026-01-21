@extends('layouts.account')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg mb-4" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem;">
        <div class="card-header" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem 1.5rem 0 0; color: #fff; font-weight: 600; font-size: 1.3rem;">
            <h4 class="mb-0">Pending Job Posts for Approval</h4>
        </div>
        <div class="card-body">
            @if($pendingPosts->count())
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle" style="min-width:900px;">
                    <thead>
                        <tr style="background: #f8fafc; text-align:center;">
                            <th style="width:4%;">#</th>
                            <th style="width:32%;">Job Title & Comments</th>
                            <th style="width:20%;">Company</th>
                            <th style="width:14%;">Created At</th>
                            <th style="width:30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center; vertical-align:middle;">
                        @foreach($pendingPosts as $post)
                        <tr>
                            <td><span class="badge bg-secondary" style="font-size:1rem;">{{ $post->id }}</span></td>
                            <td>
                                <span style="font-weight:600; color:#0a58ca;">{{ $post->job_title }}</span>
                                @if($post->admin_feedback)
                                    <div class="alert alert-warning p-2 mt-2 mb-1" style="font-size:0.95em;"><strong>Admin Comment:</strong> {{ $post->admin_feedback }}</div>
                                @endif
                                @if($post->author_reply)
                                    <div class="alert alert-info p-2 mb-1" style="font-size:0.95em;"><strong>Author Reply:</strong> {{ $post->author_reply }}</div>
                                @endif
                            </td>
                            </td>
                            <td>{{ $post->company->title ?? '-' }}</td>
                            <td>{{ $post->company->user->name ?? '-' }}</td>
                            <td>{{ $post->created_at ? $post->created_at->format('Y-m-d') : '-' }}</td>
                            <td>
                                <div style="display: flex; flex-direction: row; align-items: flex-start; gap: 10px; justify-content: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-info btn-sm px-3 mb-1" style="border-radius:2em; font-weight:500;">View</a>
                                        <form action="{{ route('admin.approvePost', $post->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-success btn-sm px-3" style="border-radius:2em; font-weight:500;">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.rejectPost', $post->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-danger btn-sm px-3" style="border-radius:2em; font-weight:500;">Reject</button>
                                        </form>
                                    </div>
                                    <div style="display:flex; flex-direction:column; align-items:center; min-width:120px; max-width:180px;">
                                        <form action="{{ route('admin.sendFeedback', $post->id) }}" method="POST" style="width:100%; margin-top:0;">
                                            @csrf
                                            <textarea name="admin_feedback" class="form-control mb-1" rows="1" style="resize:none; min-height:24px; max-height:36px; font-size:0.95em;" placeholder="Comment...">{{ $post->admin_feedback }}</textarea>
                                            <button class="btn btn-warning btn-sm w-100" type="submit" style="font-size:0.95em; padding:2px 0;">Send</button>
                                        </form>
                                        @if($post->admin_feedback)
                                            <div class="alert alert-warning p-2 mt-2 mb-1 w-100" style="font-size:0.95em;"><strong>Admin Comment:</strong> {{ $post->admin_feedback }}</div>
                                        @endif
                                        @if($post->author_reply)
                                            <div class="alert alert-info p-2 mb-1 w-100" style="font-size:0.95em;"><strong>Author Reply:</strong> {{ $post->author_reply }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4 custom-pagination">
                {{ $pendingPosts->links() }}
            </div>
            @else
            <div class="alert alert-info">No pending posts for approval.</div>
            @endif
        </div>
    </div>
</div>
@endsection
