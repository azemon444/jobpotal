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
        return [
            'message' => $this->applicantName . ' applied for your job: ' . $this->jobTitle,
            'url' => url('/account/job-application?job=' . urlencode($this->jobTitle)),
        ];
    }
}
