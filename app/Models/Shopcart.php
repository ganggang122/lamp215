<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopcart extends Model
{   
	//购物车列表
    public  $table = 'shopcart';
    //显示商品规格
    public  function  shopspecific2()
    {
    	return  $this->belongsTo('App\Models\Specific' , 'gidspecid2');
    }
    public  function  shopspecific1()
    {
    	return  $this->belongsTo('App\Models\Specific' , 'gidspecid1');
    }
  
    //查看商品价格
     public  function  shopprice()
    {
    	 return $this->belongsTo('App\Models\Goods','gid');
    }
     // 查询对应商品详情
    public function goodsinfo()
    {
        return $this->belongsTo('App\Models\Goods_Info','gid','gid');
    }
}

