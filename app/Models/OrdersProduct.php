<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'vendor_id',
        'admin_id',
        'product_id',
        'product_code',
        'product_name',
        'product_color',
        'product_size',
        'product_price',
        'product_qty',
    ];
}
