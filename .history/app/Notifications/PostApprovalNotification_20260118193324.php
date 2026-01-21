<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PostApprovalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $status;
    protected $postTitle;

    public function __construct($status, $postTitle)
    {
        $this->status = $status;
        $this->postTitle = $postTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your job post '{$this->postTitle}' has been {$this->status} by admin.",
            'status' => $this->status,
            'post_title' => $this->postTitle,
        ];
    }
}
