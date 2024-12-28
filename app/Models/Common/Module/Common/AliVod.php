<?php
namespace App\Models\Common\Module\Common;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Vod\Vod;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-29
 *
 * 视频点播上传模型
 */
class AliVod
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-29
   * ------------------------------------------
   * 初始化视频点播对象
   * ------------------------------------------
   *
   * 初始化视频点播对象
   *
   * @return [type]
   */
  public static function initVod()
  {
    try
    {
      $accessKeyId = env('VOD_ACCESS_KEY_ID');
      $accessKeySecret = env('VOD_ACCESS_KEY_SECRET');

      AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
                           ->regionId('cn-shanghai')
                           ->connectTimeout(1)
                           ->timeout(3)
                           ->asDefaultClient();
    }
    catch (\Exception $e)
    {
      \Log::error($e);
    }
  }


  public static function getPlayInfo($videoId)
  {
    try
    {
      self::initVod();

      $response =  Vod::v20170321()
                      ->getPlayInfo()
                      ->withVideoId($videoId)
                      ->format('JSON')
                      ->request();

      return $response->PlayInfoList->PlayInfo;
    }
    catch (\Exception $e)
    {
      \Log::error($e);
    }
  }
}
