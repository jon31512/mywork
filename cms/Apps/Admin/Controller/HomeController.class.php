<?php
namespace Admin\Controller;
use Think\Controller;
class HomeController extends ControllerController {
//    栏目首页
    public function category(){
        $this->list=M("hometitle")->order("sort")->select();
        $list=node_merge($this->list);
        $this->assign('list',$list);
        $this->display();
    }
//    增加栏目
    public function category_add(){
        if($_GET['type']==='show'){
            $this->pidlist=M("hometitle")->where("pid=0")->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("hometitle")->add($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }

    //    编辑栏目
    public function category_edit(){
        if($_GET['type']==='show'){
            $this->pidlist=M("hometitle")->where("pid>=0")->select();
            $this->list=M("hometitle")->where("id=".$_GET["id"])->select();
            $this->display();
        }
        if($_GET['type']==='status'){
            if($_POST['status']==='1'){$data['status']=0;}
            if($_POST['status']==='0'){$data['status']=1;}
            $rs=M("hometitle")->where("id=".$_POST['id'])->save($data);
            if($rs){
                M("hometitle")->where("pid=".$_POST['id'])->save($data);
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
        }
        if($_GET['type']==='save'){
            $rs=M("hometitle")->where("id=".$_POST['id'])->save($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }

//    删除栏目
    public function category_del(){
        if(IS_GET){
            $rs=M("hometitle")->where("id=".$_GET['id'])->delete();
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }else{
//            $id=split(',',$_POST['listid']);
            $rs=M("hometitle")->delete($_POST['listid']);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    关键词等设置
    public function keywords(){
        $list=M("keywords")->select();
        foreach($list as $key=> $vo){
            if($vo['type']==='1'){
                $list[$key]['type']='关键词';
            }
            if($vo['type']==='2'){
                $list[$key]['type']='网站描述';
            }
            if($vo['type']==='3'){
                $list[$key]['type']='网站标题';
            }
        }
        $this->assign('list',$list);
        $this->display();
    }
    //    增加
    public function keywords_add(){
        if($_GET['type']==='show'){
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("keywords")->add($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    编辑
    public function keywords_edit(){
        if($_GET['type']==='show'){
            $this->list=M("keywords")->where("id=".$_GET["id"])->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("keywords")->where("id=".$_POST['id'])->save($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    删除
    public function keywords_del(){
            $rs=M("keywords")->where("id=".$_GET['id'])->delete();
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
    }

}