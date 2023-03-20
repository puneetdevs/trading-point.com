<?php

namespace App\Listeners;

use App\Events\FormSubmissionCreated;
use App\Jobs\SendNewAgencyUserNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendFormSubmissionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    public function handle(FormSubmissionCreated $event)
    {
        $data = $event->data;

        dispatch(new SendNewAgencyUserNotificationJob($data));
        Log::info('Job Dispatched');
    }
}
