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

use App\Models\Platform\System\Config;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 机构导出类
 */
class OrganizationExport implements FromView, WithEvents
{
  protected $data = null;

  /**
   * 初始化
   */
  public function __construct($data)
  {
    $this->data = $data;
  }


  public function view(): View
  {
      return view('/export/organization', ['data'=>$this->data]);
  }

  public function registerEvents(): array
  {
    $business_license = $this->data['business_license'];

    if(!empty($business_license))
    {
      return [
        AfterSheet::class => function(AfterSheet $event) use ($business_license)
        {
          $this->setImage2Excel($event, 'A3', $business_license, 90, 440);
        }
      ];
    }

    return [];
  }

  /**
   * 添加图片到excel
   * @param $event
   * @param $position：excel表位置
   * @param $path：图片路径
   * @param $width：图片宽度
   * @param $height：图片高度
   * @throws \PhpOffice\PhpSpreadsheet\Exception
   */
  private function setImage2Excel($event, $position, $path, $width, $height)
  {
    $url = Config::getConfigValue('web_url');

    $picture = str_replace($url, '', $path);

    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

    $drawing->setName('Business License');
    $drawing->setDescription('Business License');
    $drawing->setCoordinates($position);
    $drawing->setPath(public_path($picture));

    ($width==0)?null:$drawing->setWidth($width);
    ($height==0)?null:$drawing->setHeight($height);

    $drawing->setWorksheet($event->sheet->getDelegate());
  }
}
