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
use app\api\exception\FailedGetList;
use app\api\model\Images;
use app\api\model\StarHistory;
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
        if ($image == null && $content == null) {
            throw new ParamException('内容为空');
        }
        $bool = false;
        if ($image != null) {
            $imgID = Image::handleImages($image);
            $bool = (new PublishModel())->save([
                'uid' => $id,
                'content' => $content,
                'images' => json_encode($imgID),
            ]);
        } else {
            $bool = (new PublishModel())->save([
                'uid' => $id,
                'content' => $content,
            ]);
        }
        return json([
            'msg' => $bool,
        ]);
    }

    public function publishList(Request $request)
    {
        $listRows = $request->param('num');
        $current_page = $request->param('page');

        //判断有没有指定每页数量
        if ($listRows) {
            $list = PublishModel::order('create_time', 'desc')->paginate($listRows);
        } else {
            $list = PublishModel::order('create_time', 'desc')->paginate(10);
        }
        $items = $list->items();
        $itemImgs = [];
        foreach ($items as $item) {
            $images = json_decode($item->images);
            for ($i = 0; $i < count($images); $i++) {
                $id = $images[$i];
                $img = Images::where('id', '=', $id)->find();
                $itemImgs[] = config('setting.publish_img_prefix') . $img->url;
            }
            $tmp = \app\api\model\User::get($item->uid);
            $tmpImg = Images::getUrlByID($tmp->avator);
            $item->avator_url = $tmpImg;
            $item->images = $itemImgs;
            $itemImgs = [];
        }

        //判断当前页
        if ($current_page) {
            $list->current_page = $current_page;
        }

        //判断是否成功获取列表
        if ($list) {
            return json([
                $list
            ]);
        } else {
            throw new FailedGetList();
        }
    }

    public function userList(Request $request)
    {
        $listRows = $request->param('num');
        $current_page = $request->param('page');
        $id = $request->param('id');
        //判断有没有指定每页数量
        $hasPublish = PublishModel::where('uid', '=', $id)->find();
        if ($listRows) {
            $list = PublishModel::where('uid', '=', $id)
                ->order('create_time', 'desc')
                ->paginate($listRows);
        } else {
            $list = PublishModel::where('uid', '=', $id)
                ->order('create_time', 'desc')
                ->paginate(10);
        }
        $items = $list->items();
        $itemImgs = [];
        foreach ($items as $item) {
            $images = json_decode($item->images);
            for ($i = 0; $i < count($images); $i++) {
                $id = $images[$i];
                $img = Images::where('id', '=', $id)->find();
                $itemImgs[] = config('setting.publish_img_prefix') . $img->url . ';';
            }
            $item->images = $itemImgs;
            $itemImgs = [];
        }

        //判断当前页
        if ($current_page) {
            $list->current_page = $current_page;
        }

        //判断是否成功获取列表
        if ($list && $hasPublish) {
            return json([
                $list
            ]);
        } else if (!$hasPublish) {
            return json([
               'msg' => "该用户没有发表任何说说"
            ]);
        } else {
            throw new FailedGetList();
        }
    }

    public function delete(Request $request)
    {
        $cid = $request->param('cid');
        $isdelete1 = StarHistory::where('publish_id', '=', $cid)->delete();
        $isdelete2 = PublishModel::where('id', '=', $cid)->delete();

        if ($isdelete2) {
            return json([
                "msg" => 1
            ]);
        } else {
            return json([
                "msg" => 0
            ]);
        }
    }

    public function star(Request $request)
    {
        $id = $request->id;
        $pid = $request->param('pid');
        $arr = [
            'uid' => $id,
            'publish_id' => $pid,
        ];
        $isExist = StarHistory::where('uid', '=', $id)
            ->where('publish_id', '=', $pid)
            ->find();
        if (!empty($isExist)) {
            $isExist->delete();
            return json([
                "msg" => 2,
            ]);
        } else if (empty($isExist)) {
            StarHistory::create($arr);
            return json([
                "msg" => 1
            ]);
        } else {
            return json([
                "msg" => 0
            ]);
        }
    }

    public function starList(Request $request)
    {
        $id = $request->id;
        $pids = StarHistory::where('uid', '=', $id)->select();
        for ($i = 0; $i < count($pids); $i++) {
            $pid[] = $pids[$i]->publish_id;
        }
        return json([
            $pid
        ]);
    }
}
