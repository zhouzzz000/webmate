<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/12
 * Time: 21:55
 */

namespace app\api\http\middleware;


use app\api\exception\PublishNotExistException;
use app\api\validate\GetUserListValidate;
use app\api\validate\PublishDeleteValidate;

class Publish
{
    public function handle($request, \Closure $next)
    {
        $cid = $request->param('cid');
        $id = $request->param('id');

        if($cid)
        {
            (new PublishDeleteValidate())->goCheck();
            PublishDeleteValidate::checkPublishById($cid);
        }
        else
            {
                (new GetUserListValidate())->goCheck();
            }

        return $next($request);
    }

}