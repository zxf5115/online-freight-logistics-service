<?php
namespace App\Models\Common\Module\Common\AliVod;

require_once 'Autoloader.php';

use App\Http\Constant\Code;
use App\Models\Platform\System\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Common\Module\Common\AliVod;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-29
 *
 * 视频点播上传模型
 */
class Upload
{
  protected static $image = ['jpg', 'jpeg', 'git', 'png'];

  protected static $video = ['mp4', 'mp3'];


  public static function file($name, $category_id)
  {
    if (!request()->hasFile($name))
    {
      return [
        'status' => Code::FILE_UPLOAD_EXIST,
        'message' => Code::$message[Code::FILE_UPLOAD_EXIST]
      ];
    }

    $file = request()->file($name);

    if(!$file->isValid())
    {
      return [
        'status' => Code::FILE_UPLOAD_FAILURE_RETRY,
        'message' => Code::$message[Code::FILE_UPLOAD_FAILURE_RETRY]
      ];
    }

    // 过滤所有的.符号
    $path = str_replace('.', '', 'tmp');

      // 先去除两边空格
    $path = trim($path, '/');

      // 获取文件后缀
    $extension = strtolower($file->getClientOriginalExtension());

      // 组合新的文件名
    $newName = md5(time()).'.'.$extension;

      // 获取上传的文件名
    $oldName = $file->getClientOriginalName();

    $dir = $path . DIRECTORY_SEPARATOR . date('Y-m-d');

    Storage::disk('public')->makeDirectory($dir);

    $filename = $dir . DIRECTORY_SEPARATOR . $newName;

    if(Storage::disk('public')->put($filename, file_get_contents($file)))
    {
      $filePath = Storage::url($filename);

      $url = Config::getConfigValue('web_url');

      $fileUrl = $url . $filePath;

      if(in_array($extension, self::$image))
      {
        $response = self::uploadWebImage($fileUrl, $newName, $category_id);
      }
      else if(in_array($extension, self::$video))
      {
        $response = self::uploadWebVideo($fileUrl, $newName, $category_id);
      }

      Storage::disk('public')->delete($filePath);

      return $response;
    }
    else
    {
      return false;
    }
  }




