<?php
use \yii\helpers\Url;
echo $this->render("/common/head");
?>
<style>
    .layui-form-label{width: 100px}
</style>
  <body>
    <div class="x-body">
        <form class="layui-form" style="padding-bottom: 100px">
            <input name="banner_id" value="<?=$data['banner_id']?>" type="hidden">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    URL
                </label>
                <div class="layui-input-inline">
                    <input type="text"   name="url" value="<?=$data['url']?>" required lay-verify="required" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    排序
                </label>
                <div class="layui-input-inline">
                    <input type="text"  value="<?=$data['sort']?>" name="sort" required lay-verify="required" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">缩略图</label>
                <div class="layui-input-inline">
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <div>
                        <input class="layui-input" name="src"  id="pic" value="<?=$data['src']?>" style="width: 460px">
                        <img src="<?=$data['src']?>" id="img" width="360" height="160">
                    </div>
                </div>
            </div>
            <div class="btn_div"><button  class="layui-btn" lay-filter="add" lay-submit="">修改</button></div>
      </form>
    </div>
    <div class="bottom_div"></div>
    <script>
        layui.use(['form','layer','upload'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer
              ,upload=layui.upload;

            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,field:'pic'
                ,url: "<?= Url::to('/core/upload_banner')?>" //上传接口
                ,done: function(res){
                    //上传完毕回调
                    $('#img').attr('src',res.data.src);
                    $('#pic').val(res.data.src);
                }
                ,error: function(){
                    //请求异常回调
                }
            });

          //监听提交
          form.on('submit(add)', function(data){
              $.post("<?= Url::to('/core/banner_edit')?>",data.field,function (re) {
                  if(re.code==0){
                      layer.alert(re.msg, {icon: 6},function () {
                          parent.sx();
                      });
                  }else{
                      layer.msg(re.msg);
                  }
              });
            return false;
          });


        });
    </script>
  </body>

</html>
