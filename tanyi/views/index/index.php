<?php
use \yii\helpers\Url;
echo $this->render("/common/head");
$session=Yii::$app->session->get('user');
?>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">博客管理系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
<!--      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>-->
      <li class="layui-nav-item">
        <a href="javascript:;">附加功能</a>
        <dl class="layui-nav-child">
          <dd><a onClick="clear_cache();"><i class="layui-icon">&#xe639;</i>清除前台缓存</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="https://www.ntbk8.cn" target="_blank">前台页面</a></li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <?= $session['nickname']?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;" onclick='x_admin_show("基本资料","<?= Url::to(['/server/public_user_edit','id'=>$session['admin_id']])?>",600,500)'>基本资料</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="<?= Url::to('/login/login_out')?>">退出</a></li>
    </ul>
  </div>

  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
          <?php foreach($this->params['menu'] as $key=>$vol){?>
              <li class="layui-nav-item  <?= $key==1?'layui-nav-itemed':''?>">
                  <a class="" href="javascript:;"><?= $vol['menu_name']?></a>
                  <dl class="layui-nav-child">
                      <?php foreach($vol['_child'] as $k=>$vo){?>
                      <dd><a class="site-demo-active" href="javascript:;" src="/<?= Url::to($vo['menu_url'])?>" lay-id="<?=$vo['menu_id']?>" ><?=$vo['menu_name']?></a></dd>
                      <?php }?>
                  </dl>
              </li>
          <?php }?>
      </ul>
    </div>
  </div>

  <div class="page-content">
    <div class="layui-tab tab" lay-filter="menu_title" lay-allowclose="false">
      <ul class="layui-tab-title">
        <li class="home layui-this" lay-id="84">主页</li>
      </ul>
      <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
          <iframe  src="<?= Url::to('hello')?>" frameborder="0" scrolling="yes" ></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="page-content-bg"></div>
</div>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

</body>
</html>
<script>
  function clear_cache() {
    $.get("{:url('core/clear_cache')}",function (re) {
      layer.msg(re.msg);
    });
  }
</script>
