<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/12
 * Time: 20:55
 */

namespace app\api\exception;

class FailedGetList extends BaseEcxeption
{
    public $msg = '获取列表失败';
    public $code = 400;
    public $errorCode = 10000;
}