<div class="account-nav">
  <ul class="list-group">
    <!-- Profile Section -->
    <li class="list-group-item list-group-item-action">
      <a href="{{ route('account.index') }}" class="account-nav-link">
        <i class="fas fa-id-card"></i> Profile Overview
      </a>
    </li>
    @role('user')
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'my-applications' ? 'active': ''}}">
      <a href="{{route('jobApplication.myApplications')}}" class="account-nav-link">
        <i class="fas fa-briefcase"></i> My Applications
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'my-saved-jobs' ? 'active': ''}}">
      <a href="{{route('savedJob.index')}}" class="account-nav-link">
        <i class="fas fa-stream"></i> Saved Jobs
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'become-employer' ? 'active': ''}}">
      <a href="{{route('account.becomeEmployer')}}" class="account-nav-link">
        <i class="fas fa-user-tie"></i> Become an Employer
      </a>
    </li>
    @endrole
    @role('author')
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'author-section' ? 'active': ''}}">
      <a href="{{route('account.authorSection')}}" class="account-nav-link">
        <i class="fas fa-chart-line"></i> Author Dashboard
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'post' && request()->segment(3) == 'create' ? 'active': ''}}">
      <a href="{{route('post.create')}}" class="account-nav-link">
        <i class="fas fa-plus-square"></i> Create Job Listing
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'job-application' ? 'active': ''}}">
      <a href="{{route('jobApplication.index')}}" class="account-nav-link">
        <i class="fas fa-bell"></i> Applications Received
      </a>
    </li>
    @endrole
    @role('admin')
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'pending-posts' ? 'active': ''}}">
      <a href="{{route('admin.pendingPosts')}}" class="account-nav-link">
        <i class="fas fa-tasks"></i> Pending Job Posts
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'dashboard' ? 'active': ''}}">
      <a href="{{route('account.dashboard')}}" class="account-nav-link">
        <i class="fas fa-chart-line"></i> Admin Dashboard
      </a>
    </li>
    @endrole
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'change-password' ? 'active': ''}}">
      <a href="{{route('account.changePassword')}}" class="account-nav-link">
        <i class="fas fa-fingerprint"></i> Change Password
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'deactivate' ? 'active': ''}}">
      <a href="{{route('account.deactivate')}}" class="account-nav-link">
        <i class="fas fa-user-slash"></i> Close Account
      </a>
    </li>
    <li class="list-group-item list-group-item-action">
      <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="account-nav-link btn btn-danger w-100 text-start" style="font-weight:600;"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </li>
  </ul>
</div>