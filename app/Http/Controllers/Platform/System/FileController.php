<?php
namespace App\Http\Controllers\Platform\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

use App\Models\Platform\System\File;
use App\Models\Common\Module\Common\AliVod\Upload;
use App\Models\Platform\System\Config;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-08
 *
 * 文件上传接口控制器类
 */
class FileController extends BaseController
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传文件
   * ------------------------------------------
   *
   * 上传文件
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function file(Request $request)
  {
    $response = Upload::multiFile('file', '1000207734');

    if($response)
    {
      $headers = ['content-type' => 'application/json'];

      $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

      return $response->withHeaders($headers);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传图片
   * ------------------------------------------
   *
   * 上传图片
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function picture(Request $request)
  {
    $response = Upload::file('file', '1000207734');

    if($response)
    {
      return self::success($response);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传广告
   * ------------------------------------------
   *
   * 上传广告
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function advertising(Request $request)
  {
    $response = Upload::file('file', '1000207457');

    if($response)
    {
      return self::success($response);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传课程
   * ------------------------------------------
   *
   * 上传课程
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function course(Request $request)
  {
    $response = Upload::file('file', '1000207458');

    if($response)
    {
      return self::success($response);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 上传头像
   * ------------------------------------------
   *
   * 上传头像
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function avatar(Request $request)
  {
    $response = Upload::file('file', '1000207735');

    if($response)
    {
      return self::success($response);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传图片
   * ------------------------------------------
   *
   * 上传图片
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function image(Request $request)
  {
    $response = Upload::file('file', '1000207734');

    if($response)
    {
      $title = $request->title;

      $response = [
        'title' => $title,
        'url' => $response
      ];

      return self::success($response);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传PDF文件
   * ------------------------------------------
   *
   * 上传PDF文件
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function resource(Request $request)
  {
    $response = File::pdf('file', 'mavon');

    if($response)
    {
      $url = Config::getConfigValue('web_url');

      $url = $url . $response;

      return self::success($url);
    }

    return self::error(Code::FILE_UPLOAD_ERROR);
  }
}
