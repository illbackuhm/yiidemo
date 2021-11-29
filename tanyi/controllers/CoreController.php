<?php
namespace tanyi\controllers;

use common\models\Help;
use tanyi\models\Core;

class CoreController extends Base{

    private $model;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->model=new Core();
    }

    /**
     * banner图列表
     * @return string
     */
    public function actionBanner_list(){
        $r=$this->model->banner_list();
        return $this->render('banner_list',[
            'data'=>$r['data'],
            'page'=>$r['page']
        ]);
    }

    /**
     * 添加banner
     */
    public function actionBanner_add(){
        if(\Yii::$app->request->isPost){
            $r=$this->model->banner_add();
            return Help::json($r);
        }else{
            return $this->render('banner_add');
        }
    }

    /**
     * 删除banner
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionBanner_del(){
        $r=$this->model->banner_del();
        return Help::json($r);
    }

    /**
     * 上传banner图
     * @return array
     */
    public function actionUpload_banner(){
        $r=Help::upload_file('pic',['size'=>1024*1024*5,'extension'=>['jpeg','png','jpg']]);
        return Help::json($r);
    }

    /**
     * 修改banner
     */
    public function actionBanner_edit(){
        if(\Yii::$app->request->isPost){

        }else{
            $r=$this->model->get_banner();
            return $this->render('banner_edit',[
                'data'=>$r
            ]);
        }
    }





}