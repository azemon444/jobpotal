@extends('layouts.account')
@section('content')
<div class="container">
    <h2>Personal Information</h2>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @include('profile._profile_form_fields')
    @csrf
    @method('PUT')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
