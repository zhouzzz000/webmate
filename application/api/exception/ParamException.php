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
    public $msg = '获取列表失败';
    public $code = 400;
    public $errorCode = 10000;

}