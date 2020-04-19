<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class VariablePush extends Notification
{
    use Queueable;

    protected $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class,'database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->notification['message'],
            'title' => $this->notification['title'],
            'action.title' => $this->notification['action']['title'],
            'action.link' => $this->notification['action']['link'],
        ];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->notification['title'])
            //TODO:: test this image
            ->icon("http://placehold.it/100x100/1e60b0/fff?text=test")
            ->image("http://placehold.it/100x100/1e60b0/fff?text=test")
            ->vibrate(true)
            ->body($this->notification['message'])
            ->action($this->notification['action']['title'],$this->notification['action']['title'])
            ->data($this->notification['action']['link']);
    }
}
