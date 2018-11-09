<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/8
 * Time: 18:07
 */

namespace app\api\validate;


use app\api\exception\UserDoesNotExistException;
use app\api\exception\UserNotExistException;
use app\api\model\User;
use think\facade\Request;



class UserDoesNotExistValidate
{
    public function goCheck()
    {
        $user = User::where('email','=',Request::param('email'))->find();
        if (!$user)
        {
            throw new UserNotExistException();
        }
        return true;
    }
}