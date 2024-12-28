<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 学员档案导出类
 */
class ArchiveExport implements WithMultipleSheets
{
  protected $data = null;

  /**
   * 初始化
   */
  public function __construct($data)
  {
    $this->data = $data;
  }


  /**
   * @return array
   */
  public function sheets(): array
  {
    $sheets = [];

    foreach ($this->data as $item) {
        $sheets[] = new ArchiveSheet($item);
    }

    return $sheets;
  }
}
