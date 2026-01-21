<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewJobApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $applicantName;
    protected $jobTitle;

    public function __construct($applicantName, $jobTitle)
    {
        $this->applicantName = $applicantName;
        $this->jobTitle = $jobTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Find the post by job title and employer (notifiable)
        $post = \App\Models\Post::where('job_title', $this->jobTitle)
            ->whereHas('company', function($q) use ($notifiable) {
                $q->where('user_id', $notifiable->id);
            })->first();
        $url = $post ? url('/account/job-application/' . $post->id) : url('/account/job-application');
        return [
            'message' => $this->applicantName . ' applied for your job: ' . $this->jobTitle,
            'url' => $url,
        ];
    }
}
