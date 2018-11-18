<?php
/**
 * Created by PhpStorm.
 * User: coolzai
 * Date: 2018/11/18
 * Time: 14:38
 */

namespace app\api\controller;

use app\api\model\MessageHistory;
use app\api\service\Token;
use think\Controller;
use think\Db;
use think\facade\Cache;
use think\Request;

class Message
{
    public function getMessageHistory(Request $request)
    {
        $id = $request->id;
        $fid = $request->param('fid');
        $query = "SELECT sid,rid,is_img,content,create_time
                  from message_history 
                  WHERE rid =? AND sid = ? OR sid = ? AND rid = ?";
        $history = Db::query($query,[$id,$fid,$id,$fid]);

        if($history){
            return json($history);
        }
    }

    public function getUnreadMessageNum(Request $request)
    {
//        $query = 'SELECT sid,COUNT(*) count
//                  from message_history
//                  WHERE rid = $id AND read = 0
//                  GROUP BY sid
//                  ORDER BY count desc';

        $id = $request->id;
        $arr = [];
        $unreadMsgNumList = MessageHistory::where('rid','=',$id)
                            ->field('sid')
                            ->where('read','=',0)
                            ->group('sid')
                            ->select();

        foreach ($unreadMsgNumList as $each){
                $num = MessageHistory::where('sid','=',$each->sid)
                    ->where('rid','=',$id)
                    ->where('read','=',0)
                    ->select();
                $num = count($num);
                $arr[$each->sid] = $num ;
        }

        if($unreadMsgNumList)
        {
            return json([
                'num'=>$arr,
                'msg'=>1,
            ]);
        }else{
            return json([
                'msg'=>0,
            ]);
        }

    }

//    public function getUnreadMessage(Request $request)
//    {
//        $id = $request->id;
//        $msg = MessageHistory::where('sid','=',$id)
//            ->where('read','=',0)
//            ->group('rid')
//            ->select();
//
////        foreach ($msg as $m){
////            $tmp[$]
////        }
//        if($msg){
//            return json([
//                'msg'=>$msg,
//            ]);
//        }else{
//            return json([
//                'msg'=>0,
//            ]);
//        }
//
//    }


}