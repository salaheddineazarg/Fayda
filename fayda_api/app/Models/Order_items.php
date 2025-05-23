<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{

    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
