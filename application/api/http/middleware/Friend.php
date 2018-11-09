<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/9
 * Time: 16:45
 */

namespace app\api\http\middleware;


use app\api\validate\FriendIDValidate;

class Friend
{
    public function handle($request, \Closure $next)
    {
        (new FriendIDValidate())->goCheck();
        FriendIDValidate::checkUserById($request->param('friend_id'));
        return $next($request);
    }
}