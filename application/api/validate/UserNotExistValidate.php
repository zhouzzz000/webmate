<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/8
 * Time: 15:45
 */

namespace app\api\validate;


use app\api\exception\UserNotExistException;
use app\api\model\User;
use think\facade\Cache;
use think\facade\Request;

class UserNotExistValidate
{
    public function goCheck()
    {
        $token = Request::header('token');
        $id = Cache::get($token);
        $user = User::get($id);
        if (!$user)
        {
            throw new UserNotExistException();
        }
        return true;
    }
}