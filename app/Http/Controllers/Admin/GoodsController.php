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
     * 商品列表页无刷新修改商品照片
     * @return \Illuminate\Http\Response
     */
    
  
    
    public function index(Request $request)
    {
        // 获取搜索条件
        $search_num = $request->input('search_num','');
        $search_name = $request->input('search_name','');
        $goods = Goods::where('goodsNum','like','%'.$search_num.'%')
            ->where('goodsName','like','%'.$search_name.'%')
            /*->where('cid',$request->input('cid',''))
            ->where('bid',$request->input('bid',''))*/
            ->paginate(5);
        //查询商品数据 显示
        // $goods = Goods::all();
        
        
        
        return view('admin.goods.index', [
            'goods' => $goods,
            'goodsCate' => CatesController::getCates(),
            'params'=>$request->all(),
            'brandName' => Brands::all(),
            
        ]);
        
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
            /*'marketPrice' =>'required|numeric',
            'shopPrice' =>'required|numeric',*/
            'marketPrice' =>'required',
            'shopPrice' =>'required',
            'goodsStock' =>'required|numeric',
            'cid' => 'required',
            'goodsStatus' => 'required'
        ], [
            'goodsName.required' => '商品名称必填',
            'goodsName.unique'   => '商品名称已存在',
            'goodsNum.required'  => '商品编号必填',
            'goodsNum.numeric'   => '商品编号为数字',
            'marketPrice.required'  =>'市场价格必填',
//            'marketPrice.numeric'   => '市场价格为数字',
            'shopPrice.required'  =>'店铺价格必填',
//            'shopPrice.numeric'   => '店铺价格为数字',
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
            DB::table('goods')->where('id', $gid)->update(['goodsPhoto'=>$data['goodsPhoto']]);
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
    
    
        /*/$res = $goods_info->save();
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
        // 接收传递过来商品状态
        $good = Goods::where('id',$id)->first();
        $goods = Goods::find($id);
    
        if ($good->goodsStatus == 1) {
            $goods->goodsStatus = 2;
            $goods->save();
            return response()->json(['goodsStatus'=>2]);
        } else {
            $goods->goodsStatus = 1;
            $goods->save();
            return response()->json(['goodsStatus'=>1]);
        }
        
        
        
        
        /*//修改商品状态
        if ($status == 1) {
            // 修改为下架
            $goods->GoodsStatus = 2;
            // 保存
            $res = $goods->save();
            if ($res) {
                $good = Goods::where('id', $id)->first();
                $goodStatus = $good->goodsStatus;
                echo $goodStatus;
            }
        } elseif($status == 2) {
            // 修改为上架`
            $goods->GoodsStatus = 1;
            // 保存
            $res = $goods->save();
            if ($res) {
                $good = Goods::where('id', $id)->first();
                $goodStatus = $good->goodsStatus;
                echo $goodStatus;
            }
        } else {
        
        }*/
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询数据，加载修改页面
        $good = Goods::find($id);
        // 三级分类id 获取一级分类id
        $path = Cate::find($good->cid)->path;
        $pid = (int)explode(',', $path)[1];
        // 查询对应品牌
        $brands   = Brands::where('cid' , $pid)->get();
        // 查询对应规格值名称
        $specName = Specific::where('cid', $pid)->get();
    
        $specName1 = $specName[0]->specname;
        $specName2 = $specName[1]->specname;
        
        
        // 查询对应规格值
        $specValue = Goods_Info::where('gid', $good->id)->first();
        
        return view('admin.goods.edit',[
            'good' => $good,
            'goodsCate'  => CatesController::getCates(),
            'brandName' => $brands,
            'specName1' => $specName1,
            'specName2' => $specName2,
            'specValue1' => $specValue->specName1,
            'specValue2' => $specValue->specName2,
        ]);
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
    
        DB::beginTransaction();
        //数据验证
        $this->validate($request, [
            'cid' => 'required',
            'bid' =>'required|numeric',
            'marketPrice' =>'required',
            'shopPrice' =>'required',
            'goodsStock' =>'required|numeric',
            'specValue1' =>'required',
            'specValue2' =>'required',
            'goodsPhoto' =>'required'
        ], [
            'cid.required' => '商品分类必填',
            'bid.required'  => '商品品牌必填',
            'marketPrice.required'  =>'市场价格必填',
            'shopPrice.required'  =>'店铺价格必填',
            'goodsStock.required'  =>'库存数量必填',
            'goodsStock.numeric'   => '库存数量为数字',
            'specValue1.required'  =>'商品规格必填',
            'specValue2.required'  =>'商品规格必填',
            'goodsPhoto.required'  =>'商品图片必上传',
        ]);
        
        $data = $request->except('_token', '_method', 'file_upload');
    
        $good = Goods::find($id);
        $good->cid = $data['cid'];
        $good->bid = $data['bid'];
        $good->marketPrice = $data['marketPrice'];
        $good->shopPrice = $data['shopPrice'];
        $good->goodsStock = $data['goodsStock'];
        $good->goodsPhoto = $data['goodsPhoto'];
        
        $res1 = $good->save();
        if ($res1) {
            // 获取id
            $gid = $good->id;
            // 获取goods_info id号
            $good_info_id = Goods_Info::where('gid', $gid)->first();
            // 获取goods_info 修改的这一条
            $good_info = Goods_Info::find($good_info_id->id);
            $good_info->gid = $gid;
            $good->info = $data['bid'];
            $good_info->specName1 = $data['specValue1'];
            $good_info->specName2 = $data['specValue2'];
            $good_info->goodsPhotoinfo1 = $data['goodsPhoto'];
    
            $res2 =  $good_info->save();
            if ($res1 && $res2) {
                DB::commit();
                return redirect('admin/goods')->with('success','修改商品成功');
            } else {
                DB::rollBack();
                return back()->with('error','修改商品失败');
            }
    
    
        }
        
        
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        $res = Goods::destroy($id);
        $data = [];
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        
        return $data;
    }
    
    public function ajaxname(Request $request)
    {
        sleep(2);
        // dd($request->all());
        $id = $request->input('id', 0);
        $name = $request->input('name', '');
        
        // $good = Goods::where('id',$id)->first();
        $res = DB::table('goods')->where('goodsName', $name)->first();
        if ($res) {
            // 用户名存在
            return response()->json(['code'=>0]);
        } else {
            $r = DB::table('goods')->where('id',$id)->update(['goodsName' => $name,
            ]);
            if ($r) {
//                1.表示成功
                return response()->json(['code'=>1]);
            } else {
                //2.表示失败
                return response()->json(['code'=>2]);
                
            }
        }
        
        
    }
}
