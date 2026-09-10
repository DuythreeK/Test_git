<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable implements ShouldQueue
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
        $this->order = $order->load(['user', 'orderItems.variant.product', 'orderItems.variant.size']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->order->payment_method === 'vnpay' ? "Xác nhận thanh toán thành công đơn hàng #{$this->order->id}" : "Xác nhận đặt hàng thành công đơn hàng #{$this->order->id}";
        return $this->subject($subject)->view('emails.order_success');
    }
}
