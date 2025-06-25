<?php

namespace App\Amqp\Consumer;

use App\Repository\NotificationRepository;
use App\Service\WebSocketService;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(exchange: 'delivery.events', routingKey: 'notifications.websocket', queue: 'notifications.queue.websocket', name: "WebsocketNotificationConsumer", nums: 1)]
class WebsocketNotificationConsumer extends ConsumerMessage
{
    public function __construct(
        private WebSocketService $webSocketService,
        
        private NotificationRepository $notificationRepository
    ){}

    public function consumeMessage($data, AMQPMessage $message): Result
    {
        $notificationId = $data['notification_id'];

        $notification = $this->notificationRepository->findById($notificationId);

        if (!$notification) return Result::DROP;

        $this->webSocketService->sendToUser($notification->users, $notification->title, $notification->description);

        return Result::ACK;
    }
}
