<?php
//خاص ب الاشعارات

namespace App\Notifications;

use App\Models\Vendor;//  Vendor استدعاء موديل
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorCreated extends Notification
{
    // استخدم الطابور شي وراء شي
    use Queueable;

    // بنبعث الاشعار للبائع
    public $vendor;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor) // vendor نستقبل الموديل تبع
    {
       $this -> vendor =  $vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

     //   وليس عن طريق التخزين في قاعده البينات  sms داله وضيفته تبعت الاشعارات عن طريق الايميل وليس عن طريق سرفر خارجي او عن طريق رساله نصيه
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

        $subject = sprintf('%s: لقد تم انشاء حسابكم في موقع الحاشدي %s!', config('app.name'), 'zeyad');
        $greeting = sprintf('مرحبا %s!', $notifiable->name);

        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->salutation('Yours Faithfully')
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');

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
