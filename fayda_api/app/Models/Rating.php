<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'item_id',
        'rating_value',
        'comment',
        'created_at',
    ];

    protected $casts = [
        'rating_value' => 'integer',
        'created_at' => 'datetime',
    ];


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
