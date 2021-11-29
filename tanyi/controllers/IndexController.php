<?php
namespace  tanyi\controllers;


class IndexController extends Base{

    /**
     * @return string
     * 首页
     */
    public function actionIndex(){
        return $this->render('index');
    }

    /**
     * 欢迎页
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionHello(){
        $sys_info_array = [];
        //$sys_info_array ['gmt_time'] = date ( "Y年m月d h:i:s", time ()- 8 * 3600 );//格林威治标准时间
        //$sys_info_array ['bj_time'] = date ( "Y年m月d h:i:s", time ());//北京时间
        $sys_info_array ['server_ip'] = gethostbyname ( $_SERVER ["SERVER_NAME"] );//服务器ip地址
        $sys_info_array ['software'] = $_SERVER ["SERVER_SOFTWARE"];  //服务器解译引
        $sys_info_array ['port'] = $_SERVER ["SERVER_PORT"]; //web服务端口
        //$sys_info_array ['admin'] = $_SERVER ["SERVER_ADMIN"];
        $sys_info_array ['url_path']=$_SERVER['HTTP_HOST'];
        $sys_info_array ['diskfree'] = intval ( diskfreespace ( "." ) / (1024 * 1024) ) . 'Mb';
        $sys_info_array ['current_user'] = @get_current_user ();
        $sys_info_array ['timezone'] = date_default_timezone_get();
        $mysql_version = \Yii::$app->db->createCommand('select version()')->queryAll();
        $sys_info_array ['mysql_version'] = $mysql_version[0]['version()'];
        $sys_info_array ['frame_version'] = \Yii::getVersion();
        return $this->render('hello',[
            're'=>$sys_info_array
        ]);
    }
}