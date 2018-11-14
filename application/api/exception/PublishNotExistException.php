<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/12
 * Time: 22:37
 */

namespace app\api\exception;

class PublishNotExistException extends BaseEcxeption
{
    public $msg = '说说不存在或已被删除';
    public $code = 403;
    public $errorCode = 10000;
}