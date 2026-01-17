@extends('layouts.account')

@section('content')
    <div style="background: #f8f9fa;">
        <div class="modern-profile-header text-center py-4" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); color: #fff; font-weight: 600; border-radius: 1.5rem 1.5rem 0 0; box-shadow: 0 4px 24px rgba(13,202,240,0.08); border: none;">
            <h2 class="fw-bold mb-1" style="color: #fff;">Dashboard</h2>
            <!-- Profile button removed for admin dashboard -->
            <style>
                    /* Dark mode override removed: always use the same gradient as edit profile page */
            </style>
            <style>
            @media (prefers-color-scheme: dark) {
                .account-hdr, .account-hdr h2 {
                    background: #23272b !important;
                    color: #fff !important;
                }
                .account-hdr .btn-light {
                    background: #181a1b !important;
                    color: #0dcaf0 !important;
                    border: 1px solid #444 !important;
                }
                .account-hdr .btn-light:hover {
                    background: #23272b !important;
                    color: #fff !important;
                }
            }
            </style>
            <!-- Admin dashboard: stats and management only, no profile completeness bar -->
        </div>
        <div class="account-bdy p-4">
                    <div class="row g-4 mb-4 justify-content-center">
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-users">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <div class="fw-bold">Users</div>
                                <div class="fs-4">{{$dashCount['user']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-jobs">
                                <i class="fas fa-building fa-2x mb-2"></i>
                                <div class="fw-bold">Total Jobs</div>
                                <div class="fs-4">{{$dashCount['post']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-authors">
                                <i class="fas fa-user-tie fa-2x mb-2"></i>
                                <div class="fw-bold">Authors</div>
                                <div class="fs-4">{{$dashCount['author']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-live-posts">
                                <i class="fas fa-star-of-life fa-2x mb-2"></i>
                                <div class="fw-bold">Live Posts</div>
                                <div class="fs-4">{{$dashCount['livePost']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-categories">
                                <i class="fas fa-industry fa-2x mb-2"></i>
                                <div class="fw-bold">Company Categories</div>
                                <div class="fs-4">{{$dashCount['companyCategory']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center disabled">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <div class="fw-bold">Profile Views</div>
                                <div class="fs-4">{{ $dashCount['profileViews'] ?? 0 }}</div>
                            </button>
                        </div>
                    </div>

                    <div id="dashboard-sections">
                        <div id="users-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">Job Seekers</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Name</th><th>Email</th><th>Jobs Applied</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobSeekers as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->applied->count()}}</td>
                                                <td>
                                                    <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="btn btn-info btn-sm">View Profile</a>
                                                    <form action="{{ route('account.destroyUser') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <button class="btn btn-danger btn-sm">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="authors-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">Employers</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Name</th><th>Email</th><th>Company</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentAuthors as $author)
                                            @if($author->hasRole('author'))
                                            <tr>
                                                <td>{{$author->id}}</td>
                                                <td>{{$author->name}}</td>
                                                <td>{{$author->email}}</td>
                                                <td>{{$author->company->title ?? ''}}</td>
                                                <td>
                                                    @if($author->company)
                                                        <a href="{{route('account.employer',['employer'=>$author->company->id])}}" class="btn btn-info btn-sm">View Employer</a>
                                                    @endif
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="jobs-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">All Job Posts</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Job Title</th><th>Company</th><th>Salary</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Post::with('company')->get() as $job)
                                            <tr>
                                                <td>{{$job->id}}</td>
                                                <td>{{$job->job_title}}</td>
                                                <td>{{$job->company->title ?? ''}}</td>
                                                <td>{{$job->salary ?? '-'}}</td>
                                                <td>
                                                    <a href="{{ route('post.show', ['job' => $job->id]) }}" class="btn btn-info btn-sm">View Post</a>
                                                    <button class="btn btn-danger btn-sm">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="categories-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">Company Categories</h4>
                            <div class="mb-3">
                                <form class="d-flex gap-2" method="POST" action="{{ route('category.store') }}">
                                    @csrf
                                    <input type="text" name="category_name" class="form-control" placeholder="Add new category">
                                    <button class="btn btn-primary">Add</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Name</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companyCategories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->category_name}}</td>
                                                <td>
                                                    <a href="{{ route('category.edit', ['category'=>$category]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                    <form action="{{ route('category.destroy', ['id'=>$category->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="live-posts-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">Pending Job Posts</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Title</th><th>Company</th><th>Status</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Post::where('status','pending')->with('company')->get() as $post)
                                            <tr>
                                                <td>{{$post->id}}</td>
                                                <td>{{$post->title}}</td>
                                                <td>{{$post->company->title ?? ''}}</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <form action="{{ route('admin.approvePost', $post->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    <form action="{{ route('admin.rejectPost', $post->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<script>
    document.querySelectorAll('.dashboard-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.dashboard-section').forEach(sec => sec.style.display = 'none');
            if(this.id === 'show-users') document.getElementById('users-section').style.display = 'block';
            if(this.id === 'show-authors') document.getElementById('authors-section').style.display = 'block';
            if(this.id === 'show-jobs') document.getElementById('jobs-section').style.display = 'block';
            if(this.id === 'show-categories') document.getElementById('categories-section').style.display = 'block';
            if(this.id === 'show-live-posts') document.getElementById('live-posts-section').style.display = 'block';
        });
    });
</script>
<style>
.dashboard-btn {
    display: block;
    padding: 2rem 1rem 1.2rem 1rem;
    background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%);
    color: #fff !important;
    border-radius: 1.2rem;
    box-shadow: 0 4px 24px rgba(13,202,240,0.08);
    font-size: 1.1rem;
    transition: transform 0.12s, box-shadow 0.12s;
    text-decoration: none;
}
.dashboard-btn:hover {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 8px 32px rgba(13,202,240,0.18);
    background: linear-gradient(135deg, #0a58ca 60%, #0dcaf0 100%);
    color: #fff !important;
}
.dashboard-btn.disabled {
    opacity: 0.6;
    pointer-events: none;
}
.dashboard-btn .fs-4 {
    font-size: 2rem;
    font-weight: 700;
}
</style>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAuthors as $author)
                        @if ($author->company)
                        <tr>
                            <td>{{$author->id}}</td>
                            <td>{{$author->name}}</td>
                            <td>{{$author->email}}</td>
                            <td>{{$author->company->title}}</td>
                            <td>
                            <a href="{{route('account.employer',['employer'=>$author->company->id])}}" class="btn primary-btn">View Employer</a>
                            </td> 
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button class="btn primary-outline-btn disabled">Total Number of authors registered ({{ $recentAuthors->total()}}) </button>

            <div class="d-flex justify-content-center mt-4 custom-pagination">
                {{ $recentAuthors->links() }}
              </div>
          </div>
        </div>
      <!--/row-->
      </section>
      <hr>
    
      <section class="dashboard-company">
          <h4 class="card-title text-secondary">Manage Roles and Categories</h4>
          <div class="row my-4">
            <div class="col-sm-12 col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#categories-tab" role="tab" data-bs-toggle="tab">Company Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#roles-tab" role="tab" data-bs-toggle="tab">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#permissions-tab" role="tab" data-bs-toggle="tab">Permissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#role-have-permission-tab" role="tab" data-bs-toggle="tab">Roles have permissions</a>
                    </li>
                    
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <br>
                    <div role="tabpanel" class="tab-pane active" id="categories-tab">
                        <div class="mb-3">
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <label for="">Add a new Category</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" placeholder="Company category name" name="category_name">
                                    <button class="btn secondary-btn">Add</button>
                                </div>
                                @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </form>
                        </div>
                      
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Category name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companyCategories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td><a class="btn secondary-btn" href="{{route('category.edit',['category'=>$category])}}">Edit</a> 
                                            <form action="{{route('category.destroy',['id'=>$category->id])}}" id="categoryDestroyForm" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="categoryDestroyBtn" class="btn danger-btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="roles-tab">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $index=>$role)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                <a class="btn secondary-btn" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn danger-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="permissions-tab">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $index=>$permission)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>
                                                <a class="btn secondary-btn" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn danger-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="role-have-permission-tab">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rolesHavePermissions as $index=>$role)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>
                                                {{$role->name}}
                                            </td>
                                            <td>
                                                @if($role->permissions->count() == 0)
                                                    <span class="badge badge-primary">basic auth permissions</span>
                                                @else
                                                    @foreach ($role->permissions as $permission)
                                                        <span class="badge badge-primary">{{$permission->name}}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
          </div>
      </section>
    </div>
  </div>
@endSection

@push('js')
<script>
     $(document).ready(function(){
        //delete category 
        $('#categoryDestroyBtn').click(function(e){
            e.preventDefault();
            if(window.confirm('Are you sure you want delete the Category?')){
                $('#categoryDestroyForm').submit();
            }
        })
    })
</script>
@endpush
