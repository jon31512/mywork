<?php
namespace Index\Controller;
use Think\Controller;
class ProductController extends ControllerController {
    public function index(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $id=$_GET['product'];
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->idid=M("hometitle")->where('pid="'.$this->jqid.'" and link like "%'.$id.'%"')->order('sort')->Field('id,name,link')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $this->pro_list=M('product')->where('pid='.$this->idid)->order('sort')->select();
        $this->display();
    }
    public function prodex(){
        $proinfo=M('product')->where('id='.$_GET['id'])->select();
        $arr=array();
        foreach($proinfo as $key=>$vo){
            $arr=$vo;
            $arr['link']=__ROOT__.$vo['link'];
        }
//        prt_a($arr);
        $this->ajaxReturn($arr);
//        echo json_encode($arr);
    }
}