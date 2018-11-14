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
Route::post('user/change/password', 'api/User/updateUserPassword')->middleware(['token','user']);
Route::post('user/logout', 'api/User/logout')->middleware(['token']);
Route::post('user/login', 'api/User/login')->middleware(['login']);


Route::post('friend/add', 'api/Friend/add')->middleware(['token','friend']);
Route::post('friend/delete', 'api/Friend/delete')->middleware(['token','friend']);
Route::get('friend/list', 'api/Friend/friendList')->middleware(['token']);
Route::post('friend/remark', 'api/Friend/remark')->middleware(['token','friend']);


Route::post('publish/add', 'api/Publish/add')->middleware(['token']);
Route::get('publish/list', 'api/Publish/publishList')->middleware(['token']);
Route::get('publish/user_list', 'api/Publish/userList')->middleware(['publish']);
Route::post('publish/delete', 'api/Publish/delete')->middleware(['publish']);
Route::post('publish/star', 'api/Publish/star')->middleware(['token']);
Route::post('publish/star_list', 'api/Publish/starList')->middleware(['token']);

return [

];
