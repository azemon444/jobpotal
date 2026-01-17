@extends('layouts.account')

@section('content')
  <div class="account-layout  border">
  <div class="account-hdr text-white border-0 text-center py-4 position-relative" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); border-radius: 1.5rem 1.5rem 0 0; box-shadow: 0 4px 24px rgba(13,202,240,0.08);">
      VIewing all users <span class="badge badge-primary">Any Role</span>
    </div>
    <div class="account-bdy p-3">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="table-responsive pt-3">
            <table class="table table-hover table-striped small">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Company</th>
                  <th>Created on</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if($users->count()) 
                @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                  <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                  <td>{{ $user->company->title ?? '-' }}</td>
                  <td>{{$user->created_at}}</td>
                  <td>
                    <a href="{{ route('account.employer', ['employer' => $user->company->id ?? 0]) }}" class="btn btn-outline-info btn-sm {{ empty($user->company) ? 'disabled' : '' }}">View Employer</a>
                    <form action="{{route('account.destroyUser')}}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>There isn't any users.</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                @endif 
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-4 custom-pagination">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
