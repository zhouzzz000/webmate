<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:46
 */

namespace app\api\http\middleware;


use app\api\exception\UserExistException;
use app\api\validate\UserExistValidate;
use app\api\validate\UserSignInValidate;

class SignIn
{
    public function handle($request, \Closure $next)
    {
        (new UserSignInValidate())->goCheck();
        (new UserExistValidate())->goCheck();
        return $next($request);
    }
}