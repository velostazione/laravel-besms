<?php

namespace Velostazione\Laravel\BeSMS;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;
use Velostazione\BeSMS\Api as BeSMS;

final class BeSMSChannel
{
    private BeSMS $beSMS;

    private Dispatcher $events;

    /**
     * BeSMSChannel constructor.
     *
     * @param BeSMS      $beSMS
     * @param Dispatcher $events
     */
    public function __construct(BeSMS $beSMS, Dispatcher $events)
    {
        $this->beSMS = $beSMS;
        $this->events = $events;
    }

    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @return false|string
     * @throws Exception|GuzzleException
     */
    public function send(mixed $notifiable, Notification $notification): false|string
    {
        try {
            $recipient = $notifiable->phone;
            $message = $notification->toBeSMS($notifiable);
            return $this->beSMS->send($recipient, $message->content, $message->sender);
        } catch (Exception $exception) {
            $event = new NotificationFailed(
                $notifiable,
                $notification,
                'beSMS',
                ['message' => $exception->getMessage(), 'exception' => $exception]
            );

            $this->events->dispatch($event);

            throw $exception;
        }
    }
}
