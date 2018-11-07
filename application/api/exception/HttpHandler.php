<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/4
 * Time: 22:21
 */

namespace app\api\exception;


use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use think\facade\Log;
use think\facade\Request;
use think\facade\Response;

class HttpHandler extends Handle
{
    private $msg = '';
    private $errorCode = '';
    private $status = '';
    public function render(Exception $e)
    {
        if ($e instanceof BaseEcxeption)
        {
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
            $this->status = $e->status;
        }
        else if($e instanceof HttpException && Request::isAjax())
        {
            return response($e->getMessage(),$e->getStatusCode());
        }
        else {
                if (config('app.app_debug'))
                {
                    return parent::render($e);
                }else{
                    $this->errorCode = 9999;
                    $this->msg = "服务器内部错误";
                    $this->status = 500;
                    Log::error($e->getMessage());
                }
        }
        $res = [
            'errorCode' => $this->errorCode,
            'msg'=>$this->msg,
            'request_url'=>Request::path()
        ];
        return json($res,$this->status);
    }
}