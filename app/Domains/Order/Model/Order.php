<?php


namespace App\Domains\Order\Model;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'order_key',
        'cart_items',
        'price',
        'status',
    ];

    protected $casts = [
        'cart_items' => 'array',
    ];

    const ORDER_STATUS_NEW = 1;
    const ORDER_STATUS_IN_PROCESS = 2;
    const ORDER_STATUS_DONE = 3;
}
