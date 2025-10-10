<nav class="navbar navbar-expand-md navbar-white bg-white border-bottom sticky-top" id="navbar">
  <div class="container">
  <a href="{{URL('/')}}" class="navbar-brand">
  JobPortal
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item dropdown dropdown-left"> 
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span> 
      @php
        $profilePic = null;
        if(auth()->check()) {
          $profile = \App\Models\UserProfile::where('user_id', auth()->id())->first();
          if($profile && $profile->profile_pic) {
            $profilePic = asset($profile->profile_pic);
          }
        }
      @endphp
      <span style="display:inline-block;width:40px;height:40px;vertical-align:middle;overflow:hidden;border-radius:50%;">
        <img src="{{ $profilePic ?? asset('images/user-profile.png') }}" alt="Profile Picture" style="width:40px;height:40px;object-fit:cover;object-position:center;border-radius:50%;display:block;">
      </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 
            @role('admin')
            <a class="dropdown-item" href="{{route('account.dashboard')}}"> <i class="fas fa-cogs fa-sm "></i> Dashboard</a> 
            @endrole
            @role('author')
            <a class="dropdown-item" href="{{route('account.authorSection')}}"> <i class="fa fa-cogs fa-sm "></i> Author Dashboard </a> 
            @endrole
            <a class="dropdown-item" href="{{route('account.index')}}"> <i class="fas fa-user fa-sm "></i> Profile </a> 
            <a class="dropdown-item" href="{{route('account.changePassword')}}"> <i class="fas fa-key fa-sm "></i> Change Password </a> 
              <div class="dropdown-divider"></div> 
              <a class="dropdown-item" href="{{route('account.logout')}}"> 
                <i class="fas fa-sign-out-alt"></i> 
                Logout 
              </a>
          </div>
        </li>
        @endauth
        @guest
        <a href="/login" class="btn primary-btn">Sign up or Log in</a>
        @endguest
      </ul>
    </div>
  </div>
 
</nav>