<?php

namespace App\Models;



class Customer extends User
{
    protected $table = 'users';
    
    public static function boot(){
        parent::boot();
    }

}
