<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/7
 * Time: 15:12
 */

namespace app\api\exception;


class PasswordInvalidException extends BaseEcxeption
{
    public $msg = '帐号或者密码错误';
    public $code = 403;
    public $errorCode = 10000;

}