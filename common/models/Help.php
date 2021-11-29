<?php

namespace common\models;

use yii\base\Model;
use yii\web\Response;
use yii\web\UploadedFile;

class Help extends Model{

    /**
     * 返回数据包
     */
    static function show_data($msg='',$code=0,$data=[]){
        return [
            'msg'=>$msg,
            'code'=>$code,
            'data'=>$data
        ];
    }

    /**
     * 返回json数据对象
     */
    static function json($data=[]){
        \Yii::$app->response->format=Response::FORMAT_JSON;
        return $data;
    }

    /**
     * md5加密密码
     */
    static function encryption_mode($str=''){
        if(!strlen($str)) return false;
        return md5($str);
    }

    /**
     * @param $list
     * @param bool $is_menu 是否删除不是菜单的数据
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    static function mk_tree($list,$is_menu=true,$pk='menu_id',$pid='menu_pid',$child='_child',$root=0){
        $tree=array();
        foreach($list as $key=> $val){
            if($val['is_menu']==2 && $is_menu){
                unset($val);
                continue;
            }
            if($val[$pid]==$root){
                //获取当前$pid所有子类
                unset($list[$key]);
                if(! empty($list)){
                    $child=self::mk_tree($list,$is_menu,$pk,$pid,$child,$val[$pk]);
                    $val['_child']=$child;
                    /* if(!empty($child)){
                         $val['_child']=$child;
                     }*/
                }
                $val['menu_url']=substr($val['menu_url'],strpos($val['menu_url'],'/')+1);
                $tree[]=$val;
            }
        }
        return $tree;
    }

    static private function img_check($file,array $rules){
        if(empty($rules)) return '未设置验证规则';
        foreach($rules as $key=>$vo){
            switch ($key){
                case 'size':
                    if($file->size>=$vo) return  '文件大小超过限制';break;
                case 'extension':
                    if(!in_array($file->extension,$vo)) return  '文件格式不正确';break;
            }
        }
        return false;
    }

    /**
     * 上传文件
     * @param $field  文件域的字段名
     * @param array $rule 验证规则
     * @return array
     */
    static function upload_file($field,$rule=[]){
        $upload=(new UploadedFile())::getInstanceByName($field);
        if(!empty($rule)){
            $check=self::img_check($upload,$rule);
            if($check) return self::show_data($check,1);
        }
        $path='upload/'.date('Ym').'/';
        if(!file_exists($path)) mkdir($path,0777,true);
        $src=$path.md5(time().rand(1000,9999)).'.'.$upload->extension;
        $r=$upload::getInstanceByName('pic')->saveAs($src);
        if($r) return self::show_data('上传成功',0,['src'=>'/'.$src]);
        return  self::show_data($upload->error,1);
    }


}