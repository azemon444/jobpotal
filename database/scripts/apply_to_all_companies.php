<?php

use App\Models\Company;
use App\Models\Post;
use App\Models\User;
use App\Models\JobApplication;

$user = User::where('email', 'user@user.com')->first();
if ($user) {
    foreach (Company::all() as $company) {
        $post = Post::where('company_id', $company->id)->first();
        if ($post) {
            JobApplication::firstOrCreate([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }
    }
}
echo "Done.\n";
