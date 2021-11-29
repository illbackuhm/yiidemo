<?php
namespace tanyi\models;
use common\models\Common;
use common\models\Help;
use yii\base\DynamicModel;
use \yii\base\Model;
use yii\db\Query;

class Login extends Model {

    public function login(){
        $data=\Yii::$app->request->post();
        $check=DynamicModel::validateData($data,[
            ['xx1','required','message' => '账号不能为空'],
            ['xx2','required','message' => '密码不能为空'],
            ['xx3','captcha','captchaAction' => 'login/captcha','message' => '验证码错误']
        ]);
        if($check->hasErrors()){
            return Help::show_data(current($check->getErrors())[0],1);
        }
        $user=(new Query())->from('{{%admin}} a')
            ->leftJoin('{{%role}} b','a.role_id=b.role_id')
            ->where(['a.admin_name'=>$data['xx1']])
            ->select('a.*,b.role_data')->one();
        if(!$user) return Help::show_data('账户不存在',1);
        $pwd=Help::encryption_mode($data['xx2']);
        if($pwd!=$user['admin_pwd']) return Help::show_data('密码错误',1);
        if($user['admin_status']==2) return Help::show_data('账户被禁用，请联系管理员',1);
        if(!strlen($user['role_data']) && $user['admin_super']!=2) return Help::show_data('该用户未分配角色，无法登录',1);
        $where_menu="is_show=1";
        if($user['admin_super']!=2) $where_menu.=" and menu_id in ({$user['role_data']})";
        $menu=(new Query())->from('{{%menu}}')->where($where_menu)->orderBy(['sort'=>SORT_DESC])->all();
        $user['menu']=$menu;
        \Yii::$app->session->set('user',$user);
        return Help::show_data('登录成功');
    }
}