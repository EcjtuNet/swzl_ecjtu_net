<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>失物招领平台 - 华东交通大学日新网</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/beautiful-select.css" />
<script type="text/javascript" src="<?php echo base_url() ?>static/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/jqueryui.css" />
<script type="text/javascript" src="<?php echo base_url() ?>static/js/jqueryui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $( "#sqsj" ).datepicker({dateFormat: "yy-mm-dd"});
    $('#fbqs').css('marginTop', '-32px');
    $('#fbqs + a').css('marginTop', '-32px');
    $('#cyxx + a').on('mouseover', function (event) {
        $('#cyxx').css('marginTop', '-32px');
        $('#cyxx + a').css('marginTop', '-32px');
    });
    $('#cyxx + a').on('mouseout', function (event) {
        $('#cyxx').css('marginTop', '-22px');
        $('#cyxx + a').css('marginTop', '-22px');
    });
    $('#postbtn').on('click', function (event) {
        $('#postbtn').css('backgroundImage', 'url("<?php echo base_url() ?>static/img/fbbtn2.gif")');
    });
});
</script>
</head>
<body>
<div id="header" style="background:39% 53% no-repeat url('<?php echo base_url() ?>static/img/logo_new.png')">
    <div class="nav">
            <ul>
                <li><a target="_blank" href="http://swzl.ecjtu.net/">失物招领</a></li>
                <li><a target="_blank" href="http://www.ecjtu.net/">日新网</a></li>
                <li id="weibo"><a target="_blank" href="http://e.weibo.com/u/2961853293">微博平台</a></li>
            </ul>
        </div>
    <!--<ul>
        <li><a href="http://www.ecjtu.net">日新网</a></li>
        <li><a href="http://swzl.ecjtu.net">失物招领</a></li>
    </ul>-->
</div>
</div>
<div id="container">
    <div id="content">
        <div id="sidebar">
            <p id="message-title">亲爱的同学</p>
            <p id="message-content">欢迎来到失物招领，我们会竭尽所能给您提供帮助！</p>
            <div class="sidebar-btn">
                <img alt="" src="<?php echo base_url() ?>static/img/cyxx.png" id="cyxx" />
                <a style="background:#fff;opacity:0;filter:alpha(opacity=0);" href="/"></a>
                <img alt="" src="<?php echo base_url() ?>static/img/masklayer.png" class="masklayer" />
            </div>
            <div class="sidebar-btn">
                <img alt="" src="<?php echo base_url() ?>static/img/fbqs.png" id="fbqs" />
                <a href="/post"></a>
                <img alt="" src="<?php echo base_url() ?>static/img/masklayer.png" class="masklayer" />
            </div>
        </div>
        <div class="detail-content">
            <div class="detail-tab" id="fbqs-tab"></div>
            <div class="detail-form">
                <?php echo form_open('post'); ?>
                    <table>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;"><span class="important">*</span>启事类型：</td>
                            <td><select name="qslx"><option value="xwqs">寻物启事</option><option value="zlqs">招领启事</option></select><?php echo form_error('qslx', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;" ><span class="important" >*</span>物品名称：</td>
                            <td><input type="text" name="wpmc" value="<?php echo set_value('wpmc'); ?>" /><?php echo form_error('wpmc', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;"><span class="important">*</span>物品类型：</td>
                            <td>
                                <select name="wplx">
                                <?php
                                    if ( ! empty($this->data['category']) )
                                    {
                                        foreach ($this->data['category'] as $category)
                                        {
                                            echo '<option value="' . $category->cid . '">' . $category->cname . '</option>';
                                        }
                                    }
                                ?>
                                </select>
                                <?php echo form_error('wplx', '<p class="error">', '</p>'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;">地　　点：</td>
                            <td style="width:460px;"><input type="text" name="sqdd" value="<?php echo set_value('sqdd'); ?>" /><?php echo form_error('sqdd', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;" >时　　间：</td>
                            <td><input type="text" name="sqsj" id="sqsj" value="<?php echo set_value('sqsj'); ?>" /><?php echo form_error('sqsj', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;" ><span class="important">*</span>姓　　名：</td>
                            <td><input type="text" name="xm" value="<?php echo set_value('xm'); ?>" /><?php echo form_error('xm', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;"><span class="important">*</span>手机号码：</td>
                            <td><input type="text" name="sjhm" value="<?php echo set_value('sjhm'); ?>" /><?php echo form_error('sjhm', '<p class="error">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td class=".detail-title" style="color: #696969; font-size: 14px; line-height: 14px; text-align: right; width: 110px;"><span class="important">*</span>详细描述：</td>
                            <td><textarea rows="4" cols="30" name="xxms"><?php echo set_value('xxms'); ?></textarea><?php echo form_error('xxms', '<p class="areaerr">', '</p>'); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="" id="postbtn" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="clearb"></div>
        </div>
    </div>
</div>
<div id="footer">
    <p><a href="http://www.ecjtu.net/about/">关于我们</a> | <a href="http://123.ecjtu.net/">网址导航</a> | <a href="http://hr.ecjtu.net/">人才招聘</a> | <a href="mailto:roger@ecjtu.jx.cn">不良信息举报</a></p>
    <p>华东交通大学团委、学工处 [ 版权所有 交大日新 ] 赣ICP备05003322号 日新工作室 维护</p>
    <p>信箱：214@ecjtu.net CopyRight 2001-2012 By [ecjtu.net] All Right Reserved</p>
<p><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fff331ba2aed9cae70b1ccaa481038182' type='text/javascript'%3E%3C/script%3E"));
</script></p>
</div>
</body>
</html>
