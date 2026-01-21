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
                                            <th style="width:5%">#</th>
                                            <th style="width:25%">Name</th>
                                            <th style="width:25%">Email</th>
                                            <th style="width:15%">Jobs Applied</th>
                                            <th style="width:30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobSeekers as $user)
                                            <tr class="text-center align-middle">
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td class="align-middle">{{$user->applied->count()}}</td>
                                                <td>
                                                    <a href="{{ route('account.index', ['user' => $user->id]) }}" class="btn btn-info btn-sm">View</a>
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
                                        <tr class="text-center align-middle">
                                            <th style="width:5%">#</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:20%">Email</th>
                                            <th style="width:20%">Company name</th>
                                            <th style="width:15%">Job Posts</th>
                                            <th style="width:20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentAuthors as $author)
                                            @if ($author->company)
                                            <tr class="text-center align-middle">
                                                <td>{{$author->id}}</td>
                                                <td>{{$author->name}}</td>
                                                <td>{{$author->email}}</td>
                                                <td>{{$author->company->title}}</td>
                                                <td>{{$author->company->posts->count()}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <a href="{{route('account.employer',['employer'=>$author->company->id])}}" class="btn btn-info btn-sm">View</a>
                                                        <form action="{{ route('company.destroy') }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="company_id" value="{{$author->company->id}}">
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this company?')">Remove</button>
                                                        </form>
                                                    </div>
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
                        <div id="jobs-section" class="dashboard-section" style="display:none;">
                            <h4 class="mb-3 fw-bold">All Job Posts</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>#</th><th>Job Title</th><th>Company</th><th>Location</th><th>Salary</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Post::with('company')->get() as $job)
                                            <tr>
                                                <td>{{$job->id}}</td>
                                                <td>{{$job->job_title}}</td>
                                                <td>{{$job->company->title ?? ''}}</td>
                                                <td>{{$job->job_location ?? '-'}}</td>
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
                                    <button class="btn btn-info btn-sm">Add</button>
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
                                                    <a href="{{ route('category.edit', ['category'=>$category]) }}" class="btn btn-info btn-sm">Edit</a>
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
                                                <td>{{$post->job_title}}</td>
                                                <td>{{$post->company->title ?? ''}}</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <a href="{{ route('post.show', ['job' => $post->id]) }}" class="btn btn-info btn-sm">View Post</a>
                                                    <!-- Admin comment form for feedback before approval -->
                                                    <form action="{{ route('admin.sendFeedback', $post->id) }}" method="POST" class="mb-2">
                                                        @csrf
                                                        <textarea name="admin_feedback" class="form-control mb-1" rows="2" placeholder="Add a comment for the author (optional)">{{$post->admin_feedback}}</textarea>
                                                        <button class="btn btn-warning btn-sm" type="submit">Send Comment</button>
                                                    </form>
                                                    @if($post->author_reply)
                                                        <div class="alert alert-info p-2 mb-2"><strong>Author Reply:</strong> {{ $post->author_reply }}</div>
                                                    @endif
                                                    <form action="{{ route('admin.approvePost', $post->id) }}" method="POST" class="d-inline" onsubmit="setTimeout(function(){ updatePendingPostCount(-1); }, 100);">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    <form action="{{ route('admin.rejectPost', $post->id) }}" method="POST" class="d-inline" onsubmit="setTimeout(function(){ updatePendingPostCount(-1); }, 100);">
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
    
    <!-- Manage Roles and Categories section removed from admin dashboard -->
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
