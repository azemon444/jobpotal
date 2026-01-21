<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
    // Admin sends feedback (comment) to author for a pending job post
    public function sendFeedback(Request $request, $id)
    {
        $request->validate([
            'admin_feedback' => 'nullable|string|max:2000',
        ]);
        $post = Post::findOrFail($id);
        $post->admin_feedback = $request->input('admin_feedback');
        $post->save();
        \RealRashid\SweetAlert\Facades\Alert::toast('Comment sent to author!', 'info');
        return redirect()->back();
    }
{
    public function dashboard()
    {
    $authors = User::role('author')->with('company')->paginate(30);
    $jobSeekers = User::role('user')->with('applied')->get();
    $roles = Role::all();
    $permissions = Permission::all();
        $rolesHavePermissions = Role::with('permissions')->get();

        $dashCount = [];
        $dashCount['author'] = User::role('author')->count();
        $dashCount['user'] = User::role('user')->count();
        $dashCount['post'] = Post::count();
    $dashCount['pendingPost'] = Post::where('status', 'pending')->count();
        $dashCount['companyCategory'] = CompanyCategory::count();
        $dashCount['profileViews'] = 0; // Replace with actual logic if available

        $user = auth()->user();
        $profile = $user->profile ?? \App\Models\UserProfile::where('user_id', $user->id)->first();
        return view('account.dashboard')->with([
            'companyCategories' => CompanyCategory::all(),
            'dashCount' => $dashCount,
            'recentAuthors' => $authors,
            'jobSeekers' => $jobSeekers,
            'roles' => $roles,
            'permissions' => $permissions,
            'rolesHavePermissions' => $rolesHavePermissions,
            'profile' => $profile,
        ]);
    }
    public function viewAllUsers()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->latest()->paginate(30);
        return view('account.view-all-users')->with([
            'users' => $users
        ]);
    }

    public function destroyUser(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($user->delete()) {
            Alert::toast('Deleted Successfully!', 'danger');
            return redirect()->route('account.viewAllUsers');
        } else {
            return redirect()->intented('account.viewAllUsers');
        }
    }

    // List all pending posts for approval
    public function pendingPosts()
    {
        $pendingPosts = Post::where('status', 'pending')->with('company')->latest()->paginate(20);
        return view('account.pending-posts', compact('pendingPosts'));
    }

    // Approve a post
    public function approvePost($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'approved';
        $post->save();
        \RealRashid\SweetAlert\Facades\Alert::toast('Post approved!', 'success');
        return redirect()->back();
    }

    // Reject a post
    public function rejectPost($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'rejected';
        $post->save();
        \RealRashid\SweetAlert\Facades\Alert::toast('Post rejected!', 'warning');
        return redirect()->back();
    }

    // Admin sends feedback (comment) to author for a pending job post
    public function sendFeedback(Request $request, $id)
    {
        $request->validate([
            'admin_feedback' => 'nullable|string|max:2000',
        ]);
        $post = Post::findOrFail($id);
        $post->admin_feedback = $request->input('admin_feedback');
        $post->save();
        \RealRashid\SweetAlert\Facades\Alert::toast('Comment sent to author!', 'info');
        return redirect()->back();
    }
}
