<?php

namespace App\Jobs;

use App\Events\ExportFilesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExportEvent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

     public $user;

     public $message;
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new ExportFilesEvent($this->user, $this->message));
    }
}
