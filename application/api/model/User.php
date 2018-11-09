<?php

namespace app\api\model;

use think\Model;

class User extends BaseModel
{
    //
    protected $hidden = ['delete_time','update_time','create_time','password'];

    public function avator()
    {
        return $this->belongsTo('Images','avator','id');
    }

}
