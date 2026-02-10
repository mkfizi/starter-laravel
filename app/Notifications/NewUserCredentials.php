<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * New User Credentials Notification
 * 
 * Sent to new users when their account is created by an administrator.
 * Contains the initial login credentials including email and temporary password.
 * If must_change_password flag is set, notifies user they must change their password on first login.
 */
class NewUserCredentials extends Notification
{
    use Queueable;

    /**
     * The temporary password for the new user.
     * 
     * @var string
     */
    public $password;

    /**
     * Create a new notification instance.
     * 
     * @param string $password The temporary password for the new user
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     * 
     * @param mixed $notifiable The entity receiving the notification (User)
     * @return array<string> Array of delivery channels (mail only)
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     * 
     * Builds an email message containing:
     * - Welcome greeting with user's name
     * - Login credentials (email and temporary password)
     * - Password change requirement notice (if applicable)
     * - Login button/link
     * 
     * @param mixed $notifiable The entity receiving the notification (User)
     * @return MailMessage The mail message instance
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
