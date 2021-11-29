<?php
namespace index\models;

use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Cookie;

class Index extends Model{

    public function static_index(){
        return [
            'banner'=>$this->get_banner(),
            'article'=>$this->get_article(),
        ];
    }

    public function static_count(){
        $static_count=\Yii::$app->cache->get('static_count');
        if(!$static_count){
            $article_count=(new Query())->from('{{%article}}')->count();
            $comment_count=(new Query())->from('{{%comment}}')->count();
            $looknum=(new Query())->from('{{%article}}')->sum('looknum');
            $static_count=[
                'article_count'=>$article_count,
                'comment_count'=>$comment_count,
                'looknum'=>$looknum
            ];
            \Yii::$app->cache->add('static_count',$static_count,3600*24);
        }
        return $static_count;
    }

    public function get_banner(){
        $data=(new Query())->from('{{%banner}}')->all();
        return $data;
    }

    public function get_article(){
        $db= (new Query())->from('{{%article}} a')
            ->select('a.*,b.title as type')
            ->where(['is_rec'=>1])
            ->leftJoin('{{%article_type}} b','a.column_id=b.id');
        $page_data=new Pagination([
            'totalCount'=>$db->count(), //数据总条数
            'defaultPageSize'=>12  //每页显示数据条数
        ]);
        $data=$db->limit($page_data->limit)->offset($page_data->offset)->all();
        return [
            'data'=>$data,  //数据集
            'page'=>$page_data  //分页
        ];
    }

    public function search(){
        $kw=\Yii::$app->request->get('kw');
        //\Yii::$app->response->cookies->add(new Cookie(['name'=>'kw','value'=>$kw]));
        $r=(new Query)->select('a.*,b.title as type')->from('{{%article}} a')
            ->leftJoin('{{%article_type}} b','a.column_id=b.id')
            ->where("instr(a.title,:title)>0",[':title'=>$kw]);
        $page=new Pagination([
            'totalCount'=>$r->count(), //数据总条数
            'defaultPageSize'=>12 //每页显示数据条数
        ]);
        $data=$r->limit($page->limit)->offset($page->offset)->all();
        return [
            'data'=>$data,  //数据集
            'page'=>$page,  //分页
            'kw'=>$kw
        ];
    }

    public function article(){
        $column_id=\Yii::$app->request->get('column_id');
        $r=(new Query)->select('a.*,b.title as type')->from('{{%article}} a')
            ->leftJoin('{{%article_type}} b','a.column_id=b.id')
            ->where(['a.column_id'=>$column_id]);
        $page=new Pagination([
            'totalCount'=>$r->count(), //数据总条数
            'defaultPageSize'=>12 //每页显示数据条数
        ]);
        $data=$r->limit($page->limit)->offset($page->offset)->all();
        return [
            'data'=>$data,  //数据集
            'page'=>$page,  //分页
        ];
    }

    public function article_detail(){
        $id=\Yii::$app->request->get('id');
        $r=(new Query())->select('a.*,b.title as type_name')->from('{{%article}} a')
            ->leftJoin('{{%article_type}} b','a.column_id=b.id')
            ->where(['a.id'=>$id])->one();
        return $r;
    }

}