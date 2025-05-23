<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this import
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'image',
        'type',
        'address',
        'status',
    ];


    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }


    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function scopeActive($query)
    {
        return $query->where('status', 'ACCEPTED');
    }
}
