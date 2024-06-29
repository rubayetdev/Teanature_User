<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $products = Order::where('invoice_id', $this->order->invoice_id)
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.*','products.*', 'products.name as product_name','products.price as product_price','orders.price as total_price')
            ->get();
        $user = Order::where('invoice_id', $this->order->invoice_id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*','users.*')
            ->first();
//        dd($products);
        return $this->view('emails.invoice')
            ->with([
                'order' => $this->order,
                'products' => $products,
                'user' => $user,
            ]);
    }
}
