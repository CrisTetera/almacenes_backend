<?php

namespace Modules\Sale\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmailPdf_SlSaleQuotationNotification extends Notification
{
    use Queueable;

    /**
     * Pdf Quotation to send to SlCustomer
     * @var object
     */
    private $pdf;

    /**
     * Email of Branch Office of SlCustomer (from quotation)
     * @var string
     */
    private $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pdf, string $email)
    {
        $this->pdf = $pdf;
        $this->email = $email;
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
        return (new MailMessage)
                    ->subject('Agroplastic - Cotización de compra')
                    ->greeting('Estimados ' . $notifiable->business_name . ':')
                    ->line('A continuación se adjunta la cotización de compra solicitada a nuestra empresa.')
                    ->attachData($this->pdf, 'Cotización.pdf', [
                        'mime' => 'application/pdf',
                    ]);
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

    /**
     * Get email of Branch Office of SlCustomer (from quotation)
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }
}
