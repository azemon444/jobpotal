<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $userId = null)
    {
        // If admin is viewing another user's profile
        if ($userId && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))) {
            $user = \App\Models\User::findOrFail($userId);
            $profile = \App\Models\UserProfile::firstOrNew(['user_id' => $user->id]);
            return view('account.public-profile', compact('user', 'profile'));
        }
        // Default: show own profile
        $profile = \App\Models\UserProfile::firstOrNew(['user_id' => auth()->id()]);
        return view('account.user-account', compact('profile'));
    }

    public function editProfile()
    {
        $profile = \App\Models\UserProfile::firstOrNew(['user_id' => auth()->id()]);
        return view('account.edit-profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $profile = \App\Models\UserProfile::firstOrNew(['user_id' => $user->id]);


        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'references' => 'nullable|string',
            'profile_pic' => 'nullable|image|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:4096',
        ]);

        $profile->full_name = $request->input('full_name');
        $profile->address = $request->input('address');
        $profile->phone = $request->input('phone');
        $profile->dob = $request->input('dob');
        $profile->gender = $request->input('gender');
        $profile->nationality = $request->input('nationality');
        $profile->about = $request->input('about');
        $profile->education = $request->input('education');
        $profile->experience = $request->input('experience');
        $profile->skills = $request->input('skills');
        $profile->references = $request->input('references');

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $path = $file->store('profile_pics', 'public');
            $profile->profile_pic = 'storage/' . $path;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'public');
            $profile->cv = 'storage/' . $path;
        }

        $profile->save();

        \Alert::toast('Profile updated successfully!', 'success');
        return redirect()->route('account.index');
    }


    public function becomeEmployerView()
    {
        return view('account.become-employer');
    }

    public function becomeEmployer()
    {
        $user = User::find(auth()->user()->id);
        $user->removeRole('user');
        $user->assignRole('author');
        return redirect()->route('account.authorSection');
    }

    public function applyJobView(Request $request)
    {
        if ($this->hasApplied(auth()->user(), $request->post_id)) {
            Alert::toast('You have already applied for this job!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }else if(!auth()->user()->hasRole('user')){
            Alert::toast('You are a employer! You can\'t apply for the job! ', 'error');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $post = Post::find($request->post_id);
        $company = $post->company()->first();
        return view('account.apply-job', compact('post', 'company'));
    }

    public function applyJob(Request $request)
    {
        $application = new JobApplication;
        $user = User::find(auth()->user()->id);

        if ($this->hasApplied($user, $request->post_id)) {
            Alert::toast('You have already applied for this job!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $application->user_id = auth()->user()->id;
        $application->post_id = $request->post_id;
        $application->save();


        // Notify employer
        $post = Post::find($request->post_id);
        if ($post && $post->company && $post->company->user) {
            $employer = $post->company->user;
            $employer->notify(new \App\Notifications\NewJobApplicationNotification($user->name, $post->job_title, $post->id));
        }

        Alert::toast('Thank you for applying! Wait for the company to respond!', 'success');
        return redirect()->route('post.show', ['job' => $request->post_id]);
    }

    public function changePasswordView()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'error');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
            'confirm_password' => 'required|min:8'
        ]);

        $authUser = auth()->user();
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (!Hash::check($currentP, $authUser->password)) {
            Alert::toast('Current password is incorrect!', 'error');
            return redirect()->back();
        }

        if ($newP !== $confirmP) {
            Alert::toast('New passwords do not match!', 'error');
            return redirect()->back();
        }

        $user = User::find($authUser->id);
        $user->password = Hash::make($newP);
        if ($user->save()) {
            Alert::toast('Password Changed Successfully!', 'success');
            return redirect()->route('account.index');
        } else {
            Alert::toast('Something went wrong while saving the password!', 'error');
        }
        return redirect()->back();
    }

    public function deactivateView()
    {
        return view('account.deactivate');
    }

    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);
        Auth::logout($user->id);
        if ($user->delete()) {
            Alert::toast('Your account was deleted successfully!', 'info');
            return redirect(route('post.index'));
        } else {
            return view('account.deactivate');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function hasApplied($user, $postId)
    {
        $applied = $user->applied()->where('post_id', $postId)->get();
        if ($applied->count()) {
            return true;
        } else {
            return false;
        }
    }

    // Author replies to admin feedback on their job post
    public function replyFeedback(Request $request, $id)
    {
        $request->validate([
            'author_reply' => 'nullable|string|max:2000',
        ]);
        $post = \App\Models\Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $post->author_reply = $request->input('author_reply');
        $post->save();
        \RealRashid\SweetAlert\Facades\Alert::toast('Reply sent to admin!', 'success');
        return redirect()->back();
    }
}
