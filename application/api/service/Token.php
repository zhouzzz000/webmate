<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 22:16
 */

namespace app\api\service;


class Token
{
    public static function getNewToken($id)
    {
        return md5($id.config('setting.salt'));
    }
}