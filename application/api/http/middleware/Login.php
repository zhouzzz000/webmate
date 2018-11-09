<?php

namespace app\api\http\middleware;

use app\api\exception\TestException;
use app\api\validate\LoginPasswordValidate;
use app\api\validate\UserDoesNotExistValidate;
use app\api\validate\UserLoginValidate;
use app\api\validate\UserNotExistValidate;

class Login
{
    public function handle($request, \Closure $next)
    {

        if( $request->header('token')) {
            (new UserNotExistValidate())->goCheck();
        }
        else {
            (new UserLoginValidate())->goCheck();
            (new LoginPasswordValidate())->goCheck();
            (new UserDoesNotExistValidate())->goCheck();
        }
        return $next($request);
    }
}
