<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //设置表名
    public $table = 'goods';
    
    // 查询对应商品详情
    public function goodsinfo()
    {
        return $this->hasOne('App\Models\Goods_Info','gid');
    }
}
