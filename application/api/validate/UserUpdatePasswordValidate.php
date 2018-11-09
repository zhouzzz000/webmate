<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/9
 * Time: 14:11
 */

namespace app\api\validate;


class UserUpdatePasswordValidate extends BaseValidate
{
    protected $rule = [
        'old_password' => ['require','min'=>6,'max'=>16,'regex' => '/^[\d+|\w]*/'],
        'new_password' => ['require','min'=>6,'max'=>16,'regex' => '/^[\d+|\w]*/'],
    ];
}