<?php
use \yii\helpers\Url;
echo $this->render("/common/head");
?>
<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
      </span>
    <a class="layui-btn layui-btn-primary layui-btn-small refresh" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon layui-icon-refresh-3" style="line-height:38px"></i></a>
</div>
<div class="x-body">
    <legend>系统信息</legend>
    <div class="layui-field-box" style="padding: 0px">
        <table class="layui-table">
            <tbody>
            <tr>
                <th>服务器IP</th>
                <td><?= $re['server_ip']?></td></tr>
            <tr>
                <th>WEB服务端口</th>
                <td><?= $re['port']?></td></tr>
            <tr>
                <th>运行环境</th>
                <td><?= $re['software']?></td></tr>
            <tr>
                <th>MYSQL版本</th>
                <td><?= $re['mysql_version']?></td></tr>
            <tr>
                <th>Yii</th>
                <td><?= $re['frame_version']?></td></tr>
            <tr>
                <th>剩余空间</th>
                <td><?= $re['diskfree']?></td></tr>
            </tbody>
        </table>
    </div>
    </fieldset>
    <blockquote class="layui-elem-quote layui-quote-nm">感谢使用。</blockquote>
</div>
</body>
</html>
<script src="/static/layui/layui.js" charset="utf-8"></script>

