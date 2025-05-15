<?php
namespace Home\Solid\Student\Contracts;

Interface ActivityServiceInterface
{
    public function getRecentActivities(): array;
}