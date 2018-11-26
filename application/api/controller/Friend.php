<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/9
 * Time: 16:30
 */

namespace app\api\controller;


use app\api\exception\FriendHasException;
use app\api\exception\ParamException;
use app\api\model\MessageHistory;
use app\api\model\UserFriend;
use think\Controller;
use think\Request;

class Friend extends Controller
{
    public function add(Request $request)
    {
        $uid = $request->id;
        $fid = $request->param('friend_id');
        if ($fid == $uid){
            throw new ParamException('不能添加自己');
        }
        $rel = UserFriend::where('uid','=',$uid)->where('fid','=',$fid)
                           ->find();
        if ($rel){
            throw new FriendHasException();
        }
        $arr = [
            'uid' => $uid,
            'fid' => $fid
        ];
        $isOK = (new UserFriend())->save($arr);
        $arr = [
            'sid' => $uid,
            'uid' => $fid
        ];
        $isOK = (new UserFriend())->save($arr);
        return json([
            'msg' => $isOK
        ]);
    }

    public function delete(Request $request)
    {
        $uid = $request->id;
        $fid = $request->param('friend_id');
        if ($fid == $uid){
            throw new ParamException('不能删除自己');
        }
        $rel = UserFriend::where('uid','=',$uid)->where('fid','=',$fid)
            ->find();
        if (!$rel){
            throw new FriendHasException('你和TA还不是朋友');
        }
        $res =  UserFriend::where('uid','=',$fid)->where('fid','=',$uid);
        $res->delete();
        return json([
            'msg' => $rel->delete()
        ]);
    }

    public function friendList(Request $request)
    {
        $data = UserFriend::with(['friendInfo'])->where('uid','=',$request->id)->order('create_time desc')->select();
        return json(
          $data);
    }

    public function remark(Request $request)
    {
        $uid = $request->id;
        $fid = $request->param('friend_id');
        $remark = $request->param('remark');
        $friend = UserFriend::where('uid','=',$uid)->where('fid','=',$fid)
            ->find();
        $friend->remarks = $remark;
        $friend->save();
        return json([
           'msg'=> 1 ,
        ]);
    }

}

