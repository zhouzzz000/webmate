<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/4
 * Time: 20:33
 */

namespace app\api\model;


use think\Model;

class UserFriend extends BaseModel
{
    protected $hidden = ['delete_time','update_time','create_time'];
    public function friendInfo()
    {
        return $this->belongsTo('User','fid','id')->with('avator');
    }
}