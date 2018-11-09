<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/4
 * Time: 20:31
 */

namespace app\api\model;


use think\Model;

class Images extends BaseModel
{
    protected $visible = ['url'];
    public static function getUrlByID($id)
    {
        return self::get($id)->visible(['url'])['url'];
    }
    public function getUrlAttr($value,$data)
    {
        $newValue = $value;
        if ($data['from'] == 0)
        {
            $newValue = config('setting.img_prefix').$value;
        }
        return $newValue;
    }
}