<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Password Updated Notification
 * 
 * Sent to users when their password has been updated by an administrator.
 * Contains the new login credentials and security information.
 * If must_change_password flag is set, notifies user they must change their password on next login.
 */
class PasswordUpdated extends Notification
{
    use Queueable;

    /**
     * The new password for the user.
     * 
     * @var string
     */
    public $password;

    /**
     * Create a new notification instance.
     * 
     * @param string $password The new password for the user
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
     * - Notification that password was updated by admin
     * - New login credentials (email and new password)
     * - Password change requirement notice (if applicable)
     * - Login button/link
     * - Security reminder to contact if change was not requested
     * 
     * @param mixed $notifiable The entity receiving the notification (User)
     * @return MailMessage The mail message instance
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
