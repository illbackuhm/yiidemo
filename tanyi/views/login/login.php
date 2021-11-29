<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin pro - 通用后台管理模板系统（单页面专业版）</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
    <link rel="stylesheet" href="/static/admin/css/login.css"  media="all">
    <script src="/static/admin/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="/static/admin/js/ban.js" charset="utf-8"></script>
</head>
<body layadmin-themealias="default" class="layui-layout-body">
<canvas class="cavs" width="1853" height="876"></canvas>
<div id="LAY_app" class="layadmin-tabspage-none">
     <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" >
         <form class="login-form layui-form" lay-filter="cs" >
    <div class="layadmin-user-login-main">
        <div class="login-title">
            博客后台管理
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                <input type="text" name="xx1" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input type="password" name="xx2" id="LAY-user-login-password" lay-verify="required" autocomplete="off" placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                        <input type="text" name="xx3" id="LAY-user-login-vercode" autocomplete="off" lay-verify="required" placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img title="点击刷新" src="<?=Url::to(['captcha'])?>"  id="verify" style="cursor: pointer" width="130" height="36" onclick="captcha(this)">
                        </div>
                    </div>
                </div>
            </div>
           <!-- <div class="layui-form-item" style="margin-bottom: 20px;">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><span>记住密码</span><i class="layui-icon layui-icon-ok"></i></div>
                <a lay-href="/user/forget" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>
            </div>-->
            <div class="layui-form-item">
                <input value="登录" type="button" class="layui-btn layui-btn-fluid" lay-filter="*" lay-submit >
            </div>
          <!--  <div class="layui-trans layui-form-item layadmin-user-login-other">
                <label>社交账号登入</label>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>

                <a lay-href="/user/reg" class="layadmin-user-jump-change layadmin-link">注册帐号</a>
            </div>-->
        </div>
    </div>
         </form>
</div>
<div class="layui-layer-move"></div></div></body></html>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script>
    $("body").keydown(function() {
        if (event.keyCode == "13") {
            var form = layui.form;
            var data1 = form.val("cs");
            sub(data1)
        }
    });
    localStorage.clear();
    layui.use(['form'], function() {
        var form = layui.form;
        form.on('submit(*)', function(data) {
            sub(data.field)
        })
    });

    function captcha(obj) {
        var src="<?=Url::to(['captcha'])?>";
        obj.src=src+'?v='+Math.random();

    }

    function sub(field) {
        $.post('/login/login', field, function(re) {
            console.log(re);
            if (re.code == 0) {
                var rule = JSON.stringify(re.data.rule);
                localStorage.setItem('rule', escape(rule));
                location.href = '/index/index'
            } else {
                var src="<?=Url::to(['captcha'])?>";
                $('#verify').attr('src',src+'?rand='+Math.random());
                layer.msg(re.msg, {
                    icon: 5,
                    time: 2000
                })
            }
        })
    }
    if (top.location != this.location) {
        top.location.replace("/login/login.html")
    }
</script>



