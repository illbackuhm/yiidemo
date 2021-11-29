<?php
use \yii\helpers\Url;
echo $this->render("/common/head");
?>
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
<!--        <a href="">首页</a>
        <a href="">演示</a>-->
        <a><cite>Banner列表</cite></a>
      </span>
        <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon layui-icon-refresh-3" style="line-height:38px"></i></a>
    </div>
    <div class="x-body">

      <xblock>
        <button class="layui-btn" onclick="x_admin_show('新增banner','<?= Url::to("/core/banner_add")?>',900)">添加banner</button>
        <span class="x-right" style="line-height:40px">共有数据：<?= $page->totalCount?>条</span>
      </xblock>
      <table class="layui-table" lay-size="sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>缩略图</th>
            <th>URL</th>
            <th>排序</th>
            <th>操作</th>
        </thead>
        <tbody>
        <?php foreach($data as $key=>$vol){?>
          <tr>
            <td><?=$vol['banner_id']?></td>
            <td><img src="<?=$vol['src']?>" width="200" height="50"></td>
            <td><?=$vol['url']?></td>
            <td><?=$vol['sort']?></td>
            <td class="td-manage">
                <button type="button" class="layui-btn layui-btn-xs" onclick="x_admin_show('编辑banner','<?= Url::to(['/core/banner_edit','banner_id'=>$vol['banner_id']])?>',900)">编辑</button>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-xs" onclick="del(<?= Url::to($vol['banner_id'])?>)">删除</button>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
      <div class="page">
          <?= \yii\widgets\LinkPager::widget([
                  'pagination' => $page,
                  'nextPageLabel' => '下一页',
                  'prevPageLabel' => '上一页',
                  'firstPageLabel' => '首页',
                  'lastPageLabel' => '尾页',
          ]);?>
      </div>

    </div>
    <script>
      function del(id){
        layui.layer.confirm('确认删除该轮播图？', {
          btn: ['确认','取消'] //按钮
        }, function(){
          $.get("<?= Url::to('/core/banner_del')?>",{banner_id:id},function (re) {
               layer.msg(re.msg,{time:2000},function () {
                   if(re.code==0) sx();
               });
           });
        });
      }
      function close_tip() {
          layer.closeAll();
      }

      function sx() {
         location.reload();
      }
    </script>
  </body>

</html>
