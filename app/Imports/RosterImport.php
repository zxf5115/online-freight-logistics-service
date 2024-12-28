<?php
namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


use App\Http\Constant\Code;
use App\Enum\Common\SexEnum;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Models\Common\Module\Member\Member;
use App\Models\Common\Module\Organization\Squad\Squad;
use App\Models\Common\Module\Organization\Squad\Relevance\Member as SquadMember;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-08-28
 *
 * 班级花名册导入类
 */
class RosterImport implements ToCollection, WithBatchInserts, WithChunkReading
{
  protected $organization_id = null;
  protected $squad_id        = null;

  public function __construct($squad_id)
  {
    $this->squad_id        = $squad_id;
    $this->organization_id = auth('api')->user()->organization_id;
  }

  public function collection(Collection $rows)
  {
    //如果需要去除表头
    unset($rows[0]);

    //$rows 是数组格式
    return $this->createData($rows);
  }




  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function createData($rows)
  {
    try
    {
      $squad = Squad::getRow(['status' => 1, 'id' => $this->squad_id]);

      if(empty($squad->id))
      {
        return false;
      }

      foreach ($rows as $row)
      {
        if(empty($row[1]) || empty($row[3]) || empty($row[4]))
        {
          \Log::error('花名册缺少内容');

          continue;
        }

        if(!preg_match('/^1[345789][0-9]{9}$/', $row[3]))
        {
          \Log::error('手机号码格式错误');

          continue;
        }

        // if(!preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/', $row[4]))
        // {
        //   \Log::error('身份证号码格式错误');

        //   continue;
        // }

        $nickname   = $row[1];
        $sex        = SexEnum::getCode($row[2]);
        $username   = $row[3];
        $id_card_no = $row[4];

        $organization_id = auth('api')->user()->organization_id;

        $member = Member::firstOrNew(['username' => $username]);

        if(empty($member->id))
        {
          $member->organization_id = $organization_id;
          $member->username        = $username;
          $member->nickname        = $nickname;
          $member->password        = Member::generate(Parameter::PASSWORD);
          $member->member_no       = ToolTrait::generateOnlyNumber(3);
          $member->avatar          = Parameter::AVATER;
          $member->mobile          = $username;
          $member->certification_status = 1;

          $member->save();

          $data = [
            [
              'organization_id' => $organization_id,
              'realname'        => $nickname,
              'id_card_no'      => $id_card_no,
              'sex'             => $sex
            ]
          ];

          // 机构学员资料
          $member->archive()->delete();
          $member->archive()->createMany($data);

          // 机构学员权限
          $data = [['organization_id' => $organization_id, 'role_id' => 3]];
          $member->relevance()->delete();
          $member->relevance()->createMany($data);
        }
        else
        {
          // 如果学员存在结构
          if($this->organization_id != $member->organization_id)
          {
            $message = $row[3] . ': 已经加入机构，无法添加其他机构';
            \Log::error($message);

            continue;
          }

          if(!empty($member->role))
          {
            $role_id = $member->role[0]->id ?? 3;

            if(3 == $role_id)
            {
              $member->organization_id = $organization_id;
              $member->save();

              $member->archive()->update(['organization_id' => $organization_id]);
            }
          }
        }

        $data = [
          'organization_id' => $organization_id,
          'squad_id'        => $squad->id,
          'member_id'       => $member->id,
        ];


        $result = SquadMember::getRow($data);

        if(empty($result))
        {
          (new SquadMember())->create($data);
        }

        $squad->increment('number');
        $squad->save();
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-28
   * ------------------------------------------
   * 批量导入1000条
   * ------------------------------------------
   *
   * 多余1000条数据，一次只导入1000条，多次导入
   *
   * @return [type]
   */
  public function batchSize(): int
  {
      return 1000;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-28
   * ------------------------------------------
   * 以1000条数据基准切割数据
   * ------------------------------------------
   *
   * 以1000条数据基准切割数据
   *
   * @return [type]
   */
  public function chunkSize(): int
  {
      return 1000;
  }
}
