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

// +----------------------------------------------------------------------
// | 中间件配置
// +----------------------------------------------------------------------
return [
    // 默认中间件命名空间
    'default_namespace' => 'app\\api\\http\\middleware\\',
    'login' => app\api\http\middleware\Login::class,
    'signIn' => app\api\http\middleware\SignIn::class,
    'token' => app\api\http\middleware\Token::class,
    'user' => app\api\http\middleware\User::class,
    'friend' => app\api\http\middleware\Friend::class,
];
