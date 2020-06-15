<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAuthorPost extends Notification implements ShouldQueue
{
    use Queueable;
    private $post;

    /**
     * Create a new notification instance.
     *
     * @param mixed $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->greeting('Hello, Admin!')
            ->subject('New Post Approval Needed')
            ->line('New Post by ' . $this->post->user->name . ' need to approve.')
            ->line('To approve the post click view button.')
            ->line('Post Title : ' . $this->post->title)
            ->action('View', url(route('admin.post.show', $this->post)));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
