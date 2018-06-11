<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Order extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
            ->success()
            ->subject(config('app.name', 'Laravel') . '| Votre facture')
            ->greeting('Bonjour ' .$notifiable->name)
            ->line('Vous avez recemment effectué une commande sur ' . route('index') . '.')
            ->line('Vous retrouverer la facture asossice en piece jointe.')
            ->line('Merci de vore confiance et a bientôt chez ' .route('index').  '.')
            ->attach(storage_path('app/factures/' .$this->order->id. '.pdf') , ['as' => 'Facture template '.$this->order->id.'.pdf' ]);
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
            //
        ];
    }
}