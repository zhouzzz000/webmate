<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/7
 * Time: 18:16
 */

namespace app\api\http\middleware;


use app\api\exception\TokenException;
use app\api\validate\TokenValidate;
use think\facade\Cache;

class Token
{
    public function handle($request, \Closure $next)
    {
        (new TokenValidate())->goCheck();
        $request->id = Cache::get($request->header('token'));
        return $next($request);
    }
}