<?php

namespace App\Jobs;

use App\Exceptions\ExternalRequestException;
use App\Services\External\ExternalNotifier;

class SendNotificationEmail extends Job
{
    protected $data;

    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct($data)
    {
        $this->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = new ExternalNotifier();
        if ($request->request() != 200) {
            throw new ExternalRequestException('External request failed.');
        }
                
        return true;
    }
}
