<?php
use \yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?? '我的笔记 | 个人博客 | PHP开发'?></title>
    <meta name="description" content="{$description ?? '我的笔记，顾名思义，是记录一些平时工作中遇到的一些问题和解决方法，方便查阅'}" />
    <meta name="keywords" content="{php}echo (isset($keywords) && strlen($keywords))?$keywords:'我的笔记，个人博客，后台程序，网站开发，PHP开发';{/php}" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
    <link rel="stylesheet" href="/static/layui/css/global.css"  media="all">
    <link rel="stylesheet" href="/static/index/css/common.css"  media="all">
    <link rel="stylesheet" href="/static/index/css/iconfont.css"  media="all">
    <link rel="stylesheet" href="/static/index/css/nprogress.css"  media="all">
    <script src="/static/index/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="/static/index/js/nprogress.js" charset="utf-8"></script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?e6fe86b21856a301b925bbb897dec576";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<script>
    $(function() {
        NProgress.start();
        $(window).load(function() {
            NProgress.done();
        })
    })
</script>
<body>
<!-- 叶子代码 开始 -->
<div id="botAgregar"></div>
<!-- 叶子代码 结束 -->
<div class="nav" >
    <ul class="layui-nav">
        <a href="/"><span><img src="/static/index/image/web/logo.png" class="logo"></span></a>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='index'><a href="/">主页</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='5'><a href="<?=Url::to(['index/article','column_id'=>5])?>">PHP后端</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='6'><a href="<?=Url::to(['index/article','column_id'=>6])?>">Mysql</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='8'><a href="<?=Url::to(['index/article','column_id'=>8])?>">Jquery/Js</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='9'><a href="<?=Url::to(['index/article','column_id'=>9])?>">Linux</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='11'><a href="<?=Url::to(['index/article','column_id'=>11])?>">其他文章</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='98'><a href="{:url('index/about')}">关于</a></li>
        <li style="margin-left: 20px" class="layui-nav-item" column_id='99'><a href="{:url('index/msg')}">留言</a></li>
        <li class="layui-nav-item s_nav"  style="display: none"><i class="layui-icon layui-icon-slider"></i> </li>
    </ul>
    <div id="son_nav">
        <dl class="layui-nav-child son_nav_list">
            <dd><a href="{:url('index/article',['column_id'=>5])}">PHP后端</a></dd>
            <dd><a href="{:url('index/article',['column_id'=>6])}">Mysql</a></dd>
            <dd><a href="{:url('index/article',['column_id'=>8])}">Jquery/Js</a></dd>
            <dd><a href="{:url('index/article',['column_id'=>9])}">Linux</a></dd>
            <dd><a href="{:url('index/article',['column_id'=>11])}">其他文章</a></dd>
            <dd><a href="{:url('index/about')}">关于</a></dd>
            <dd><a href="{:url('index/msg')}">留言</a></dd>
        </dl>
    </div>
</div>
