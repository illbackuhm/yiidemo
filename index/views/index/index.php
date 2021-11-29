<?php
use \yii\helpers\Url;
echo $this->render("/public/head");
?>
<div class="layui-container" >


<!--    <div class="layui-row">
        <div class="layui-col-xs12">
            <div class="layui-carousel" id="test1" lay-filter="test1">
                <div carousel-item="">
                    <div><img src="/static/index/image/banner/018bf05602870f6ac72.jpg" style="width: 100%;height: 100%"></div>
                  &lt;!&ndash;  <div><img src="/static/index/image/banner/018bf05602870f6ac723.jpg" style="width: 100%;height: 100%"></div>&ndash;&gt;
                    <div><img src="/static/index/image/banner/018bf05602870f6ac72877.j1pg" style="width: 100%;height: 100%"></div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="layui-row layui-col-space10">
        <div class="layui-col-md9">
            <div class="layui-carousel" id="test1" lay-filter="test1" style="margin-bottom: 10px">
                <div carousel-item="">
                    <?php foreach($banner as $key=>$vo){?>
                    <div>
                        <a href="<?=$vo['url']?>"><img src="<?=ADMIN_URL.$vo['src']?>" style="width: 100%;height: 100%"></a>
                    </div>
                    <?php }?>
                </div>
            </div>
            <blockquote class="layui-elem-quote"><span class="icon iconfont iconbiaoqianqun " ></span>推荐文章</blockquote>
            <ul>
                <?php foreach($article['data'] as $key=>$vo){?>
                <li class="list_box">
                    <blockquote class="layui-elem-quote ">
                        <?php if($vo['pic']!=''){?>
                        <div class="list_img">
                            <a href="<?= Url::to(['index/detail','id'=>$vo['id']])?>">
                             <img style="width: 260px;height: 160px" src="<?=ADMIN_URL.$vo['pic']?>">
                            </a>
                        </div>
                        <?php }?>
                        <div class="content" style="width: <?=$vo['pic']==''?'100%':'70%'?>">
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

            <div style="text-align: center">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $article['page'],
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                ]);?>
            </div>
        </div>
        <script> var now='index';</script>
<?=$this->render("/public/foot");?>
