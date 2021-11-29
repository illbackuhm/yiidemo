<?php
use \yii\helpers\Url;
?>
<div class="layui-col-md3 ">
    <div class="layui-inline" style="width: 100%">
        <a href="{:url('index/about')}">
            <img style="width: 40%;margin-top: 10px" src="/static/index/image/myhead/c89e74f28d4b3a135a791811f5f85089.jpg" class="layui-circle">
        </a>
        <div style="margin-top: 10px;text-align: center;border-top: 1px dashed #009688;width: 100%">
            <span class="static_lab">
                <p><?=$this->params['static_count']['article_count']?> 篇</p>
                <p>文章总数</p>
            </span>
            <span class="static_lab">
                <p><?=$this->params['static_count']['looknum']?> 次</p>
                <p>浏览总数</p>
            </span>
            <span class="static_lab">
                <p><?=$this->params['static_count']['comment_count']?> 条</p>
                <p>评论总数</p>
            </span>
            <div style="clear: both"></div>
        </div>
        <table class="layui-table" style="margin-bottom: 0px">
            </thead>
            <tbody>
            <tr>
                <td>昵称</td>
                <td>Telkobe</td>
            </tr>
            <tr>
                <td>职业</td>
                <td>PHP开发</td>
            </tr>
            <tr>
                <td>家乡</td>
                <td>四川南充</td>
            </tr>
            <tr>
                <td>住址</td>
                <td>暂居成都</td>
            </tr>
            <tr>
                <td>QQ</td>
                <td><a href="http://wpa.qq.com/msgrd?v=3&uin=946188985&site=qq&menu=yes" target="_blank" style="color: #444bc3">946188985</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div>
    <div style="margin-top: 20px;position: relative">
    <blockquote class="layui-elem-quote layui-text"><span class="icon iconfont iconbiaoqianqun"></span>文章搜索</blockquote>
        <form action="<?=Url::to(['index/search'])?>">
    <input  name="kw" placeholder="搜索关键字" required value="<?=$this->params['kw'] ?? ''?>"  class="layui-input kw" style="padding-right: 30px;">
    <i id="tj" class="layui-icon layui-icon-search" style="position: absolute;bottom: 6px;right: 10px;font-size: 22px;cursor: pointer"></i>
        </form>
    </div>

    <div style="margin-top: 20px">
        <blockquote class="layui-elem-quote layui-text"><span class="icon iconfont iconbiaoqianqun"></span>热门文章</blockquote>
        <ul class="right_ul">
            {volist name='hot' id='vo'}
            <li class="article_title" ><a href="{:url('index/detail',['id'=>$vo['id']])}" class="title_b">{$vo['title']}</a></li>
            {/volist}
        </ul>
    </div>

    <div style="margin-top: 20px">
        <blockquote class="layui-elem-quote layui-text"><span class="icon iconfont iconbiaoqianqun"></span>最新文章</blockquote>
        <ul class="right_ul">
            {volist name='new' id='vo'}
            <li class="article_title" ><a href="{:url('index/detail',['id'=>$vo['id']])}" class="title_b">{$vo['title']}</a></li>
            {/volist}
        </ul>
    </div>

    <div style="margin-top: 20px">
        <blockquote class="layui-elem-quote layui-text"><span class="icon iconfont iconbiaoqianqun"></span>新闻头条</blockquote>
        <div style="padding:8px 8px;background-color: #f2f2f2;max-height: 260px">
            <marquee style="height: 260px;" scrollamount="2" direction="up" onmouseover=this.stop() onmouseout=this.start()>
                {volist name='sentence' id='vo' key='k'}
                <p style="margin-top: 10px;color: #666">
                    <span class="layui-badge layui-bg-green">{$k}</span>
                    <a href="{$vo['url']}" target="_blank">{$vo['title']}
                    <img src="{$vo['thumbnail_pic_s']}" style="height: 150px;width: 100%">
                    </a>
                </p>
                {/volist}
            </marquee>
        </div>
    </div>

    <div style="margin-top: 20px" >
        <blockquote class="layui-elem-quote layui-text"><span class="icon iconfont iconbiaoqianqun"></span>历史上的今天</blockquote>
        <div style="padding:8px 8px;background-color: #f2f2f2;max-height: 260px">
            <marquee style="height: 260px;" scrollamount="2" direction="up" onmouseover=this.stop() onmouseout=this.start()>
                {volist name='history' id='vo' key='k'}
                  <p style="margin-top: 10px;color: #666"> <span class="layui-badge layui-bg-green">{$k}</span> {$vo['des']}</p>
                {/volist}
            </marquee>
        </div>
    </div>
    </div>
</div>

</div>

</div>

<div class="layui-col-md12 foot">
    <div class="layui-main">
        <img  src="/static/index/image/web/gh_dc8f2f8b61b7_258.jpg" width="100" height="100" style="float: right">
        <p>
            <a href="https://tongji.baidu.com/web/welcome/ico?s=e6fe86b21856a301b925bbb897dec576" target="_blank" title="百度统计">百度统计</a>
            <a href="https://www.cnzz.com/stat/website.php?web_id=1277975200" target="_blank" title="站长统计">站长统计</a>
        </p>
        <p>©2018-{$year} <a href="/">www.ntbk8.cn</a>. All rights reserved. &emsp;<a href="http://beian.miit.gov.cn" target="_blank" title="域名备案管理系统">蜀ICP备18006425号</a></p>
        <p style="width: 95%;margin: 0 auto">
            友情链接:
            {volist name='link' id='vo'}
            <a href="{$vo['url']}" target="_blank" title="{$vo['title']==''?$vo['name']:$vo['title']}"> &emsp;{$vo['name']}</a>
            {/volist}
            <a href="{:url('index/link')}" style="color: #749bff"> &emsp;提交友链</a>
        </p>
    </div>
</div>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/index/js/public.js" charset="utf-8"></script>
<script src="/static/index/js/yezi.js" charset="utf-8"></script>
<script src="/static/index/js/jquery.comment.js" charset="utf-8"></script>
<script type="text/javascript">$.AutomLeafStart({leafsfolder:"/static/index/image/yezi/",howmanyimgsare:8,initialleafs:10,maxYposition:20,multiplyclick:true,multiplynumber:2,infinite:true,fallingsequence:6000});/*$("#botAgregar").on("click",function(){$.AutomLeafAdd({leafsfolder:"yezi/",add:8,})});*/</script>
</body>
</html>
