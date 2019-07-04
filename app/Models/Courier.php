<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    //设置表
    public $table = 'courier';
    
    // 获取订单信息
    function orderinfo()
    {
        return $this->belongsTo('App\Models\orders', 'oid');
    }
    
    // 获取商品信息
    function goods()
    {
        return $this->belongsTo('App\Models\goods', 'gid');
    }
}
