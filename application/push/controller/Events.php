<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/15
 * Time: 11:38
 */

namespace app\push\controller;


use GatewayWorker\Gateway;

class Events
{
    public static function onConnect($client_id)
    {
        $data = [
            'type' => 'init',
            'client_id' => $client_id,
            'msg' => 'success',
            'date' => date('Y-m-d h:i:s',time())
        ];
        \GatewayWorker\Lib\Gateway::sendToClient($client_id,$data);
    }
}