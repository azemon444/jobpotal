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
    protected $applicationUrl;

    public function __construct($applicantName, $jobTitle, $applicationUrl)
    {
        $this->applicantName = $applicantName;
        $this->jobTitle = $jobTitle;
        $this->applicationUrl = $applicationUrl;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->applicantName . ' applied for your job: ' . $this->jobTitle,
            'url' => $this->applicationUrl,
        ];
    }
}
