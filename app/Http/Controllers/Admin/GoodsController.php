<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brands;
use App\Models\Cate;
use App\Models\Goods;
use App\Models\Goods_Info;
use App\Models\Specific;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        return view('admin.goods.index');
        
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
        //表单验证
        $this->validate($request,[
            'goodsName' =>'required|unique:goods',
            'goodsNum' =>'required|numeric',
            'marketPrice' =>'required|numeric',
            'shopPrice' =>'required|numeric',
            'goodsStock' =>'required|numeric',
            'cid' => 'required',
            'goodsStatus' => 'required'
        ], [
            'goodsName.required' => '商品名称必填',
            'goodsName.unique'   => '商品名称已存在',
            'goodsNum.required'  => '商品编号必填',
            'goodsNum.numeric'   => '商品编号为数字',
            'marketPrice.required'  =>'市场价格必填',
            'marketPrice.numeric'   => '市场价格为数字',
            'shopPrice.required'  =>'店铺价格必填',
            'shopPrice.numeric'   => '店铺价格为数字',
            'goodsStock.required'  =>'库存数量必填',
            'goodsStock.numeric'   => '库存数量为数字',
            'cid.required' => '商品分类必填',
            'goodsStatus.required' => '商品状态必填',


        ]);
        // 查询商品分类 商品品牌数据 往页面发送
        $goods = new Goods();
    
        $cid =  $request->input('cid' , 0);
        $goods = [];
        $goods['cid'] = $cid;
        $path = Cate::find($cid)->path;
        $pid = (int)explode(',', $path)[1];
        // 获取分类下对应的品牌
        $brand = Brands::where('cid', $pid)->first();
        
        $goods['bid']  = $brand->id;
        $goods['goodsNum']    = $request->input('goodsNum' ,'');
        $goods['goodsName']   = $request->input('goodsName' ,'');
        $goods['marketPrice'] = $request->input('marketPrice' ,0);
        $goods['shopPrice']   = $request->input('shopPrice' ,0);
        $goods['goodsStock']  = $request->input('goodsStock' ,0);
        $goods['goodsStatus'] = $request->input('goodsStatus' ,0);
        // dump(session(['goods']));
        session(['goods'=>$goods]);
        
        // $res = Goods::insertGetId($goods);
       
        
        // 查询当前分类下的所属规格
        $specific = Specific::where('cid' , $pid)->get();
        // 查询当前分类的对应品牌
        $brands   = Brands::where('cid' , $pid)->get();
        return view('admin.goods.add',[
            'specific'   => $specific,
            'brands'     => $brands,
            /*'gid'        => $res,*/
        ]);
        
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
        /*$this->validate($request,[
            'bid' =>'required|numeric',
            'specName1' =>'required',
            'specName2' =>'required',
            'goodsPhoto' =>'required',
            'goodsContent' =>'required',
        ], [
            'bid.required'  => '商品品牌必填',
            'bid.numeric'   => '商品品牌号为数字',
            'specName1.required'  =>'商品规格必填',
            'specName2.required'  =>'商品规格必填',
            'goodsPhoto.required'  =>'商品图片必上传',
            'goodsContent.required'  =>'商品详情内容必填',
            
    
    
        ]);*/
        // 开始事务
        DB::beginTransaction();
        // dd(session('goods'));
        // 插入商品返回商品id
        $gid = Goods::insertGetId(session('goods'));
    
        // 获取数据
        $data = $request->all();
    
        $goods_info = new Goods_Info();
    
        // 给模型赋值
        $goods_info->gid = $gid;
        $goods_info->bid = $data['bid'];
        //循环添加名字
        /*foreach ($data['specName'] as $k => $v) {
            $goods_info->specName1 = $v;
            $goods_info->specName2 = $v;
        }*/
    
        // 赋值商品规格值1给商品详情表字段
        $goods_info->specName1 = $data['specName'][0];
        $goods_info->specName2 = $data['specName'][1];
        $goods_info->goodsPhotoinfo1 = $data['goodsPhoto'];
        $goods_info->goodsContent = $data['content'];
    
        if ($gid) {
            $res = $goods_info->save();
            if ($res) {
                DB::commit();
                session(['goods'=>null]);
                return redirect('admin/goods')->with('success', '添加商品成功');
            } else {
                DB::rollBack();
                return back()->with('error', '添加失败');
            }
        }
    
        /*}else{
        
        }*/
    
    
        /*$res = $goods_info->save();
        if ($res) {
            return redirect('admin/goods')->with('success','添加商品成功');
        } else {
            return back()->with('error', '添加商品失败');
        }*/
    
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
