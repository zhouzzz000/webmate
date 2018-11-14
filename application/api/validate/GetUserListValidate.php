<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/12
 * Time: 21:53
 */

namespace app\api\validate;

class GetUserListValidate extends BaseValidate
{

    protected $rule = [
    'id' => ['require','min'=> 1,'regex' => '/^[\d+]+/'],
    ];
}