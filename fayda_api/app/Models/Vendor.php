<?php

namespace App\Models;



class Vendor extends User
{
    protected $table = 'users';



    public static function boot(){
        parent::boot();
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'vendor_id');
    }

}

