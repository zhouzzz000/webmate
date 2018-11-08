<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/7
 * Time: 18:17
 */

namespace app\api\exception;


class TokenException extends BaseEcxeption
{
    public $msg = 'Token已无效或以过期';
    public $code = 401;
    public $errorCode = 10002;
}