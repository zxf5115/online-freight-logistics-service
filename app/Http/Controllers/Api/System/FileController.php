<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Models\Api\System\File;
use App\Models\Api\System\Config;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Common\AliVod\Upload;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-26
 *
 * 文件上传接口控制器类
 */
class FileController extends BaseController
{
  /**
   * @api {post} /api/file/avatar 1. 上传头像
   * @apiDescription 上传头像
   * @apiGroup 02. 上传模块
   *
   * @apiParam {string} file 图片数据
   *
   * @apiSampleRequest /api/file/avatar
   * @apiVersion 1.0.0
   */
  public function avatar(Request $request)
  {
    try
    {
      $response = Upload::file_base64($request->file, '1000207735');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/file/picture 2. 上传图片（非答案）
   * @apiDescription 上传图片（非答案）
   * @apiGroup 02. 上传模块
   *
   * @apiParam {string} file 图片数据
   *
   * @apiSampleRequest /api/file/picture
   * @apiVersion 1.0.0
   */
  public function picture(Request $request)
  {
    try
    {
      $response = Upload::file_base64($request->file, '1000207734');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/file/answer 3. 上传答案
   * @apiDescription 上传答案（图片、视频、音频）
   * @apiGroup 02. 上传模块
   *
   * @apiParam {string} file 图片数据
   *
   * @apiSampleRequest /api/file/answer
   * @apiVersion 1.0.0
   */
  public function answer(Request $request)
  {
    try
    {
      $response = Upload::file_base64($request->file, '1000208088');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }



  /**
   * @api {post} /api/file/file 4. 上传文件
   * @apiDescription 上传图片
   * @apiGroup 02. 上传模块
   *
   * @apiParam {string} file 文件数据
   *
   * @apiSampleRequest /api/file/file
   * @apiVersion 1.0.0
   */
  public function file(Request $request)
  {
    try
    {
      $response = Upload::multiFile('file', '1000207734');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/file/business_license 5. 上传营业执照
   * @apiDescription 上传营业执照
   * @apiGroup 02. 上传模块
   *
   * @apiParam {string} file 营业执照数据
   *
   * @apiSampleRequest /api/file/business_license
   * @apiVersion 1.0.0
   */
  public function business_license(Request $request)
  {
    try
    {
      if(empty($request->file))
      {
        return [
          'status' => Code::FILE_UPLOAD_EXIST,
          'message' => Code::$message[Code::FILE_UPLOAD_EXIST]
        ];
      }
      $picture = $request->file;

      $response = File::file_base64($picture, 'mavon');

      $url = Config::getConfigValue('web_url');

      $url = $url . $response;

      if($response)
      {
        return self::success($url);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
