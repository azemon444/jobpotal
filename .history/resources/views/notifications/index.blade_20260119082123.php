@extends('layouts.account')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Notifications</h3>
        @if($notifications->where('read_at', null)->count())
        <form method="POST" action="{{ route('notifications.markAllRead') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-primary">Mark all as read</button>
        </form>
        @endif
    </div>
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            @if($notifications->count())
                <ul class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                @if(isset($notification->data['url']))
                                    <a href="{{ $notification->data['url'] }}" class="text-decoration-none">
                                        {{ $notification->data['message'] ?? $notification->data['title'] ?? 'Notification' }}
                                    </a>
                                @else
                                    {{ $notification->data['message'] ?? $notification->data['title'] ?? 'Notification' }}
                                @endif
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
