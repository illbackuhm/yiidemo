<?php
namespace tanyi\models;

use common\models\Help;
use yii\base\Model;
use yii\data\Pagination;
use \yii\db\Query;

class Core extends Model{

    public function banner_list(){
        $db= (new Query())->from('{{%banner}}');
        $page_data=new Pagination([
            'totalCount'=>$db->count(), //数据总条数
            'defaultPageSize'=>15  //每页显示数据条数
        ]);
        $data=$db->limit($page_data->limit)->offset($page_data->offset)->all();
        return [
            'data'=>$data,  //数据集
            'page'=>$page_data  //分页
        ];
    }

    /**
     * 新增banner
     * @return array
     * @throws \yii\db\Exception
     */
    public function banner_add(){
        $data=\Yii::$app->request->post();
        unset($data['pic']);
        $add=\Yii::$app->db->createCommand()->insert('{{%banner}}',$data)->execute();
        if($add) return Help::show_data('新增成功');
        return Help::show_data('新增失败',1);
    }

    /**
     * 删除banner
     * @return array
     * @throws \yii\db\Exception
     */
    public function banner_del(){
        $id=\Yii::$app->request->get('banner_id');
        $del=\Yii::$app->db->createCommand()->delete('{{%banner}}',"banner_id=$id")->execute();
        if($del) return Help::show_data('删除成功');
        return Help::show_data('删除失败',1);
    }

    /**
     * 获取一条banner信息
     * @return array|bool
     */
    public function get_banner(){
        $id=\Yii::$app->request->get('banner_id');
        $r=(new Query())->from('{{%banner}}')->where(['banner_id'=>$id])->one();
        return $r;
    }






}