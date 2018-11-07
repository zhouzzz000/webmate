<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:43
 */

namespace app\api\controller;


use app\api\service\Token;
use think\Controller;
use think\facade\Cache;
use think\Request;
use app\api\model\User as UserModel;
class User extends Controller
{
    public function signIn(Request $request)
    {
        $arr = $request->param();
        $arr['password'] = md5($arr['password'].config('setting.salt'));
        $user = new UserModel([$arr]);
        $user->save($arr);
        if ($user->id){
            $id = $user->id;
            $token = Token::getNewToken($id);
            Cache::set($token,$id,7*60*60);
            return json([
               'id' => $id,
               'token' => $token,
            ]);
        }else{
            return json([
                'id' => -1,
                'token' => false,
            ]);
        }
    }
}