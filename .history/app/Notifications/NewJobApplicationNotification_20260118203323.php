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
    protected $postId;

    public function __construct($applicantName, $jobTitle, $postId)
    {
        $this->applicantName = $applicantName;
        $this->jobTitle = $jobTitle;
        $this->postId = $postId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->applicantName . ' applied for your job: ' . $this->jobTitle,
            'url' => url('/job/' . $this->postId),
        ];
    }
}
