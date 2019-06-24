<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public  $table="users";

    //与user_info表一对一关系
    public function userInfo()
    {
        return $this->hasOne('App\Models\UserInfo','uid');
    }
    //一对一
    public  function  home()
    {
    	return $this->hasOne('App\Models\Homeusers','uid');
    }
    //与collect收藏表 即用户表与商品表的中间表  一对多关系
    public function userCollect()
    {
        return $this->hasMany('App\Models\Collect','uid');
    }
}
