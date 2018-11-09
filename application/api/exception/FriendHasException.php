<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/9
 * Time: 17:11
 */

namespace app\api\exception;


class FriendHasException extends BaseEcxeption
{
    public $msg = 'TA已经是你朋友';
    public $code = 401;
    public $errorCode = 10004;
}