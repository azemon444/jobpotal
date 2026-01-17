<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateJobSkillsAndLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:update-skills-locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all job posts with valid Bangladesh locations and English key skills';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
            $location = in_array($post->job_location, $validLocations) ? $post->job_location : $validLocations[array_rand($validLocations)];
            $skills = $keySkills[array_rand($keySkills)];
            DB::table('posts')->where('id', $post->id)->update([
                'job_location' => $location,
                'skills' => $skills,
            ]);
        }
        $this->info('All job posts updated with valid BD locations and English key skills.');
    }
}
