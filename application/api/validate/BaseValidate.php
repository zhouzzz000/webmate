<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/5
 * Time: 20:19
 */

namespace app\api\validate;


use app\api\exception\ParamException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $result = $this->batch()->check($params);
        if (!$result)
        {
            throw new ParamException(['msg'=>$this->error]);
        }else{
            return true;
        }
    }
}