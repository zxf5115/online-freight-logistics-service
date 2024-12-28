<table>
  <thead>
  </thead>
  <tbody>
    <tr>
      <td height='66' colspan="10" style="text-align: center; vertical-align: center;font-size: 28px;">
        学员档案信息
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        基本信息
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="width:30px;font-weight: bold;vertical-align: center;">姓名</td>
      <td height='33' colspan="8" style="width:120px;text-align: left; vertical-align: center;">
        {{ $data['archive']['realname'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">登录账户</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['username'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">学员ID</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ "'" . $data['member_no'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">性别</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['archive']['sex']['text'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">身份证号</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{  "'" . $data['archive']['id_card_no'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">电话</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['mobile'] }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">邮箱</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['email'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">微信</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['archive']['weixin'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">地址</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['archive']['province_id']['text'] ?? '' }} {{ $data['archive']['city_id']['text'] ?? '' }} {{ $data['archive']['region_id']['text'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="2" style="font-weight: bold;vertical-align: center;">所在机构名称</td>
      <td height='33' colspan="8" style="text-align: left; vertical-align: center;">
        {{ $data['organization']['title'] ?? '' }}
      </td>
    </tr>

    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        班级列表
      </td>
    </tr>
    <tr>
      <td height='33' colspan="1" style="width: 40px;font-weight: bold;text-align: center; vertical-align: center;">序号</td>
      <td height='33' colspan="9" style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">班级名称</td>
    </tr>
    @if(empty($data['squad']))
      <tr>
        <td height='33' colspan="10" style="text-align: center;vertical-align: center;">
          {{ '暂无数据' }}
        </td>
      </tr>
    @else
      @foreach($data['squad'] as $k => $squad)
        <tr>
          <td height='33' style="text-align: center;vertical-align: center;">
            {{ "'" . $squad['squad_no'] }}
          </td>
          <td height='33' colspan="9" style="text-align: center;vertical-align: center;">
            {{ $squad['title'] }}
          </td>
        </tr>
      @endforeach
    @endif

    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        评价列表
      </td>
    </tr>
    <tr>
      <td height='33' colspan="1" style="width: 40px;font-weight: bold;text-align: center; vertical-align: center;">序号</td>
      <td height='33' colspan="6" style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">评价内容</td>
      <td height='33' colspan="1" style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">评价分数</td>
      <td height='33' colspan="1" style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">评价人</td>
      <td height='33' colspan="1" style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">评价时间</td>
    </tr>

    @foreach($data['comment'] as $k => $comment)
      <tr>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $comment['id'] }}
        </td>
        <td height='33' colspan="6" style="text-align: center;vertical-align: center;">
          {{ $comment['content'] }}
        </td>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $comment['score'] }}
        </td>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ empty($comment['appraiser']) ? '' : $comment['appraiser']['nickname'] }}
        </td>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $comment['create_time'] }}
        </td>
      </tr>
    @endforeach


    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="27" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        学习档案记录
      </td>
    </tr>
    <tr>
      <td height='33' style="width: 40px;font-weight: bold;text-align: center; vertical-align: center;">课程信息</td>
      <td height='33' style="width: 15px;font-weight: bold;text-align: center; vertical-align: center;">学习工具</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">开始学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">结束学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">课件时长</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">累加学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">已学完时长</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">未学完时长</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">移动端学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">PC端学习时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">已学完课件数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">待学完课件数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">练习题正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">测评总次数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">测评最高分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">测评最低分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">测评平均分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">测评结果</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">实操练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">实操练习正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">理论练习总题数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">理论练习正确率</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试总次数</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试最高分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试最低分</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">模拟考试平均分</td>
    </tr>

    @foreach($data['course'] as $k => $course)
      <tr>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $course['title'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Module\Member\Relevance\CourseEnum::getTypeStatus($course['pivot']['type'])['text'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::formatDateTime($course['pivot']['start_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::formatDateTime($course['pivot']['end_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['time_length']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['pivot']['cumulative_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['pivot']['mobile_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['pivot']['pc_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['pivot']['mobile_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\TimeEnum::getTimeLength($course['pivot']['pc_study_time']) }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['already_study_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['wait_study_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['question_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['question_correct'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['test_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['test_high'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['test_low'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['test_average'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ App\Enum\Common\ScoreEnum::getCodeScore($course['pivot']['test_average'])['text'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['reality_practice_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['reality_practice_correct'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['theory_practice_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['theory_practice_correct'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['simulation_exam_total'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['simulation_exam_high'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['simulation_exam_low'] }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $course['pivot']['simulation_exam_average'] }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
