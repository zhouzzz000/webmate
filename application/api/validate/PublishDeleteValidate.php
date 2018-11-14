<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/12
 * Time: 22:34
 */

namespace app\api\validate;


use app\api\exception\PublishNotExistException;
use app\api\model\Publish;

class PublishDeleteValidate extends BaseValidate
{
    protected $rule = [
        'cid' => ['require','min'=> 1,'regex' => '/^[\d+]+/'],
    ];
    public static function checkPublishById($cid)
    {
        $p = Publish::where('id','=',$cid)->find();
        if(!$p)
        {
            throw new PublishNotExistException();
        }
        return true;
    }
}