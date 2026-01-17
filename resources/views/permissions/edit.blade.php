@extends('layouts.account')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h4>Edit Permission</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Permission Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('account.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
