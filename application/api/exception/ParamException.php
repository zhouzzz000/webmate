<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:38
 */

namespace app\api\exception;


class ParamException extends BaseEcxeption
{
    public $msg = '参数验证错误';
    public $code = 400;
    public $errorCode = 10000;

}