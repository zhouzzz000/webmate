<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:14
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1)
        {
            $finalUrl = config('setting.img_prefix');
        }
    }
}