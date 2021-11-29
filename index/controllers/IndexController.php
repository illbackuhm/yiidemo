<?php
namespace index\controllers;

use index\models\Index;
use yii\web\Controller;

class IndexController extends Controller {
    private $model;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->model=new Index();
        $static_count=$this->model->static_count();
        \Yii::$app->view->params=[
            'static_count'=>$static_count
        ];
    }

    public function actionIndex(){
        $r=(new Index())->static_index();
        return $this->render('index',[
            'banner'=>$r['banner'],
            'article'=>$r['article']
        ]);
    }

    /**
     * 搜索
     */
    public function actionSearch(){
        $r=$this->model->search();
        \Yii::$app->view->params['kw']=$r['kw'];
        return $this->render('article',[
            'data'=>$r['data'],
            'page'=>$r['page']
        ]);
    }

    public function actionArticle(){
        $r=$this->model->article();
        return $this->render('article',[
            'data'=>$r['data'],
            'page'=>$r['page']
        ]);
    }

    public function actionDetail(){
        $r=$this->model->article_detail();
        return $this->render('detail',[
            'data'=>$r
        ]);
    }


}