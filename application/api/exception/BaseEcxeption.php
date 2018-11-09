<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/4
 * Time: 22:16
 */

namespace app\api\exception;


use think\Exception;

class BaseEcxeption extends Exception
{
    public $msg = '参数错误';
    public $errorCode = '';
    public $code = '400';
    public function __construct($data = [])
    {
        if (!is_array($data))
        {
            $this->msg = $data;
        }
        else {
            if (array_key_exists('code', $data)) {
                $this->code = $data['code'];
            }
            if (array_key_exists('errorCode', $data)) {
                $this->errorCode = $data['errorCode'];
            }
            if (array_key_exists('msg', $data)) {
                $this->msg = $data['msg'];
            }
        }
    }
}