<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HasRepliedToYou extends Notification
{
    use Queueable;

    public $post;
    public $replyer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $replyer)
    {
        $this->post = $post;
        $this->replyer = $replyer;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'post'=>$this->post,
            'replyer'=>$this->replyer,

        ];
    }
}
