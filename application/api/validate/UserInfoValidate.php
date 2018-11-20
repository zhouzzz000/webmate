<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/8
 * Time: 16:53
 */

namespace app\api\validate;


class UserInfoValidate extends BaseValidate
{
    protected $rule = [
        'nick' => ['min'=> 3,'max' => 25,'regex' => '/^[\w]+/'],
        'sex' => ['in'=>'0,1,2'],
        'age' => ['integer','between'=>'0,70'],
        'major' => ['chsAlpha'],
        'grade' => ['integer','between'=>'1,99'],
        'email' => ['email'],
    ];
}