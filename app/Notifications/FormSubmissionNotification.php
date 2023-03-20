<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormSubmissionNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $companySymbol =  $this->data['company_symbol'];

        $companyName =  $this->data['company_name'];

        $startDate = date('yy-m-d', strtotime($this->data['start_date']));
        $endDate = date('yy-m-d', strtotime($this->data['start_date']));

        $subject = $companyName;

        $subject =  "for submitted Company Symbol = " . $companySymbol . "=> Company’s Name = " . $companyName;

        $body = 'From ' . $startDate . ' to ' .  $endDate;

        return (new MailMessage)
            ->subject($subject)
            ->view('template.form-submission-notification', ['body' => $body])
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
