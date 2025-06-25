<?php

namespace App\Repository;

use App\Model\Notification;

class NotificationRepository
{
    public function findById(int $id): ?Notification
    {
        return Notification::find($id);
    }
}