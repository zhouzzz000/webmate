<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/8
 * Time: 23:04
 */

namespace app\api\validate;


class UserLoginValidate extends BaseValidate
{
    protected $rule = [
        'email' => ['require','email'],
        'password' => ['require','min'=>6,'max'=>16,'regex' => '/^[\d+|\w]*/'],
    ];
}