<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brands;
use App\Models\Cate;
use App\Models\Goods;
use App\Models\Goods_Info;
use App\Models\Specific;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    
    public static function goodsNum($num = '')
    {
        return $num.(round(microtime(true),4)*10000).mt_rand(0,9);
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodsNum = self::goodsNum();
        $brandName = Brands::all();
        //引入添加页
        return view('admin.goods.create',[
            'goodsNum'   => $goodsNum,
            'goodsCate'  => CatesController::getCates(),
            'brandsName' => $brandName,
        ]);
    }
    
    
    /*
     * 商品详情添加
     */
    public function add(Request $request)
    {
        // 查询商品分类 商品品牌数据 往页面发送
        $goods = new Goods();
    
        $cid =  $request->input('cid' , 0);
        $goods = [];
        $goods['cid'] = $cid;
        $path = Cate::find($cid)->path;
        $pid = (int)explode(',', $path)[1];
        
        $goods['goodsNum']    = $request->input('goodsNum' ,'');
        $goods['goodsName']   = $request->input('goodsName' ,'');
        $goods['marketPrice'] = $request->input('marketPrice' ,0);
        $goods['shopPrice']   = $request->input('shopPrice' ,0);
        $goods['goodsStock']  = $request->input('goodsStock' ,0);
        $goods['goodsStatus'] = $request->input('goodsStatus' ,0);
        
        $res = Goods::insertGetId($goods);
       
        if ($res) {
            $specific = Specific::where('cid' , $pid)->get();
            $brands   = Brands::where('cid' , $pid)->get();
            return view('admin.goods.add',[
                'specific'   => $specific,
                'brands'     => $brands,
                'gid'        => $res,
            ]);
        } else {
            return back();
            
        }
        
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //验证数据
        
        // 获取数据
        $data = $request->all();
        
        $goods_info = new Goods_Info();
        
        // 给模型赋值
        $goods_info->bid = $data['bid'];
        $goods_info->gid = $data['gid'];
        //循环添加名字
        /*foreach ($data['specName'] as $k => $v) {
            $goods_info->specName1 = $v;
            $goods_info->specName2 = $v;
        }*/
        $goods_info->specName1 = $data['specName'][0];
        $goods_info->specName2 = $data['specName'][1];
        $goods_info->goodsPhotoinfo1 = $data['goodsPhoto'];
        $goods_info->goodsContent = $data['content'];
    
        
        
        $res = $goods_info->save();
        if ($res) {
            return redirect('admin/goods')->with('success','添加商品成功');
        } else {
            return back()->with('error', '添加商品失败');
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
