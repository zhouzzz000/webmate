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
        $_SESSION['token'] = $request->header('token');
        $client_id = $request->param('client_id');
        Gateway::bindUid($client_id,$uid);
        Gateway::sendToAll(json_encode([
            'type' => 'userlist',
            'userList' => Gateway::getAllUidList()
            ]));
        return json([
             'msg' => 1
        ]);
    }

    public function receive(Request $request)
    {
        $rid = $request->param('rid');
        $content = $request->param('content');
        $time = date('Y-m-d H:i:s',time());

        $temMsg = MessageHistory::create([
            'sid' => $request->id,
            'rid' => $rid,
            'is_img' => 0,
            'content' => $content,
            'read' => 1,
        ]);
        $data = [
          'sid' => $request->id,
          'content' => $content,
          'time' => $time,
           'id' => $temMsg->id,
          'type' => 'send',
            'rid' => $rid,
        ];

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
            $msg = json_decode($msg);
            $msg_history = MessageHistory::where('id','=',$msg->id)->find();
            $msg_history->read = 0;
            $msg_history->save();
            return json([
               'msg' => 0,
               'res' => '对方不在线'
            ]);
        }
    }

    public function mate(Request $request)
    {
        $max = $request->param('max_age');
        $min = $request->param('min_age');
        $sex = $request->param('sex');
        $user = \app\api\model\User::where('age','<=',$max)->where('age','>=',$min)
                                    ->where('sex','=',$sex)->select();
        if (!$user)
        {
            return json([
                'msg' => '-1',
                'uid' => -1,
            ]);
        }
        return json([
            'msg' => '0',
            'uid' => $user,
        ]);
    }
}