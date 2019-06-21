<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    //设置表名
    public $table = 'brands';
    
    // 查询对应的分类名称
    public function catesname()
    {
        return $this->belongsTo('app\Models\Cate', 'cid');
    }
    
}
