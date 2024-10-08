<?php

namespace App\Jobs;

use App\Models\Admin;
use App\Notifications\ExportNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendExportNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $notificationData;
    public function __construct(Admin $user, array $notificationData)
    {
        $this->user = $user;
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->user, new ExportNotification($this->notificationData));
    }
}
