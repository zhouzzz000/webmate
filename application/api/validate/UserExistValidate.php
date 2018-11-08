<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 21:51
 */

namespace app\api\validate;





use app\api\exception\UserExistException;
use app\api\model\User;
use think\facade\Request;

class UserExistValidate
{
    public function goCheck()
    {
       $user = User::where('email','=',Request::param('email'))->find();
       if ($user)
       {
           throw new UserExistException();
       }
       return true;
    }
}