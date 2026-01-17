@extends('layouts.account')
@section('content')
<div class="account-layout  border">
  <div class="account-hdr text-white border-0 text-center py-4 position-relative" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem 1.5rem 0 0; box-shadow: 0 4px 24px rgba(13,202,240,0.08);">
   Become an employer in {{config('app.name')}}
  </div>
  <div class="account-bdy p-3">
    <div class="row">
      <div class="col-sm-12 col-md-4">
        <p class="lead">Upgrade to Author Role</p>
      </div>
      <div class="col-sm-12 col-md-8">
        <div>
          <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">Usually this should be validated by Admin but for testing it is one click away to become an employer.</span> </p>
          <div class="my-4">
          <p class="my-3">Click the button to assign <span class="text-primary">Author roles</span> to your account.</p>
            <form action="{{route('account.becomeEmployer')}}" method="POST">
              @csrf
              <div class="form-group">
                <div class="d-flex">
                  <button type="submit" class="btn primary-outline-btn">Become Employer</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection