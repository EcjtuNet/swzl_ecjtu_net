<tr id="info-head">
    <td id="type">物品类型</td>
    <td id="name">物品名称</td>
    <td id="place">地点</td>
    <td id="time">时间</td>
    <td colspan="2" id="description">相关描述</td>
</tr>
<?php
    $count = 0;
    $per_page_count = $this->data['page_count'];
    if ( ! empty($this->data['info']) )
    {
        foreach ($this->data['info'] as $info)
        {
            echo '<tr class="info-content">';
            echo '<td class="type"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->cname . '</a></td>';
            echo '<td class="name"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->name . '</a></td>';
            echo '<td class="place"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->place . '</a></td>';
            echo '<td class="time"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . date('Y-m-d', $info->time) . '</a></td>';
            echo '<td class="description"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">' . $info->description . '</a></td>';
            echo '<td class="more"><a href="/detail/' . $this->data['type'] . '/' . $info->id . '">【详情】</td>';
            echo '</tr>';
            ++$count;
        }
    }
    if ($count < $per_page_count)
    {
        for ($i = $count; $i < $per_page_count; ++$i)
        {
            echo '<tr class="info-content"><td class="type"></td><td class="name"></td><td class="place"></td><td class="time"></td><td class="description"></td><td class="more"></td></tr>';
        }
    }
?>
<tr id="page">
    <td colspan="6"></td>
</tr>
<tr id="not-found">
    <td colspan="6" id="could-not-found">找不到？<a href="/post">点击此填写寻物启事</a></td>
</tr>
<script type="text/javascript">
$('#info').find('a').hover(
    function () {
        $(this).parent().parent().find('td a').each(function () {
            $(this).css('textDecoration', 'underline');
        })
    },
    function () {
        $(this).parent().parent().find('td a').each(function () {
            $(this).css('textDecoration', 'none');
        })
    }
);
</script>