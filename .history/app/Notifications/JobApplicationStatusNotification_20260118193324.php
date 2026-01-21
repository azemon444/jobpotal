<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class JobApplicationStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $status;
    protected $jobTitle;

    public function __construct($status, $jobTitle)
    {
        $this->status = $status;
        $this->jobTitle = $jobTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your application for '{$this->jobTitle}' has been {$this->status}.",
            'status' => $this->status,
            'job_title' => $this->jobTitle,
        ];
    }
}
