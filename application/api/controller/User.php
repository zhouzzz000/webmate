<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:43
 */

namespace app\api\controller;


use app\api\model\LoginHistory;
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
        $arr['is_login'] = 1;
        $arr['integral'] = 10;
        $arr['register_at'] = date('Y-m-d H:i:s',time());
        $user = new UserModel([$arr]);
        $user->save($arr);
        if ($user->id){
            $id = $user->id;
            $arr2 = [
                'uid' => $id,
                'login_at' =>  date('Y-m-d H:i:s',time()),
            ];
            LoginHistory::create($arr2);
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

    public function getUserInfo(Request $request)
    {
        $id = Cache::get($request->header('token'));
        $data = UserModel::get($id)->visible(['nick','sex','age','grade','major','register_at','integral','email']);
        return json($data);
    }

    public function updateUserInfo(Request $request)
    {
        $param = $request->request();
        $id = $request->id;
        $user = UserModel::get($id);
        foreach ($param as $key => $value)
        {
            $user ->$key= $value;
        }
        return json([
            'msg' => $user->save(),
        ]);
    }

    public function logout(Request $request)
    {
        $id = $request->id;
        $user = UserModel::get($id);
        if ($user->is_login == 0)
        {
            return json([
                'msg' => 0,
                'content' => '用户没有登陆'
            ]);
        }
        $user->is_login = 0;
        LoginHistory::where('uid','=',$id)
                      ->where('logout_at','=',null)
                      ->update(['logout_at'=> date('Y-m-d H:i:s',time())]);
        return json([
            'msg' => $user->save(),
        ]);
    }

    public function login(Request $request){


        if ($token = $request->header('token')){

            $id = Cache::get($token);
            $user = UserModel::where('id','=',$id)->find();
            $user->is_login = 1 ;
            $user->save();
            $arr2 = [
                'uid' => $id,
                'login_at' =>  date('Y-m-d H:i:s',time()),
            ];
            LoginHistory::create($arr2);
            Cache::set($token,$id,7*60*60);
            return json([
                'id' => $id,
                'notice' => 'success',
            ]);
        }else{
            $arr = $request->param();
            $email = $arr['email'];
            $user = UserModel::where('email','=',$email)->find();
            $id = $user->id;
            $user->is_login = 1 ;
            $user->save();
            $arr2 = [
                'uid' => $id,
                'login_at' =>  date('Y-m-d H:i:s',time()),
            ];
            LoginHistory::create($arr2);
            $token = Token::getNewToken($id);
            Cache::set($token,$id,7*60*60);
            return json([
                'id' => $id,
                'token' => $token,
                'notice' => 'success',
            ]);
        }

    }
}