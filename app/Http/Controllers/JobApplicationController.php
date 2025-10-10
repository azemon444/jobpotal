<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobApplicationController extends Controller
{
    // Show all jobs the logged-in user has applied for
    public function myApplications()
    {
        $applications = JobApplication::where('user_id', auth()->id())->with('post.company')->latest()->paginate(10);
        return view('job-application.my-applications', compact('applications'));
    }
    public function index()
    {
        $applicationsWithPostAndUser = null;
        $company = auth()->user()->company;

        if ($company) {
            $ids =  $company->posts()->pluck('id');
            $applications = JobApplication::whereIn('post_id', $ids);
            $applicationsWithPostAndUser = $applications->with('user', 'post')->latest()->paginate(10);
        }

        return view('job-application.index')->with([
            'applications' => $applicationsWithPostAndUser,
        ]);
    }
    public function show($id)
    {
        $application = JobApplication::find($id);
        $post = $application->post()->first();
        $userId = $application->user_id;
        $applicant = User::find($userId);
        $profile = \App\Models\UserProfile::where('user_id', $userId)->first();
        $company = $post->company()->first();
        return view('job-application.show')->with([
            'applicant' => $applicant,
            'profile' => $profile,
            'post' => $post,
            'company' => $company,
            'application' => $application
        ]);
    }
    public function destroy(Request $request)
    {
        $application = JobApplication::find($request->application_id);
        $application->delete();
        Alert::toast('Company deleleted', 'warning');
        return redirect()->route('jobApplication.index');
    }
}
