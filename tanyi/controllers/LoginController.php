<?php

namespace tanyi\controllers;

use tanyi\models\Login;
use common\models\Common;
use common\models\Help;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class LoginController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000,//背景颜色
                'maxLength' => 3, //最大显示个数
                'minLength' => 3,//最少显示个数
                'foreColor' => 0xffffff,     //字体颜色
            ],
            'error'=>'yii\web\ErrorAction'
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if(Yii::$app->request->isPost){
            $model=new Login();
            $r=$model->login();
            return Help::json($r);
        }else{
            if(\Yii::$app->session->get('user')){
                $this->redirect('/index/index');
            }
            return $this->render('login');
        }
    }

    public function actionLogin_out(){
        Yii::$app->session->destroy();
        return $this->render('login');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
