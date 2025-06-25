<?php

namespace App\Service;

use Hyperf\Database\Model\Collection;

class WebSocketService
{
    public function sendToUser(Collection $users, string $title, string $description): void
    {
        foreach ($users as $user) {
            $user = $user->name;

            print_r("Notification for user {$user}; Title: {$title}; Description: {$description}");
        }
    }
}
