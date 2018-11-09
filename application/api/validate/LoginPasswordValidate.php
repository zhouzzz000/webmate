<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/8
 * Time: 18:12
 */

namespace app\api\validate;
use app\api\exception\PasswordInvalidException;
use app\api\model\User;
use think\facade\Request;

class LoginPasswordValidate
{
    public function goCheck()
    {
        $user = User::where('email','=',Request::param('email'))->find();


        if ($user->password!=md5(Request::param('password').config('setting.salt')))
        {
            throw new PasswordInvalidException();
        }
        return true;
    }

}