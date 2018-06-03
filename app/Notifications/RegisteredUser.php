<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class RegisteredUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
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

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->success()
            ->subject('Confirmation de votre compte')
                    ->line('Bonjour ' .$notifiable->name. '. Vous venez de créer un compte sur ' . route('index') . ' Pour activer votre compte il vous suffit de cliquer sur ce lien : ')
                    ->action('Valider mon compte', route('confirm-user' , ['id' => $notifiable->id , 'token' => urlencode($notifiable->confirmation_token)] ))
                    ->line('Si vous n\'êtes pas à l\'origine de la création de ce compte ne tenez pas compte de cet e-mail, le compte sera automatiquement supprimé.');
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