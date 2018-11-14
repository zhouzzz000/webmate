<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/11
 * Time: 14:56
 */

namespace app\api\service;


use app\api\model\Images;

class Image
{
    public static function createImg($image,$dirPath)
    {
        $imgName = [];
        foreach ($image as $img)
        {
            $arr = explode(',',$img);
            $b = preg_match('/image\/(.*)\;/',$arr[0],$ext);
            if ($b) {
                $img =  md5($arr[1]) . '.' . $ext[1];
                $imgPath = $dirPath .'/'.$img;
                if (!file_exists($imgPath)) {
                    $isOk = file_put_contents($imgPath, base64_decode($arr[1]));
                    if (!$isOk) {
                        return [
                            'msg' => '0'
                        ];
                    }else{
                        $imgName[] = $img;
                    }
                } else {
                    $imgName[] = $img;
                }
            }else{
                throw new ImageUploadException();
            }
        }
        return $imgName;
    }

    public static function handleImages($image)
    {
        $dirPath = 'image/'.date('Y-m-d',time());
        if (!is_dir($dirPath))
        {
            mkdir($dirPath,'4777',true);
        }
        $imgName = self::createImg($image,$dirPath);
        $imgID = [];
        foreach ($imgName as $i) {
            $ti = Images::where('url', '=', $i)->where('from', '=', 2)->find();
            if ($ti) {
                $imgID[] = $ti->id;
            } else {
                $tmp = [
                    'url' => $i,
                    'from' => 2,
                ];
                $tid = new Images();
                $tid->save($tmp);
                if ($tid) {
                    $imgID[] = $tid->id;
                }
            }
        }
        return $imgID;
    }
}