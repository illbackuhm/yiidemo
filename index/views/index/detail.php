<?php
use \yii\helpers\Url;
echo $this->render("/public/head");
?>
<div class="layui-container" >
    <div class="layui-row layui-col-space10">
        <div class="layui-col-md9">
            <blockquote class="layui-elem-quote" style="padding-left: 30px">
                <span class="layui-breadcrumb" lay-separator=">">
                  <a href="/"><span class="icon iconfont iconshouye" style="position: absolute;left: 25px"></span>首页</a>
                  <a href=""><?=$data['type_name']?></a>
                  <a ><cite><?=$data['title']?></cite></a>
               </span>
            </blockquote>
            <div style="background-color: #f2f2f2;padding: 20px 5px">
                <?php if(empty($data)){?>
                <div style="text-align: center">
                    <i class="layui-icon" face="" style="font-size: 10em"></i>
                    <div class="layui-text" style="font-size: 20px;border-bottom: 0.5em solid #009688;padding-top: 1em;padding-bottom:1em;">
                        该文章已被关闭或移除！
                    </div>
                </div>
                <?php }else{?>
                <div class="title" style="text-align: center"><?=$data['title']?></div>
                <div>
                    <blockquote class="layui-elem-quote" style="border-left: 0px">
                        <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconwode"></span>作者 : <?=$data['author']?></span>
                        <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconlianjiedian"></span>来源 : <?=$data['from']?></span>
                        <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconxianshi"></span>浏览 : <?=$data['looknum']?> 次</span>
                        <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconrili"></span>时间 : <?=$data['createdate']?></span>
                    </blockquote>
                </div>
                <fieldset class="layui-elem-field site-demo-button info">
                    <legend style="font-size: 13px;font-weight: bold">简述</legend>
                    <div style="margin: 1px 5px"><?=$data['abstract']?></div>
                </fieldset>
                <div class="article_content"><?= htmlspecialchars_decode(\yii\helpers\HtmlPurifier::process($data['content']))?></div>
                <blockquote class="layui-elem-quote layui-text" style="margin-top: 30px">
                    上一篇：
                    {if condition="!empty($pre)"}
                    <a href="{:url('index/detail',['id'=>$pre['id']])}" title="{$pre['title']}">{$pre['title']}</a>
                    {else/}
                    没有了
                    {/if}
                    <br><br>
                    下一篇：
                    {if condition="!empty($next)"}
                    <a href="{:url('index/detail',['id'=>$next['id']])}" title="{$next['title']}">{$next['title']}</a>
                    {else/}
                    没有了
                    {/if}
                </blockquote>
                <?php }?>
                <blockquote class="layui-elem-quotet" style="color: #e8241a" >
                    版权声明:原创文章，转载时请注明原始出处,作者等相关信息。<br/>
                    本文连接:https://{$Request.host}{$Request.url}
                </blockquote>
            </div>


            <div style="background-color: #f2f2f2;margin-top: 20px;padding: 20px 10px">
                <form id="comment_form" class="layui-form">
                    <input type="hidden" name="tid" value="0">
                    <input type="hidden" name="url" value="">
                    <input type="hidden" name="s_id" value="{$data['id']}">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">昵称</label>
                            <div class="layui-input-inline">
                                <input type="tel" name="replyName" value="{$Request.cookie.replyName ?? '匿名'}" placeholder="昵称不能为空啊" lay-verify="required|phone" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">个人邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" name="email" value="{$Request.cookie.email ?? ''}" placeholder="个人邮箱（选填）" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">网址</label>
                            <div class="layui-input-inline">
                                <input type="tel" name="web" value="{$Request.cookie.web ?? ''}" placeholder="如:http://xxx.com (选填)" lay-verify="required|phone" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">验证码</label>
                            <div class="layui-input-inline">
                                <input type="text" name="code" style="width: 50%" id="code" value="" placeholder="验证码" autocomplete="off" class="layui-input">
                                <img src="{:url('index/verify')}" alt="" id="verify"  class="passcode" style="height:38px;cursor:pointer;position: absolute;top: 0px;right: 0px" title="点击刷新验证码" onclick="javascript:this.src='{:url("index/verify")}?rand='+Math.random();">
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">头像</label>
                        <div class="layui-input-block">
                            {volist name='head' id='vo' key='k' }
                            <img  src="{$vo.src}" class="layui-nav-img {$k==1?'nav_check':''}" val="{$vo.id}">
                            {/volist}
                            <input type="hidden" name="head_id" id="head_id" >
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">留言内容</label>
                        <div class="layui-input-block">
                            <textarea style="display: none;color: #fff" id="content" ></textarea>
                            <div id="comment_img" style="display: none"><img width="100" height="100" src=""><i style="cursor: pointer" class="layui-icon layui-icon-delete"></i></div>
                            <input type="hidden" name="content">
                            <input type="hidden" class="comment_img">
                        </div>
                    </div>
                </form>

                <div  id="comment" class="commit_btn">留言</div>
                <div  id="upload_img" class="upload_btn"><i class="layui-icon layui-icon-upload"></i> 上传图片</div>
                <div style="clear: both"></div>

                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>评论列表</legend>
                </fieldset>
                <div class="comment-list" >

                </div>
                <div class="pages" style="text-align: center">
                    <div id="page"></div>
                    <!--<div  class="more" page="0" style="background: rgba(255,255,255,0.2)">查看更多</div></div></div>-->
                </div>
            </div>
        </div>
        <script> var total=10,s_id=<?=$data['id']?>,now="{$now}";</script>
        <?=$this->render("/public/foot");?>
        <script>
            $.post('/index/click_static.html', {
                id: s_id
            });
        </script>
        <script src="/static/index/js/msg.js" charset="utf-8"></script>
