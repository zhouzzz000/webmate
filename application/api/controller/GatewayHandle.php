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
        return json([
            'msg' => 1
        ]);
    }

    public function receive(Request $request)
    {
        $rid = $request->param('rid');
        $content = $request->param('content');
        $time = time();
        $data = [
          'content' => $content,
          'time' => $time
        ];
//        MessageHistory::create([
//           'sid' => $request->id,
//           'rid' => $rid,
//            'is_img' => 0,
//            'content' => $data
//        ]);
        return $this->send($rid,json_encode($data));
    }

    public function send($uid,$msg)
    {
        Gateway::$registerAddress = '127.0.0.1:1238';
        if (Gateway::getClientIdByUid($uid)) {
            Gateway::sendToUid($uid, $msg);
            return json([
                'msg' => 1,
            ]);
        }else{
            return json([
               'msg' => 0,
               'res' => '对方不在线'
            ]);
        }
    }
}