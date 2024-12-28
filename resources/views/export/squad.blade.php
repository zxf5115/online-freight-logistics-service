<table>
  <thead>
  </thead>
  <tbody>
    <tr>
      <td height='66' colspan="10" style="text-align: center; vertical-align: center;font-size: 28px;">
        班级档案信息
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        基本信息
      </td>
    </tr>
    <tr>
      <td height='33' colspan="5" rowspan="10" style="width:50px;vertical-align: center;">

      </td>
      <td height='33' style="width:30px;font-weight: bold;vertical-align: center;">机构名称</td>
      <td height='33' colspan="4" style="width:120px;text-align: left; vertical-align: center;">
        {{ $data['organization']['title'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">所在地</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['home_address'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">负责人</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['head'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">负责人电话</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['head_mobile'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">联系人</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['contact'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">联系人电话</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['contact_mobile'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">邮箱</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['email'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">微信</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['weixin'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">QQ</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['qq'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">机构地址</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['address'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        班级信息
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">班级名称</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['title'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">班级ID</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['squad_no'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">班主任</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['teacher_name'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">开班时间</td>
      <td height='33' colspan="3" style="text-align: center; vertical-align: center;">{{ $data['start_time'] ?? '' }}</td>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">结业时间</td>
      <td height='33' colspan="3" style="text-align: center; vertical-align: center;">{{ $data['end_time'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">班级人数</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['number'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">培训科目</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['course'][0]['title'] ?? '' }}</td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;text-align: center; vertical-align: center;">培训计划</td>
      <td height='33' colspan="8" style="text-align: center; vertical-align: center;">{{ $data['description'] ?? '' }}</td>
    </tr>

    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="20" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        班级花名册（学生档案见后面标签栏）
      </td>
    </tr>
    <tr>
      <td height='33' style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">学员ID</td>
      <td height='33' style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">真实姓名</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">开始学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">结束学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">课件时长</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">累加学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">已学完课时</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">未学完课时</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">练习题正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">实操练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">实操练习正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">理论练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">理论练习正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试总次数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试最高分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试最低分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试平均分</td>
      <td height='33' style="width: 10px;font-weight: bold;text-align: center; vertical-align: center;">费用</td>
      <td height='33' style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">公开班期</td>
    </tr>

    @foreach($data['roster'] as $k => $roster)
      <tr>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $roster['member_no'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['realname'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['start_time'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['end_time'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($roster['course_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($roster['cumulative_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($roster['already_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($roster['already_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['question_total'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['question_correct'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['reality_practice_total'] ?? '' }}
        </td>

        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['reality_practice_correct'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['theory_practice_total'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['theory_practice_correct'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['simulation_exam_total'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['simulation_exam_high'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['simulation_exam_low'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $roster['simulation_exam_average'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          0
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          公开
        </td>

      </tr>
    @endforeach
  </tbody>
</table>
