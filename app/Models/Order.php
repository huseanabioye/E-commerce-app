<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HashFactory;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

//    use HashFactory;
       public function user()
       {
        return $this->hasOne('App\Models\User','id','user_id');
       }
       public function product()
       {
        return $this->hasOne('App\Models\product','id','product_id');
       }





    
}
