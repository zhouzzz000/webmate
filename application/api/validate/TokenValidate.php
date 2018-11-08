<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/7
 * Time: 18:20
 */

namespace app\api\validate;


use app\api\exception\TestException;
use app\api\exception\TokenException;
use app\api\model\User;
use think\facade\Cache;
use think\facade\Request;

class TokenValidate
{
    public function goCheck()
    {
        $token = Request::header('token');
        $id= Cache::get($token);
        if (!$id)
        {
            throw new TokenException();
        }
        return true;
    }
}