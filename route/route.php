<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::post('user/sign_in', 'api/User/signIn')->middleware(['signIn']);
Route::get('user/info', 'api/User/getUserInfo')->middleware(['token']);
Route::post('user/change/info', 'api/User/updateUserInfo')->middleware(['token','user']);
Route::post('user/logout', 'api/User/logout')->middleware(['token']);
return [

];
