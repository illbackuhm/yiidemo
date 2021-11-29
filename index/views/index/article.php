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
                  <a ><cite><?=$title ?? '文章列表'?></cite></a>
               </span>
            </blockquote>
            <?php if(empty($data)){?>
            <div class="layui-fluid">
                <div class="layadmin-tips" style="text-align: center">
                    <i class="layui-icon" face="" style="font-size: 10em"></i>

                    <div class="layui-text" style="font-size: 20px;border-bottom: 0.5em solid #009688;padding-top: 1em;padding-bottom:1em;">
                        暂无相关信息！
                    </div>

                </div>
            </div>
            <?php }else{?>
            <ul>
                <?php foreach($data as $key=>$vo){?>
                <li class="list_box">
                    <blockquote class="layui-elem-quote">
                        <?php if($vo['pic']!=''){?>
                            <div class="list_img">
                                <a href="<?= Url::to(['index/detail','id'=>$vo['id']])?>">
                                    <img style="width: 260px;height: 160px" src="<?=ADMIN_URL.$vo['pic']?>">
                                </a>
                            </div>
                        <?php }?>
                        <div class="content" style="width: {$vo['pic']==''?'100%':'70%'}">
                            <div class="title"><a href="<?= Url::to(['index/detail','id'=>$vo['id']])?>" class="title_a"><?=$vo['title']?></a></div>
                            <div class="content_son">
                                <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconbiaoqian"></span> <?=$vo['type']?></span>
                                <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconwode"></span>作者 : <?=$vo['author']?></span>
                                <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconlianjiedian"></span>来源 : <?=$vo['from']?></span>
                                <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconxianshi"></span>浏览次数 : <?=$vo['looknum']?> 次</span>
                                <span class="layui-badge layui-bg-cyan"><span class="icon iconfont iconrili"></span>时间 : <?=$vo['createdate']?></span>
                            </div>
                            <div class="abstract"><a href="{:url('index/detail',['id'=>$vo['id']])}"><?=$vo['abstract']?></a></div>
                        </div>
                        <div class="layui-clear"></div>
                   </blockquote>
                </li>
                <?php }?>
            </ul>
            <?php }?>
            <div style="text-align: center">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $page,
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                ]);?>
            </div>
        </div>
        <script> var now="{$now}";</script>
        <?=$this->render("/public/foot");?>
