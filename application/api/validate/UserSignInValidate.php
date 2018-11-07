<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:43
 */

namespace app\api\validate;


class UserSignInValidate extends BaseValidate
{
    protected $rule = [
        'nick' => ['require','min'=> 3,'max' => 25,'reges' => '/^[\w]+/'],
        'password' => ['require','min'=>'6','max'=>'16','regex' => '/^[\d+|\w]*/'],
        'sex' => ['require','in'=>'1,2'],
        'age' => ['require','integer','between'=>'10,70'],
        'major' => ['chsAlpha'],
        'grade' => ['integer','between'=>'1,99'],
    ];
}