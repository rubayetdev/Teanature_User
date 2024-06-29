<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'user_ip_address',
            'product_id',
            'invoice_id',
            'quantity',
            'price',
            'payment_method',
            'transaction_id',
            'order_status',
            'delivery_date',
            'shipping_address',
            'shipping_city',
            'zip_code',
            'roles',
        ];


}
