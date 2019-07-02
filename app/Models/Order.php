<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public  $table = 'order';

    public  function  shopcart()
    {
    	return  $this->belongsTo('App\Models\Shopcart' ,'sid');
    }
}
