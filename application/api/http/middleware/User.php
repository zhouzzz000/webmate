<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/8
 * Time: 15:51
 */

namespace app\api\http\middleware;


use app\api\validate\UserInfoValidate;
use app\api\validate\UserNotExistValidate;
use app\api\validate\UserUpdatePasswordValidate;
use think\facade\Cache;

class User
{
    public function handle($request, \Closure $next)
    {
        if ($request->has('email')) {
            (new UserInfoValidate())->goCheck();
            (new UserNotExistValidate())->goCheck();
        }else{
            (new UserUpdatePasswordValidate())->goCheck();
            (new UserNotExistValidate())->goCheck();
        }
        $request->id = Cache::get($request->header('token'));
        return $next($request);
    }
}