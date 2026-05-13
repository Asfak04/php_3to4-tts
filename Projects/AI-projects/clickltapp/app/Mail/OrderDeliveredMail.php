<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderDeliveredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Delivered - #ORD-' . str_pad($this->order->id, 5, '0', STR_PAD_LEFT))
                    ->view('emails.order_status')
                    ->with('title', 'Order Successfully Delivered! ✨')
                    ->with('message_text', 'Yay! Your order has been delivered successfully. Thank you for shopping with ClickIT.');
    }
}
