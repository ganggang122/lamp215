<?php

namespace App\Http\Middleware;

use Closure;
class NodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( session('admin_user_info')->uname == 'admin' ){
            return $next($request);
        }
        //获取当前登录用户的权限
        $admin_user_nodes = session('admin_user_nodes');
        $aduser_nodes = [];
        //创建新数组 使控制器名称为下表  方法名为值
        foreach($admin_user_nodes as $v){
            $aduser_nodes[$v->cname][] = $v->aname; 
        }
    
        foreach($aduser_nodes as $k=>$v){
            //如有有 index权限 就添加show权限
            if ( in_array('index',$v)) {
                $aduser_nodes[$k][] = 'show';
            }
            //如有有 添加权限 就添加stroe destroy
            if ( in_array('create',$v)) {
                $aduser_nodes[$k][] = 'store';
                $aduser_nodes[$k][] = 'destroy';
            }
            //如有有 修改权限 就添加update权限
            if ( in_array('edit',$v)) {
                $aduser_nodes[$k][] = 'update';
            }  
        }
        //获取当前操作的 控制器  方法名
        $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
        $func=explode('@', $actions[count($actions)-1]);
        $controllerName=$func[0];
        $actionName=$func[1];

        //获取 用户 可以 操作 的 控制器 数组
        $aduser_contor = array_keys($aduser_nodes);
        //添加登录权限 
        $aduser_contor[] = 'IndexController';
        //添加登录首页的权限
        $aduser_nodes['IndexController'] = ['index'];
        //判断用户是否可以使用 当前点击的控制器
        if ( !in_array($controllerName,$aduser_contor) ){
            //dump('没有该控制器'.$controllerName.'的权限');
            return redirect('admin/rbac');
        }
        //判断用户 是否可以 使用 当前方法
        if ( !in_array($actionName ,$aduser_nodes[$controllerName])){
            //dump('没有该方法'.$actionName.'的权限');
            return redirect('admin/rbac');
        }
        return $next($request);
    }
}
