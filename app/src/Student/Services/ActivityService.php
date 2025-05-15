<?php 

namespace Home\Solid\Student\Services;

use Home\Solid\Student\Contracts\ActivityServiceInterface;

class ActivityService implements ActivityServiceInterface{
    public function getRecentActivities(): array{
        return [
            ['title' => 'Logged In'],
            ['title' => 'Updated Profile'],
            ['title' => 'Submitted Assignment'],
            ['title' => 'Participated in Discussion'],
            ['title' => 'Logged Out']
        ];
    }
}