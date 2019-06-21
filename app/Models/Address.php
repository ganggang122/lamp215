<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   public  $table = 'users_address';

   public function getUserAddress()
   {
   		return $this->belongsTo('App\Models\Users','uid');
   }
}
