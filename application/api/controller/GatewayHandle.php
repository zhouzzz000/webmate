<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/15
 * Time: 11:43
 */

namespace app\api\controller;


use app\api\model\MessageHistory;
use app\push\Events;
use \GatewayWorker\Lib\Gateway;
use think\Request;


class GatewayHandle
{
    public function bind(Request $request)
    {
        Gateway::$registerAddress = '127.0.0.1:1238';
        $uid = $request->id;
        $client_id = $request->param('client_id');
        Gateway::bindUid($client_id,$uid);
        $data = [
          'uid' => $uid,
          'date' => time()
        ];
        $data = json_encode($data);
        Gateway::sendToClient('7f0000010b5400000001',$data);
        MessageHistory::create([
           'sid' => $uid,
           'rid' => $uid,
            'is_img' => 0,
            'content' => $data
        ]);
    }
}