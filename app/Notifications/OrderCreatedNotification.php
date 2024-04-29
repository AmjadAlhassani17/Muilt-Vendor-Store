<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
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
        return ['database', 'broadcast'];

        $channels = ['database'];
        if($notifiable->notification_type['order_craeted']['mail'] ?? false)
        {
            return $channels[] = 'mail';
        } 
        if($notifiable->notification_type['order_craeted']['sms'] ?? false)
        {
            return $channels[] = 'vonage';
        } 
        if($notifiable->notification_type['order_craeted']['broadcast'] ?? false)
        {
            return $channels[] = 'broadcast';
        } 
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;
        $addr = $order->billingaddress;
        return (new MailMessage)
                    ->subject("New Order #{$order->order_number}")
                    ->greeting("Hi {$notifiable->name}, ")
                    ->line("A new order (#{$order->order_number}) created by {$addr->name} from {$addr->country_name}.")
                    ->action('View Order', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        $order = $this->order;
        $addr = $order->billingaddress;
        return [
            'message' => "A new order (#{$order->order_number}) created by {$addr->name} from {$addr->country_name}.",
            'icon' => 'fas fa-envelope',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $order = $this->order; 
        $addr = $order->billingaddress;
        return new BroadcastMessage([
            'message' => "A new order (#{$order->order_number}) created by {$addr->name} from {$addr->country_name}.",
            'icon' => 'fas fa-envelope',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id,
        ]);
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