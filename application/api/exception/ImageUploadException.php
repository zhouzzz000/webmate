<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/11
 * Time: 14:53
 */

namespace app\api\exception;


class ImageUploadException extends BaseEcxeption
{
    public $msg = '只能上传图片';
    public $code = 400;
    public $errorCode = 10005;
}