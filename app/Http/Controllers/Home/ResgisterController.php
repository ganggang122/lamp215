<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Users;
use Hash;
use Mail;

class ResgisterController extends Controller
{
    /**
       用户注册页面
     */
     public  function  index()
     {
     	return view('home.resgister.index');
     }

      // 执行注册 手机号
   public function store(Request $request)
   {	
   		// dump($request->all());
   		  $this->validate($request, [
                'phone' => 'required|unique:users|regex:/^1{1}[3-9]{1}[\d]{9}$/',
                'code' => 'required',
                'upass' => 'required|regex:/^[\w]{6,18}$/',
                'repass' => 'required|same:upass',
            ],[ 
                'upass.required'=>'密码必填',
                'code.required' => '验证码不能为空',
                'upass.regex'=>'密码格式错误',
                'repass.required'=>'确认密码必填',
                'repass.same'=>'俩次密码不一致',
                'phone.required'=>'手机号必填',
                'phone.regex' => '手机号格式不对',
                'phone.unique' => '手机号已存在'
            ]);

   		// 验证手机验证码 用户输入
   		$phone = $request->input('phone',0);

   		// 获取发送到手机上验证码
   		$k = $phone.'_code';

   		$phone_code = session($k);

   		$code = $request->input('code',0);

   		// dump($code);

   		// dump($phone_code);



   		if($phone_code != $code){
   			// return back();
   			echo "<script>alert('验证码错误');location.href='/home/register'</script>";
   			exit;
   		}


   		// 接收数据
   		

   		$users = new Users;
   		$users->phone = $phone;
   		$users->upass = Hash::make($request->input('upass' , 0));
   		$users->status = 1;
   		$token = str_random(30);
   		$users->token = $token;
   		$res1 = $users->save();
   		if($res1){
   			 echo "<script>alert('注册成功');location.href='/home/index'</script>";
   			 exit;
   		}else{
            return back();
   		}



   		// 压入到数据库


   }

  public function sendPhone(Request $request)
    {   //验证手机号是否已存在
        $users_phone = Users::select('phone')->get();
        
    	// 接收手机号
    	$phone = $request->input('phone');
    	if($users_phone == $phone){
    		echo "<script>alert('手机已存在');location.href='/home/register'</script>";
    	    exit;
    	}
    	
    	$code = rand(1234,4321);
    	// 如果存入到redis中 注意键名覆盖
    	$k = $phone.'_code';

    	session([$k=>$code]);

    	$url = "http://v.juhe.cn/sms/send";
	    $params = array(
	        'key'   => 'a3bfd9334db75d6e34973ab026911c81', //您申请的APPKEY
	        'mobile'    => $phone, //接受短信的用户手机号码
	        'tpl_id'    => '166083', //您申请的短信模板ID，根据实际情况修改
	        'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
	    	'dtype'=>'json'
	    );

	    $paramstring = http_build_query($params);
	    $content = self::juheCurl($url, $paramstring);
	    echo $content;
	    // $result = json_decode($content, true);  将json格式转化成数组
	    // 返回结构
	    // if ($result) {
	    //     var_dump($result);
	    // }

    }


     //邮箱注册
    // 执行邮箱注册 操作
    public function insert(Request $request)
    {
    	// dump($request->all());
    	$this->validate($request, [
                'email' => 'required|unique:users|email',
                'upass' => 'required|regex:/^[\w]{6,18}$/',
                'repass' => 'required|same:upass',
            ],[ 
                'upass.required'=>'密码必填',
                'upass.regex'=>'密码格式错误',
                'repass.required'=>'确认密码必填',
                'repass.same'=>'俩次密码不一致',
                'email.required'=>'邮箱必填',
                'email.email'=>'邮箱格式错误',
                'email.unique' => '邮箱已存在'

            ]);
    	$upass = $request->input('upass');
    	$repass = $request->input('repass');
    	$email = $request->input('email');
    	//验证密码
    	if($upass != $repass){
    		echo "<script>alert('俩次密码不一致');location.href='/home/register'</script>";
   			exit;
    	}


    	// send -> view('xx.blade.php',[])
    	$token = str_random(30);

    	$user = new Users;
    	$user->upass = Hash::make($upass);
    	$user->email = $email;
    	$user->token = $token;
    	$res1 = $user->save();
    	if($res1){
	    	// 发送邮件
	    	Mail::send('home.resgister.mail', ['id' => $user->id,'token'=>$token], function ($m) use ($email) {
	    		// to 发送地址   subject  标题
	            $s = $m->to($email)->subject('【LAMPoto】提醒邮件!');

	            if($s){
	            	echo  "<script>alert('注册成功,请尽快激活');location.href='/home/index'</script>";
	            }else{
	            	echo  "<script>alert('发送失败')</script>";
	            }
	        });	
    	}



    	

    }

    // 激活 用户 （邮件）
    public function changeStatus($id,$token)
    {
    	// echo "激活 ---- ".$id;
    	$user = Users::find($id);
    	// 验证token
    	if($user->token != $token){
    		dd('链接失效');
    	}

    	$user->status = 1;
    	$user->token = str_random(30);

    	if($user->save()){
    		echo "<script>alert('激活成功');location.href='/home/index'</script>";
    	}else{
    		echo "激活失败";
    	}

    	
    }
      /**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
    public  static function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }


}

 