<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/11
 * Time: 13:11
 */

namespace app\api\controller;


use app\api\exception\ImageUploadException;
use app\api\exception\ParamException;
use app\api\model\Images;
use app\api\service\Image;
use think\Controller;
use think\Request;
use \app\api\model\Publish as PublishModel;
class Publish extends Controller
{
    public function add(Request $request)
    {
         $id = $request->id;
         $image = $request->param('image');
         $content = $request->param('content');
         if ($image == null && $content == null){
             throw new ParamException('内容为空');
         }
         $bool = false;
         if ($image != null){
             $imgID = Image::handleImages($image);
             $bool = (new PublishModel())->save([
                 'uid' => $id,
                 'content' => $content,
                 'images' => json_encode($imgID),
             ]);
         }else{
             $bool = (new PublishModel())->save([
                 'uid' => $id,
                 'content' => $content,
             ]);
         }
         return json([
             'msg' => $bool,
         ]);
    }
}