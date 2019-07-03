<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   public  $table = 'users_address';
   //地址表属于用户
   public function getUserAddress()
   {
   		return $this->belongsTo('App\Models\Users','uid');
   }
}
