<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 21:49
 */

namespace app\api\exception;


class UserExistException extends BaseEcxeption
{
    public $msg = '用户已经存在或该邮箱已经注册过';
    public $code = 403;
    public $errorCode = 10001;
}