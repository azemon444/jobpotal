<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('job.index');
    }

    //api route
    public function search(Request $request)
    {
        $posts = Post::query()->with('company');

        // Multiple simultaneous filters
        if ($request->q) {
            $posts->where(function ($query) use ($request) {
                $query->where('job_title', 'LIKE', '%' . $request->q . '%')
                      ->orWhere('skills', 'LIKE', '%' . $request->q . '%')
                      ->orWhereHas('company', function ($subQuery) use ($request) {
                          $subQuery->where('title', 'LIKE', '%' . $request->q . '%');
                      });
            });
        }

        if ($request->company_id) {
            $posts->where('company_id', $request->company_id);
        }

        if ($request->category_id) {
            $posts->whereHas('company', function ($query) use ($request) {
                $query->where('company_category_id', $request->category_id);
            });
        }

        if ($request->job_level) {
            $posts->where('job_level', 'LIKE', '%' . $request->job_level . '%');
        }

        if ($request->education_level) {
            $posts->where('education_level', 'LIKE', '%' . $request->education_level . '%');
        }

        if ($request->employment_type) {
            $posts->where('employment_type', 'LIKE', '%' . $request->employment_type . '%');
        }

        if ($request->location) {
            $posts->where('job_location', 'LIKE', '%' . $request->location . '%');
        }

        if ($request->min_salary && $request->max_salary) {
            $posts->whereBetween('salary', [$request->min_salary, $request->max_salary]);
        } elseif ($request->min_salary) {
            $posts->where('salary', '>=', $request->min_salary);
        } elseif ($request->max_salary) {
            $posts->where('salary', '<=', $request->max_salary);
        }

        if ($request->experience_years) {
            $posts->where('experience_years', '<=', $request->experience_years);
        }

        if ($request->posted_within) {
            $date = Carbon::now()->subDays($request->posted_within);
            $posts->where('created_at', '>=', $date);
        }

        // Order by relevance and date
        $posts->orderBy('created_at', 'desc');

        $posts = $posts->paginate(12);

        return $posts->toJson();
    }
    public function getCategories()
    {
        $categories = CompanyCategory::all();
        return $categories->toJson();
    }
    public function getAllOrganization()
    {
        $companies = Company::all();
        return $companies->toJson();
    }
    public function getAllByTitle()
    {
        $posts = Post::where('deadline', '>', Carbon::now())->get()->pluck('id', 'job_title');
        return $posts->toJson();
    }
}
