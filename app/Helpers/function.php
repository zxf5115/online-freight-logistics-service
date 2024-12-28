<?php

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 本地环境下进行日志输出
 *
 * @param    [object]     $exception    [异常对象]
 *
 * @return   [false|错误]
 */
function record($exception)
{
  if('local' == config('app.debug'))
  {
    dd($exception);
  }
  else
  {
    \Log::debug($exception);
  }
}
