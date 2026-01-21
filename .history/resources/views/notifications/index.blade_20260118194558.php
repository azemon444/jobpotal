@extends('layouts.account')
@section('content')
<div class="container py-4">
    <h3 class="mb-4">Notifications</h3>
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            @if($notifications->count())
                <ul class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $notification->data['message'] ?? $notification->data['title'] ?? 'Notification' }}
                                <br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if($notification->unread())
                                <span class="badge bg-primary">New</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted mb-0">You have no notifications.</p>
            @endif
        </div>
    </div>
</div>
@endsection
