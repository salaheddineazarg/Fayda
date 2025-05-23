<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Item extends Model
{
    use HasFactory;


    protected $fillable = [
        'store_id',
        'title',
        'description',
        'price',
        'status',
        'category',
        'image',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function scopeAvailable($query)
    {
        return $query->where('status', 'AVAILABLE');
    }
    public function averageRating()
    {
        return $this->ratings()->avg('rating_value');
    }
}
