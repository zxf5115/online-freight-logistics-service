<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 学员档案导出类
 */
class ArchiveSheet implements FromView
{
  protected $sheet = null;

  /**
   * 初始化
   */
  public function __construct($data)
  {
    $this->sheet = $data;
  }


  public function view(): View
  {
    return view('/export/archive', ['data'=>$this->sheet]);
  }
}
