<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\Api\Module\Organization\Squad\Relevance\Member;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 学习记录导出类
 */
class StudyRecordExport implements FromCollection, WithColumnFormatting, ShouldAutoSize
{
  protected $squad_id = null;

  /**
   * 初始化
   */
  public function __construct($squad_id)
  {
    $this->squad_id = $squad_id;
  }

  /**
   * 数组转集合
   */
  public function collection()
  {
    return new Collection($this->createData());
  }


  /**
   * 行样式
   */
  public function columnFormats(): array
  {
    return [
      // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY, //日期
      // 'C' => NumberFormat::FORMAT_NUMBER_00, //金额保留两位小数
    ];
  }


  //业务代码
  public function createData()
  {
    $order = [
      ['key' => 'id', 'value' => 'asc'],
    ];

    $relevance = [
      'member.course',
      'member.archive',
      'member.squad.course',
    ];

    $organization_id = auth('api')->user()->organization_id;

    $squad_id = explode(',', $this->squad_id);

    $condition = [
      'organization_id' => $organization_id,
      'squad_id' => $squad_id,
    ];

    $response = Member::getList($condition, $relevance, $order, true);

    $result = [[
      '姓名',
      '开始学习时间',
      '结束学习时间',
      '课程学习时长',
      '累计学习时长',
      '练习总题数',
      '练习正确率',
      '实操练习总题数',
      '实操练习正确率',
      '理论练习总题数',
      '理论练习正确率',
      '模拟考试总次数',
      '模拟考试最高分',
      '模拟考试最低分',
      '模拟考试平均分',
    ]];

    $data = [];

    foreach($response as $key => $item)
    {
      if(empty($item['member']['course']) || empty($item['member']['squad']) || empty($item['member']['archive']) || empty($item['member']['squad'][0]['course']))
      {
        continue;
      }

      $archive     = $item['member']['archive'];
      $course      = $item['member']['course'];
      $squad       = $item['member']['squad'];
      $squadCourse = $item['member']['squad'][0]['course'];

      $start_time = array_column($course, 'start_time');
      sort($start_time);
      $time_length = array_sum(array_column($squadCourse, 'time_length'));
      $cumulative_study_time = array_sum(array_column($course, 'cumulative_study_time'));
      $question_correct_total = array_column($course, 'question_correct_total');
      $total = array_sum($question_correct_total);
      $number = count($question_correct_total);
      $question_correct_total = intval(round(bcdiv($total, $number), 0));
      $reality_practice_total = array_sum(array_column($course, 'reality_practice_total'));
      $reality_practice_correct = array_column($course, 'reality_practice_correct');
      $total = array_sum($reality_practice_correct);
      $number = count($reality_practice_correct);
      $reality_practice_correct = intval(round(bcdiv($total, $number), 0));
      $theory_practice_total = array_sum(array_column($course, 'theory_practice_total'));
      $theory_practice_correct = array_column($course, 'theory_practice_correct');
      $total = array_sum($theory_practice_correct);
      $number = count($theory_practice_correct);
      $theory_practice_correct = intval(round(bcdiv($total, $number), 0));
      $simulation_exam_total = array_sum(array_column($course, 'simulation_exam_total'));
      $simulation_exam_high = array_column($course, 'simulation_exam_high');
      $total = array_sum($simulation_exam_high);
      $number = count($simulation_exam_high);
      $simulation_exam_high = intval(round(bcdiv($total, $number), 0));
      $simulation_exam_low = array_column($course, 'simulation_exam_low');
      $total = array_sum($simulation_exam_low);
      $number = count($simulation_exam_low);
      $simulation_exam_low = intval(round(bcdiv($total, $number), 0));
      $simulation_exam_average = array_column($course, 'simulation_exam_average');
      $total = array_sum($simulation_exam_average);
      $number = count($simulation_exam_average);
      $simulation_exam_average = intval(round(bcdiv($total, $number), 0));


      $data[$key][] = $archive['realname'];
      $data[$key][] = date('Y-m-d', $start_time[0]);
      $data[$key][] = $squad[0]['end_time'];
      $data[$key][] = $time_length;
      $data[$key][] = $cumulative_study_time;
      $data[$key][] = 1;
      $data[$key][] = $question_correct_total;
      $data[$key][] = $reality_practice_total;
      $data[$key][] = $reality_practice_correct;
      $data[$key][] = $theory_practice_total;
      $data[$key][] = $theory_practice_correct;
      $data[$key][] = $simulation_exam_total;
      $data[$key][] = $simulation_exam_high;
      $data[$key][] = $simulation_exam_low;
      $data[$key][] = $simulation_exam_average;
    }

    $result = array_merge($result, $data);

    return $result;
  }
}
