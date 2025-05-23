<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'store_id',
        'total_price',
        'status',
        'notes'
    ];

    /**
     * Customer who placed the order.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Store where the order was placed.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Items in the order (via order_items pivot table).
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }

    /**
     * Payments related to this order.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get only successful payments.
     */
    public function successfulPayments()
    {
        return $this->payments()->where('status', 'SUCCESS');
    }

    /**
     * Get total amount paid so far.
     */
    public function totalPaid()
    {
        return $this->successfulPayments()->sum('amount');
    }

    /**
     * Check if the order has been fully paid.
     */
    public function isFullyPaid()
    {
        return $this->totalPaid() >= $this->total_price;
    }

    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
