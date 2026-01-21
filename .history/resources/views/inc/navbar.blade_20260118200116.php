<nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top shadow-sm" id="navbar">
  <div class="container-fluid">
    <a href="{{URL('/')}}" class="navbar-brand fw-bold text-primary">
      <i class="fas fa-briefcase me-2"></i>JobPortal
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="mx-auto" style="max-width:520px;width:100%;">
        <form class="d-flex" action="{{ url('search') }}" method="GET" autocomplete="off">
          <input id="search-q" type="text" name="q" placeholder="Search jobs, companies..." class="form-control me-2" style="min-width:180px;" list="company-list">
          <datalist id="company-list">
            @isset($topEmployers)
              @foreach($topEmployers as $employer)
                <option value="{{ $employer->title }}">
              @endforeach
            @endisset
          </datalist>
          <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
        </form>
      </div>
      <ul class="navbar-nav ms-auto align-items-center">
        @auth
        <!-- Notification Icon -->
        <li class="nav-item me-2">
          <a class="nav-link position-relative" href="{{ route('notifications.index') }}" title="Notifications">
            <i class="fas fa-bell fa-lg"></i>
            @php
              $unreadCount = auth()->user()->unreadNotifications()->count();
            @endphp
            @if($unreadCount > 0)
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.7em;">
                {{ $unreadCount }}
                <span class="visually-hidden">unread notifications</span>
              </span>
            @endif
          </a>
        </li>
        <li class="nav-item dropdown d-flex align-items-center">
          <a class="nav-link d-flex align-items-center text-decoration-none" href="{{ route('account.index') }}" id="userAccountLink">
            <span class="me-2 d-none d-lg-inline text-body small fw-medium">{{ auth()->user()->first_name ?? (method_exists(auth()->user(), 'getFirstName') ? auth()->user()->getFirstName() : explode(' ', auth()->user()->name)[0]) }}</span>
            @php
              $profilePic = null;
              if(auth()->check()) {
                $profile = \App\Models\UserProfile::where('user_id', auth()->id())->first();
                if($profile && $profile->profile_pic) {
                  $profilePic = asset($profile->profile_pic);
                }
              }
            @endphp
            <img src="{{ $profilePic ?? asset('images/user-profile.png') }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
          </a>
          <!-- Removed dropdown toggle and down arrow for cleaner UI -->
          <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
            @role('admin')
            <li><a class="dropdown-item" href="{{route('account.dashboard')}}"><i class="fas fa-cogs fa-sm me-2"></i>Dashboard</a></li>
            @endrole
            @role('author')
            <li><a class="dropdown-item" href="{{route('account.authorSection')}}"><i class="fas fa-cogs fa-sm me-2"></i>Author Dashboard</a></li>
            @endrole
            <li><a class="dropdown-item" href="{{route('account.index')}}"><i class="fas fa-user fa-sm me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="{{route('account.changePassword')}}"><i class="fas fa-key fa-sm me-2"></i>Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="dropdown-item" style="border: none; background: none; padding: 0; width: 100%; text-align: left;"><i class="fas fa-sign-out-alt fa-sm me-2"></i>Logout</button>
            </form></li>
          </ul>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a href="/login" class="btn btn-primary btn-sm px-3">Sign up or Log in</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
