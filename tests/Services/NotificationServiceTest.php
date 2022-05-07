<?php

namespace Tests\Services;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class NotificationTest extends TestCase
{   

    protected $notificationService;

    public function setUp() : void
    {
        parent::setUp();
        $this->notificationService = $this->app->make('App\Services\Notification\NotificationService');
    }


    public function test_create_new_notification()
    {
        $notification = $this->notificationService->notifyUser(1, 'Test', 'Test Notification');
        $this->assertArrayHasKey('id', $notification);
        return $notification["id"];
    }

    /**
     * @depends test_create_new_notification
     */
    public function test_mark_notification_as_delivered($notification_id)
    {
        $notification = $this->notificationService->markNotificationAsDelivered($notification_id);
        $this->assertEquals(true, $notification);	
    }
}