  public static function file_base64($file, $category_id)
  {
    try
    {
      // 替换编码头
      preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $data);
      $file = base64_decode(str_replace($data[1], '', $file));

      // 过滤所有的.符号
      $path = str_replace('.', '', 'tmp');

        // 先去除两边空格
      $path = trim($path, '/');

        // 获取文件后缀
      $extension = strtolower($data[2]);

      $filename = time() . mt_rand(1, 9999999);

        // 组合新的文件名
      $newName = md5($filename).'.'.$extension;

      $dir = $path . DIRECTORY_SEPARATOR . date('Y-m-d');

      Storage::disk('public')->makeDirectory($dir);

      $filename = $dir . DIRECTORY_SEPARATOR . $newName;

      $response = '';

      if(Storage::disk('public')->put($filename, $file))
      {
        $filePath = Storage::url($filename);

        $url = Config::getConfigValue('web_url');

        $fileUrl = $url . $filePath;

        if(in_array($extension, self::$image))
        {
          $response = self::uploadWebImage($fileUrl, $newName, $category_id);
        }
        else if(in_array($extension, self::$video))
        {
          $response = self::uploadWebVideo($fileUrl, $newName, $category_id);
        }

        Storage::disk('public')->delete($filePath);

        return $response;
      }
      else
      {
        return false;
      }

    }
    catch(\Exception $e)
    {
      return false;
    }
  }



  public static function multiFile($name, $category_id)
  {
    $response = [
      'succMap' => [],
      'errFiles' => [],
    ];

    if (!request()->hasFile($name))
    {
      return [
        'status' => Code::FILE_UPLOAD_EXIST,
        'message' => Code::$message[Code::FILE_UPLOAD_EXIST]
      ];
    }

    $files = request()->file($name);

    foreach($files as $k => $file)
    {
      if(!$file->isValid())
      {
        return [
          'status' => Code::FILE_UPLOAD_FAILURE_RETRY,
          'message' => Code::$message[Code::FILE_UPLOAD_FAILURE_RETRY]
        ];
      }

      // 过滤所有的.符号
      $path = str_replace('.', '', 'tmp');

        // 先去除两边空格
      $path = trim($path, '/');

        // 获取文件后缀
      $extension = strtolower($file->getClientOriginalExtension());

        // 组合新的文件名
      $newName = md5(time()).'.'.$extension;

        // 获取上传的文件名
      $oldName = $file->getClientOriginalName();

      $dir = $path . DIRECTORY_SEPARATOR . date('Y-m-d');

      Storage::disk('public')->makeDirectory($dir);

      $filename = $dir . DIRECTORY_SEPARATOR . $newName;

      if(Storage::disk('public')->put($filename, file_get_contents($file)))
      {
        $filePath = Storage::url($filename);

        $url = Config::getConfigValue('web_url');

        $fileUrl = $url . $filePath;

        if(in_array($extension, self::$image))
        {
          $response['succMap'][$oldName] = self::uploadWebImage($fileUrl, $newName, $category_id);
        }
        else if(in_array($extension, self::$video))
        {
          $response['succMap'][$oldName] = self::uploadWebVideo($fileUrl, $newName, $category_id);
        }

        Storage::disk('public')->delete($filePath);
      }
      else
      {
        $response['errFiles'][$k] = false;
      }
    }

    return $response;
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-29
   * ------------------------------------------
   * 上传视频
   * ------------------------------------------
   *
   * 上传视频
   *
   * @param [type] $filePath 视频地址
   * @param [type] $title 视频标题
   * @param [type] $category_id 视频分类
   * @return [type]
   */
  public static function uploadWebVideo($fileUrl, $title, $category_id)
  {
    try
    {
      $accessKeyId = env('VOD_ACCESS_KEY_ID');
      $accessKeySecret = env('VOD_ACCESS_KEY_SECRET');

      $uploader = new \AliyunVodUploader($accessKeyId, $accessKeySecret);

      $uploadVideoRequest = new \UploadVideoRequest($fileUrl, $title);

      $uploadVideoRequest->setCateId($category_id);
      $uploadVideoRequest->setStorageLocation('outin-f473c04e0d6011eb976800163e1c8dba.oss-cn-shanghai.aliyuncs.com');
      // $uploadVideoRequest->setTemplateGroupId('32531ee6b101a6b8839895c5d4b604e5');

      $response = $uploader->uploadWebVideo($uploadVideoRequest);

      $result = AliVod::getPlayInfo($response);

      if(!empty($result))
      {
        $response = $result[0]->PlayURL;
      }

      return $response;
    }
    catch (\Exception $e)
    {
      \Log::error($e);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-29
   * ------------------------------------------
   * 上传图片
   * ------------------------------------------
   *
   * 上传图片
   *
   * @param [type] $fileUrl 图片地址
   * @param [type] $title 图片标题
   * @param [type] $category_id 图片分类
   * @return [type]
   */
  public static function uploadWebImage($fileUrl, $title, $category_id)
  {
    try
    {
      $accessKeyId = env('VOD_ACCESS_KEY_ID');
      $accessKeySecret = env('VOD_ACCESS_KEY_SECRET');

      $uploader = new \AliyunVodUploader($accessKeyId, $accessKeySecret);

      $uploadImageRequest = new \UploadImageRequest($fileUrl, $title);

      $uploadImageRequest->setCateId($category_id);

      $response = $uploader->uploadWebImage($uploadImageRequest);

      if(!empty($response))
      {
        $response = $response['ImageURL'];
      }

      return $response;
    }
    catch (\Exception $e)
    {
      \Log::error($e);
    }
  }
}
