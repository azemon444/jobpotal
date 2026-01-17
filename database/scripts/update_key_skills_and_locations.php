<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// Run with: php artisan tinker < database/scripts/update_key_skills_and_locations.php

$validLocations = [
    'Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Sylhet', 'Barisal', 'Rangpur', 'Mymensingh'
];
$keySkills = [
    'Communication, Teamwork, Problem Solving',
    'PHP, Laravel, MySQL',
    'Sales, Negotiation, CRM',
    'Marketing, SEO, Content Writing',
    'Graphic Design, Adobe Photoshop, Creativity',
    'Project Management, Leadership, Agile',
    'Customer Service, Empathy, Patience',
    'Data Analysis, Excel, Reporting',
    'Networking, Security, Troubleshooting',
    'JavaScript, React, Vue.js',
    'Mobile Development, Android, iOS',
    'Accounting, Bookkeeping, Taxation',
    'Business Analysis, Documentation, Planning',
    'Copywriting, Editing, Research',
    'Python, Machine Learning, AI',
    'Public Speaking, Presentation, Training',
];

$posts = DB::table('posts')->get();
foreach ($posts as $post) {
    // Fix location if not valid
    $location = in_array($post->job_location, $validLocations) ? $post->job_location : $validLocations[array_rand($validLocations)];
    // Assign new key skills
    $skills = $keySkills[array_rand($keySkills)];
    DB::table('posts')->where('id', $post->id)->update([
        'job_location' => $location,
        'skills' => $skills,
    ]);
}
echo "All job posts updated with valid BD locations and English key skills.\n";
