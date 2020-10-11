<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CoursePaid extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $payer;

    /**
     * @var Course
     */
    private $course;
    /**
     * @var Order
     */
    private Order $order;

    /**
     * Create a new notification instance.
     *
     * @param User $payer
     * @param Order $order
     * @param Course $course
     */
    public function __construct(User $payer, Order $order, Course $course)
    {
        $this->payer = $payer;
        $this->order = $order;
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'payer' => $this->payer->fullName(),
            'course' => $this->course->name,
            'date' => $this->order->created_at
        ];
    }
}
