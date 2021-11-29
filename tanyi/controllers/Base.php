<?php

namespace tanyi\controllers;

use common\models\Help;
use yii\web\Controller;

class Base extends Controller{
    private $pass_path=[
        'admin/index/welcome',
        'admin/index/index'
    ];  //免权限检测页面

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $user=\Yii::$app->session->get('user');
        if(!$user){
           $this->redirect('/login/login')->send();
        }
        $menu_data=$user['menu']?$user['menu']:[];
        //当前访问路径
        $now_path=strtolower($this->module->id.'/'.$this->id.'/'.$this->action);
        $rule_path=[];
        foreach(array_column($menu_data,'menu_url') as $v){
            $rule_path[]=strtolower($v);
        }
        //当前用户获得的权限
        $rule_path=array_merge($rule_path,$this->pass_path);
        if(
            !in_array($now_path,$rule_path) &&
            $user['admin_super']!='2' &&
            !preg_match("/^public_{1}\w+/i",$this->action)
        )
        {//admin_super为2的为超级管理员，拥有所有权限
            if(\Yii::$app->request->isAjax){
                header('Content-type: application/json'); //json
                echo json_encode(show_data('抱歉，你暂时没有该权限',1));die;
            }
            exit('抱歉，你暂时没有该权限');
        }
        \Yii::$app->view->params=[
            'menu'=>Help::mk_tree($menu_data)
        ];
    }
}