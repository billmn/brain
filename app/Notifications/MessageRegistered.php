<?php

namespace App\Notifications;

use App\Models\Form;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageRegistered extends Notification
{
    use Queueable;

    protected $form;
    protected $message;
    protected $toOwner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Form $form, Message $message, $toOwner = false)
    {
        $this->form = $form;
        $this->message = $message;
        $this->toOwner = $toOwner;
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
        $mailMessage = (new MailMessage)->view('vendor.notifications.message-registered', [
            'form' => $this->form,
            'formMessage' => $this->message,
        ]);

        if ($this->toOwner) {
            return $mailMessage
                        ->to($this->toOwner)
                        ->subject(trans('admin.messages.email.owner.subject'))
                        ->line(trans('admin.messages.email.owner.intro_1', [
                            'sender'    => $this->message->email,
                            'form_name' => $this->form->name,
                        ]));
        }

        return $mailMessage
                    ->subject($this->form->success_email->subject)
                    ->line($this->form->success_email->content);
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
