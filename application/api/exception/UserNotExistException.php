<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/8
 * Time: 15:45
 */

namespace app\api\exception;


class UserNotExistException extends BaseEcxeption
{
    public $msg = '用户不存在';
    public $code = 403;
    public $errorCode = 10003;
}