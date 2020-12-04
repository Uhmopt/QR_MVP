<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Branch;

class BranchCreated extends Notification
{
    use Queueable;

    protected $password;
    protected $branch;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password,$branch,$user)
    {
        $this->password = $password;
        $this->branch = $branch;
        $this->user = $user;
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
            ->greeting(__('notications.hello',['username' => $this->user->name]))
            ->subject(__('notications.acc_create',['app_name'=>env('APP_NAME',"")]))
            ->line(__('notications.rest_acc_created',['branchname'=>$this->branch->name]))
            ->action(__('notications.login'), url(env('APP_URL',"")."/login"))
            ->line(__('notications.username',['email'=>$this->user->email]))
            ->line(__('notications.password',['password'=>$this->password]))
            ->line(__('notications.reset_pass'))
            ->line(__('notications.thanks_for_using_us'));
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
