<?php

namespace Modules\General\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\General\Entities\GModule;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Token to send in email for reset password
     * @var string
     */
    private $token;

    /**
     * Constant with Login Module ID 
     */
    const MODULE_LOGIN_ID = 0;

    /**
     * Create a new notification instance. Init $token value
     *
     * @param $token code for reset password
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $gLoginModule = GModule::find(self::MODULE_LOGIN_ID);
        return (new MailMessage)
                    ->subject('Agroplastic - Notificación de cambio de contraseña')
                    ->greeting('Estimado(a) ' . $notifiable->hrEmployee->names . ':')
                    ->line('Has recibido este mensaje para restablecer la contraseña de tu cuenta de Agroplastic.')
                    ->action('Restablecer Contraseña', $gLoginModule->url_module . 'password/reset/'. $this->token)
                    ->line('Si no solicitaste el restablecimiento de tu contraseña, por favor no realices ninguna acción.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
