<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/9
 * Time: 16:42
 */

namespace app\api\validate;



use app\api\exception\UserNotExistException;
use app\api\model\User;

class FriendIDValidate extends BaseValidate
{
    protected $rule = [
      'friend_id' => ['require','min'=> 1,'regex' => '/^[\d+]+/'],
    ];

    public static function checkUserById($id)
    {
        $user = User::get($id);
        if (!$user)
        {
            throw new UserNotExistException();
        }
        return true;
    }
}