<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_code',
        'customer_name',
        'customer_email',
        'table_number',
        'subtotal',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'status',
        'date',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
