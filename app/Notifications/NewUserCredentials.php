<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserCredentials extends Notification
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
            ->subject('Welcome to ' . config('app.name') . ' - Your Account Credentials')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your account has been created successfully. Please use the credentials below to log in:')
            ->line('**Email:** ' . $notifiable->email)
            ->line('**Password:** ' . $this->password)
            ->when($notifiable->must_change_password, function ($mail) {
                return $mail->line('**Important:** You will be required to change your password upon your first login for security purposes.');
            })
            ->action('Login to Your Account', route('login'))
            ->line('If you have any questions or need assistance, please don\'t hesitate to contact us.');
    }
}
