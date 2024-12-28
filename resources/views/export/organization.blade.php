<table>
  <thead>
  </thead>
  <tbody>
    <tr>
      <td height='66' colspan="10" style="text-align: center; vertical-align: center;font-size: 28px;">
        机构档案信息
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
        {{ $data['title'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">所在地</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['home_address'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">负责人</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['head'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">负责人电话</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['head_mobile'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">联系人</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['contact'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">联系人电话</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['contact_mobile'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">邮箱</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['email'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">微信</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['weixin'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">QQ</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['qq'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' style="font-weight: bold;vertical-align: center;">机构地址</td>
      <td height='33' colspan="4" style="text-align: left; vertical-align: center;">
        {{ $data['address'] ?? '' }}
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        课程信息
      </td>
    </tr>
    <tr>
      <td height='33' style="width: 10px;font-weight: bold;text-align: center; vertical-align: center;">序号</td>
      <td height='33' colspan="3" style="font-weight: bold;text-align: center; vertical-align: center;">课程名称</td>
      <td height='33' colspan="6" style="font-weight: bold;text-align: center; vertical-align: center;">课程介绍</td>
    </tr>

    @foreach($data['course'] as $k => $course)
      <tr>
        <td height='33' colspan="1" style="text-align: center;vertical-align: center;">
          {{ $course['id'] ?? '' }}
        </td>
        <td height='33' colspan="3" style="text-align: left;vertical-align: center;">
          {{ $course['title'] ?? '' }}
        </td>
        <td height='33' colspan="6" style="text-align: left;vertical-align: center;">
          {{ $course['description'] ?? '' }}
        </td>
      </tr>
    @endforeach

    <tr>
      <td height='33' colspan="10">
      </td>
    </tr>
    <tr>
      <td height='33' colspan="10" style="text-align: left; vertical-align: center;font-weight: bold;color: #ffffff;background-color: #00B0F0;">
        所开班级
      </td>
    </tr>
    <tr>
      <td height='33' style="width: 10px;font-weight: bold;text-align: center; vertical-align: center;">序号</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">班级名称</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">开班时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">结业时间</td>
      <td height='33' style="width: 20px;font-weight: bold;text-align: center; vertical-align: center;">班级人数</td>
      <td height='33' style="font-weight: bold;text-align: center; vertical-align: center;">班主任</td>
      <td height='33' colspan="3" style="font-weight: bold;text-align: center; vertical-align: center;">培训计划</td>
      <td height='33' style="font-weight: bold;text-align: center; vertical-align: center;">班级状态</td>
    </tr>


    @foreach($data['squad'] as $k => $squad)
      <tr>
        <td height='33' style="text-align: center;vertical-align: center;">
          {{ $squad['id'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['title'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['start_time'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['end_time'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['number'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['teacher_name'] ?? '' }}
        </td>
        <td height='33' colspan="3" style="text-align: left;vertical-align: center;">
          {{ $squad['description'] ?? '' }}
        </td>
        <td height='33' style="text-align: left;vertical-align: center;">
          {{ $squad['status']['text'] ?? '' }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
