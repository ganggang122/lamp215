<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specific extends Model
{
    public  $table="specification";

   public  function  specific()
    {
    	 return $this->belongsTo('App\Models\Cate','cid');
    }
}
