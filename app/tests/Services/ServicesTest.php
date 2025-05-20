<?php

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use Home\Solid\Student\Services\ActivityService;

class ServicesTest extends TestCase
{
    public function testActivityService()
    {

        // Create an instance of the ActivityService
        $activityService = new ActivityService();

        // Call the method to be tested
        $activities = $activityService->getRecentActivities();

        // Assert that the returned activities are as expected
        $this->assertIsArray($activities);
        $this->assertCount(5, $activities);
    }
}