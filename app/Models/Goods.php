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
    
    // 查询对应分类名称
    public function goodscate()
    {
        return $this->belongsTo('App\Models\Cate', 'cid');
    }
    
    // 查询对应商品品牌名称
    public function goodsbrand()
    {
        return $this->belongsTo('App\Models\Brands', 'bid');
        
    }
}
