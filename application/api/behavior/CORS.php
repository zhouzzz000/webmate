<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/11
 * Time: 13:24
 */

namespace app\api\behavior;


class CORS
{
    public function appInit()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Credentials:false');

        if (request()->isOptions())
        {
            exit();
        }
    }
}
