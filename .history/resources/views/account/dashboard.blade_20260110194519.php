@extends('layouts.account')

@section('content')
    <div style="background: #f8f9fa;">
        <div class="modern-profile-header text-center py-4" style="background: linear-gradient(135deg, #0dcaf0 60%, #0a58ca 100%); color: #fff; font-weight: 600; border-radius: 1.5rem 1.5rem 0 0; box-shadow: 0 4px 24px rgba(13,202,240,0.08); border: none;">
            <h2 class="fw-bold mb-1" style="color: #fff;">Dashboard</h2>
            <!-- Profile button removed for admin dashboard -->
            <!-- Dark theme styles removed: only light theme is used -->
            <!-- Admin dashboard: stats and management only, no profile completeness bar -->
        </div>
        <div class="account-bdy p-4">
                <div class="row g-4 mb-4 justify-content-center" style="position:relative;z-index:10;">
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-live-posts">
                                <i class="fas fa-star-of-life fa-2x mb-2"></i>
                                <div class="fw-bold">Pending Posts</div>
                                <div class="fs-4" id="pending-post-count">{{$dashCount['pendingPost']}}</div>
                            </button>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <button class="dashboard-btn w-100 text-center" id="show-users">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <div class="fw-bold">Job Seeker</div>
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
                            <button class="dashboard-btn w-100 text-center" id="show-categories">
                                <i class="fas fa-industry fa-2x mb-2"></i>
                                <div class="fw-bold">Categories</div>
                                <div class="fs-4">{{$dashCount['companyCategory']}}</div>
                            </button>
                        </div>
                    </div>

                    <div id="dashboard-sections">
                        <div id="users-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">Job Seekers</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <!-- Manage Roles and Categories section removed as per request -->
    const dashboardBtns = document.querySelectorAll('.dashboard-btn');
    dashboardBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.dashboard-section').forEach(sec => sec.style.display = 'none');
            dashboardBtns.forEach(b => b.classList.remove('active-tab'));
            this.classList.add('active-tab');
            // Show only the relevant section
            if(this.id === 'show-users') document.getElementById('users-section').style.display = 'block';
            else if(this.id === 'show-authors') document.getElementById('authors-section').style.display = 'block';
            else if(this.id === 'show-jobs') document.getElementById('jobs-section').style.display = 'block';
            else if(this.id === 'show-categories') document.getElementById('categories-section').style.display = 'block';
            else if(this.id === 'show-live-posts') document.getElementById('live-posts-section').style.display = 'block';
        });
    });
    // Set Users as default active tab and section only on first page load
    function showPendingPostsSection() {
        dashboardBtns.forEach(b => b.classList.remove('active-tab'));
        document.querySelectorAll('.dashboard-section').forEach(sec => sec.style.display = 'none');
        // Activate Pending Posts tab and section
        document.getElementById('show-live-posts').classList.add('active-tab');
        document.getElementById('live-posts-section').style.display = 'block';
    }
    document.addEventListener('DOMContentLoaded', showPendingPostsSection);
    window.addEventListener('pageshow', showPendingPostsSection);
    function updatePendingPostCount(change) {
        var countElem = document.getElementById('pending-post-count');
        if(countElem) {
            var current = parseInt(countElem.textContent);
            if(!isNaN(current)) {
                countElem.textContent = Math.max(0, current + change);
            }
        }
    }
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
        border: 2px solid transparent;
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
    .dashboard-btn.active-tab {
        background: linear-gradient(135deg, #0a58ca 60%, #0dcaf0 100%) !important;
        color: #fff !important;
        outline: none;
    }
    .dashboard-btn.active-tab > i,
    .dashboard-btn.active-tab .fa-users,
    .dashboard-btn.active-tab .fa-building,
    .dashboard-btn.active-tab .fa-user-tie,
    .dashboard-btn.active-tab .fa-star-of-life,
    .dashboard-btn.active-tab .fa-industry {
        color: #ffb700 !important;
        transition: color 0.2s;
    }
</style>
            <!-- Authors table and pagination below dashboard buttons removed. Authors section is only shown when Authors button is clicked. -->
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
                                <label for="category_name_input">Add a new Category</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="category_name_input" placeholder="Company category name" name="category_name">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Dashboard stat block buttons logic
        const sectionMap = {
            'show-users': 'users-section',
            'show-authors': 'authors-section',
            'show-jobs': 'jobs-section',
            'show-categories': 'categories-section',
            'show-live-posts': 'live-posts-section'
        };
        function showSection(sectionId) {
            document.querySelectorAll('.dashboard-section').forEach(sec => sec.style.display = 'none');
            if (sectionId && document.getElementById(sectionId)) {
                document.getElementById(sectionId).style.display = 'block';
            }
        }
        // Attach click handlers
        Object.keys(sectionMap).forEach(btnId => {
            const btn = document.getElementById(btnId);
            if (btn) {
                btn.addEventListener('click', function() {
                    showSection(sectionMap[btnId]);
                });
            }
        });
        // Show users section by default
        showSection('users-section');

        // Delete category button logic (existing)
        const catBtn = document.getElementById('categoryDestroyBtn');
        if (catBtn) {
            catBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if(window.confirm('Are you sure you want delete the Category?')){
                    const form = document.getElementById('categoryDestroyForm');
                    if(form) form.submit();
                }
            });
        }
    });
</script>
@endpush
