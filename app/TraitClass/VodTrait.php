<?php
namespace App\TraitClass;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Vod\Vod;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-28
 *
 * 视频点播特征
 */
trait VodTrait
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-28
   * ------------------------------------------
   * 初始化视频点播对象
   * ------------------------------------------
   *
   * 初始化视频点播对象
   *
   * @return [type]
   */
  protected static function initVodClient()
  {
    try
    {
      AlibabaCloud::accessKeyClient('LTAI4GJCazL5hJ8YnrtwGbe8', '2Dm4yRUDtsHU8iiHgFVvwvg81TvDWz')
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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-28
   * ------------------------------------------
   * 获取视频点播内容
   * ------------------------------------------
   *
   * 获取视频点播内容
   *
   * @param [type] $videoId [description]
   * @return [type]
   */
  public static function getPlayInfo($videoId)
  {
    try
    {
      self::initVodClient();

      $response = Vod::v20170321()
                      ->getPlayInfo()
                      ->withVideoId($videoId)    // 指定接口参数
                      ->format('JSON')  // 指定返回格式
                      ->request();      // 执行请求

      return $response->PlayInfoList->PlayInfo;
    }
    catch (\Exception $e)
    {
      \Log::error($e);
    }
  }





}
