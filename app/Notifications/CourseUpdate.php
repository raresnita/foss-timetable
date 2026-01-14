<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseUpdate extends Notification
{
    use Queueable;

    public $professor;
    public $message;
    public $group;

    /**
     * Create a new notification instance.
     */
    public function __construct($professor, $message, $group)
    {
        $this->professor = $professor;
        $this->message = $message;
        $this->group = $group;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        return (new MailMessage)
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', url('/'))
//            ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'professor_id'   => $this->professor->id,
            'professor_name' => $this->professor->name,
            'group_id'       => $this->group->id,
            'group_name'     => $this->group->name,
            'message'        => $this->message,
            'sent_at'        => now()->toDateTimeString(),
        ];
    }
}
