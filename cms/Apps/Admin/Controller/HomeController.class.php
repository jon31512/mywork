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
    //    内容导航
    public function navigation(){
        $list=M("navigation")->select();
        $this->assign('list',$list);
        $this->display();
    }
    //    增加栏目
    public function navigation_add(){
        if($_GET['type']==='show'){
            $this->pidlist=M("hometitle")->where("pid>0")->select();
            $this->pidlist=M("hometitle")->where("pid=0")->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $_POST['pt']=M('hometitle')->where('id='.$_POST['pid'])->getField('name');
            $_POST['v_id']=$_POST['pid'];
            $rs=M("navigation")->add($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
}