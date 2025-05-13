<?php 

namespace Home\Solid\Student\Services;

class ActivityService{
    public function getRecentActivities(): array{
        return [
            'joined boot camp',
            'Submitted project report',
            'Participated in hackathon'
        ];
    }
}