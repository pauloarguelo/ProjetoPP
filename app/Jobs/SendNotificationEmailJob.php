<?php

namespace App\Jobs;

use App\Exceptions\ExternalRequestException;
use App\Services\External\ExternalNotifier;
use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\App;

class SendNotificationEmailJob extends Job
{
    protected $notificationId;

    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = New ExternalNotifier();

        if ($request->request() != 200) {
            throw new ExternalRequestException('External request failed.');
        }
        $notificationService = App::make(NotificationService::class);
        $notificationService->markNotificationAsDelivered($this->notificationId);
        
        return true;
    }
}
