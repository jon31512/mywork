<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends ControllerController {
//    角色管理
    public function role(){
        $list=M("web_role")->order('pid')->select();
        $this->assign('list',$list);
        $this->display();
    }
    //    角色管理添加
    public function role_add(){
        if($_GET['type']==='show'){
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("web_role")->add($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    角色管理编辑
    public function role_edit(){
        if($_GET['type']==='show'){
            $this->list=M("web_role")->where("id=".$_GET["id"])->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("web_role")->where("id=".$_POST['id'])->save($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    角色 删除
    public function role_del(){
        if(IS_GET){//逐条删除
            $rs=M("web_role")->where("id=".$_GET['id'])->delete();
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }else{//多条删除
            $rs=M("web_role")->delete($_POST['listid']);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    功能权限
    public function node(){
        $this->list=M("auth_node")->order('sort')->select();
        $list=node_merge($this->list);
        $this->assign('list',$list);
        $this->display();
    }
    //    功能权限添加
    public function node_add(){
        if($_GET['type']==='show'){
            $this->selectlist=M("auth_node")->where("id=".$_GET['id'])->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("auth_node")->add($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    功能权限编辑
    public function node_edit(){
        if($_GET['type']==='show'){
            $this->list=M("auth_node")->where("id=".$_GET["id"])->select();
            $this->pidlist=M("auth_node")->where("id=".$this->list[0]['pid'])->select();
            $this->display();
        }
        if($_GET['type']==='save'){
            $rs=M("auth_node")->where("id=".$_POST['id'])->save($_POST);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    功能权限删除
    public function node_del(){
            $rs=M("auth_node")->where("id=".$_GET['id'])->delete();
            if($rs){
                M("auth_node")->where("pid=".$_GET['id'])->delete();
                echo 1;
            }else{
                echo "添加失败";
            }
    }

    //    管理员管理
    public function user(){
        $list=M("web_user")->select();
        $this->assign('list',$list);
        $this->display();
    }

    //    管理员添加
    public function user_add(){
        if($_GET['type']==='check'){
            if(isset($_POST['username'])){$where="username='".$_POST['username']."'";}
            if(isset($_POST['nickname'])){$where="nickname='".$_POST['nickname']."'";}
            if(isset($_POST['phone'])){$where="phone='".$_POST['phone']."'";}
            $rs=M("web_user")->where($where)->select();
            if($rs){
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
        if($_GET['type']==='show'){
            $rolelist=M("web_role")->select();
            $this->assign('rolelist',$rolelist);
            $this->display();
        }
        if($_GET['type']==='save'){
            $data['username']=trim($_POST['username']);
            $data['nickname']=trim($_POST['nickname']);
            $data['phone']=trim($_POST['phone']);
            $data['password']=md5(trim($_POST['password']));
            $data['ctime']=time();
            $role=split(',',$_POST['role_rid']);
            $data['role']=$role[1];
            $data['rid']=$role[0];
            $rs=M("web_user")->add($data);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    管理员编辑
    public function user_edit(){
        if($_GET['type']==='islock'){
            $rs=M("web_user")->where("id=".$_POST["id"])->select();
            if($rs[0]['islock']==='1'){
                $data['islock']=0;
            }if($rs[0]['islock']==='0'){
                $data['islock']=1;
            }M("web_user")->where("id=".$_POST["id"])->save($data);
        }
        if($_GET['type']==='show'){
            $list=M("web_user")->where("id=".$_GET["id"])->select();
            $rolelist=M("web_role")->select();
            $this->assign('list',$list);
            $this->assign('rolelist',$rolelist);
            $this->display();
        }
        if($_GET['type']==='check'){
            if(isset($_POST['username'])){$where="id <>".$_POST['id']." and username='".$_POST['username']."'";}
            if(isset($_POST['nickname'])){$where="id <>".$_POST['id']." and nickname='".$_POST['nickname']."'";}
            if(isset($_POST['phone'])){$where="id <>".$_POST['id']." and phone='".$_POST['phone']."'";}
            $rs=M("web_user")->where($where)->getField("id");
            if($rs){
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
        if($_GET['type']==='save'){
            $data['username']=trim($_POST['username']);
            $data['nickname']=trim($_POST['nickname']);
            $data['phone']=trim($_POST['phone']);
            if(trim($_POST['password'])==""){
                $data['password']=md5(trim($_POST['password']));
            }
            $role=split(',',$_POST['role_rid']);
            $data['role']=$role[1];
            $data['rid']=$role[0];
            $rs=M("web_user")->where("id=".$_POST['id'])->save($data);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
    //    管理员 删除
    public function user_del(){
        if(IS_GET){//逐条删除
            $rs=M("web_user")->where("id=".$_GET['id'])->delete();
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }else{//多条删除
            $rs=M("web_user")->delete($_POST['listid']);
            if($rs){
                echo 1;
            }else{
                echo "添加失败";
            }
        }
    }
}