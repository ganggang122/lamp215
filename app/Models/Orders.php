<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public  $table = 'orders';

    // 查询对应商品详情
    public function goodsinfo()
    {
        return $this->hasOne('App\Models\Goods_Info','gid','gid');
    }
     public function goods()
    {
        return $this->belongsTo('App\Models\Goods','gid');
    }
}
