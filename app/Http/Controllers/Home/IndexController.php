<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate; 
use App\Models\Goods;
use App\Models\Banners; 
use App\Models\Link;
use App\Models\Shopcart;
use DB;


class IndexController extends Controller
{
    public static function getLinksData()
    {
        $links = Link::all();
        return $links;
    }

    public static function getCatesData($pid = 0)
    {
        $data = Cate::where('pid',$pid)->get();
        foreach ($data as $key => $value) {
           $value->sub = self::getCatesData($value->id);
        }
        return $data;
    }
    public static function getGoodsData()
    {
         $data = self::getCatesData(0);
         $id = [];
         foreach($data as $k=>$v){
            foreach($v['sub'] as $kk=>$vv){
                foreach($vv['sub'] as $kkk=>$vvv){
                    $id[$vvv->id] = $vvv->id;
                }
            }
         }
         foreach($id as $k=>$v){
            $id[$k] = Goods::where('cid',$v)->skip(0)->take(4)->get();
         }
         return $id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //友情链接
         $links = self::getLinksData();
         //分类
         $data = self::getCatesData(0);
         //轮播图
         $banners = Banners::where('status',1)->get();
         //获取商城头条 2条 3条
         $headline1 = DB::table('blog')->orderBy('top','desc')->orderBy('updated_at','desc')->skip(0)->take(2)->get();
         $headline2 = DB::table('blog')->orderBy('top','desc')->orderBy('updated_at','desc')->skip(2)->take(3)->get();
         //获取今日推荐
         $recommends = DB::table('recommend')->where('status',2)->orderBy('top','desc')->orderBy('updated_at','desc')->get();

         //获取秒杀
         $seckills = DB::table('seckill')->where('status','2')->orderBy('top','desc')->orderBy('updated_at','desc')->get();

        // return view('home.index.index',['recommends'=>$recommends,'data'=>$data,'banners'=>$banners,'links'=>$links,'headline1'=>$headline1,'headline2'=>$headline2]);
          //统计购物车数量
         $num  =  ShopcartController::num();
         $id = self::getGoodsData();
            //dd($id);
         return view('home.index.index',['num' =>$num,'id'=>$id,'seckills'=>$seckills,'recommends'=>$recommends,'data'=>$data,'banners'=>$banners,'links'=>$links,'headline1'=>$headline1,'headline2'=>$headline2]);   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
