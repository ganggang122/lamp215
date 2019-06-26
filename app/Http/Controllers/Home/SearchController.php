<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use DB;
class SearchController extends Controller
{
	public function __construct()
	{
		// 引入类文件
		require 'pscws4/pscws4.class.php';
		// 实例化
		@$this->cws = new \PSCWS4;
		//设置字符集
		$this->cws->set_charset('utf8');
		//设置词典
		$this->cws->set_dict('pscws4/etc/dict.utf8.xdb');
		//设置utf8规则
		$this->cws->set_rule('pscws4/etc/rules.utf8.ini');
		//忽略标点符号
		$this->cws->set_ignore(true);
	}
	public function dataWord()
    {
    	// $str = '华硕(ASUS) 飞行 堡垒 7九代 英特尔酷睿i7 1';
    	// $this->word($str);
    	$data = DB::table('goods')->select('goodsName','id')->get();
    	foreach($data as $k=>$v){
    		$arr = $this->word($v->goodsName);
    		foreach($arr as $kk=>$vv){
    			DB::table('goods_word')->insert(['gid'=>$v->id,'word'=>$vv]);
    		}
    	}
    }
    public static function getData($search)
    {
    	// $this->dataWord();
    	
    	$data =Goods::where('goodsName','like','%'.$search.'%')->paginate(1);
    	return $data;
    	// dump($search);
    }
    public function index(Request $request)
    {
    	$search = $request->input('search','');
    	if (!empty($search)) {


    		if(preg_match('/[\w]/',$search)){
    			$data2 = DB::table('goods')->where('goodsName','like','%'.$search.'%')->paginate(1);


    		} else {
	    		$gid = DB::table('goods_word')->select('gid')->where('word',$search)->paginate(1);
		    	$gids = [];
		    	foreach ($gid as $key => $value) {
		    		$gids[] = $value->gid;
		    	}

		    	$goods = DB::table('goods')->whereIn('id',$gids)->paginate(1);
	    	}
    	} else {
    		$goods = DB::table('goods')->paginate(1);
    	}
    	
    	$goods = self::getData($search);
    	return view('home.search.index',['goods'=>$goods,'search'=>$search]);
    }
    

    public function word($text)
    {

    	//声明字符串
		
		$arr = explode(' ',$text);
		dd($arr);
		$preg = '/^[\w\%\+\.\【\】\（\）]+$/';
		$string = '';
		foreach($arr as $k=>$v){
		
			$string .= preg_replace($preg,'',$v);
			
		}
		dump($string);
		
		//传递字符串
		$this->cws->send_text($text);
		//获取权重最高的前十个词
		// $res = $cws->get_tops(10);// top 顶部

		//获取所有的结果
		$res = $this->cws->get_result();
		dd($res);
		$list = [];
		foreach($res as $k=>$v){
			$list[] = $v['word'];
		}
		return $list;
		
    }
    public function __destruct()
    {
    	//关闭
		$this->cws->close();
    }
}
