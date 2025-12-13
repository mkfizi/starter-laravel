<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordUpdated extends Notification
{
    use Queueable;

    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(config('app.name') . ' - Your Password Has Been Updated')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your password has been updated by an administrator. Please use the new credentials below to log in:')
            ->line('**Email:** ' . $notifiable->email)
            ->line('**New Password:** ' . $this->password)
            ->when($notifiable->must_change_password, function ($mail) {
                return $mail->line('**Important:** You will be required to change your password upon your next login for security purposes.');
            })
            ->action('Login to Your Account', route('login'))
            ->line('If you did not request this change or have any questions, please contact us immediately.');
    }
}
