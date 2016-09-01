<?php
namespace Index\Controller;
use Think\Controller;
class AboutController extends ControllerController {
    public function index(){
        if(isset($_GET['about'])){
            $id=$_GET['about'];
            $where= CONTROLLER_NAME.'/'.ACTION_NAME.'/about/'.$id;
            $this->pid=M("hometitle")->where('link="'.$where.'"')->getField('id');
            $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('pid');
            $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
            $newsid=$id;
        }else{
            $where= CONTROLLER_NAME.'/'.ACTION_NAME;
            $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
            $this->pid=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->limit(1)->getField('id');
            $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
            $newsid=explode('/',$this->menu2list[0]['link'])[3];
        }
        $this->content=M('news')->where('id='.$newsid)->getField('content');
        $this->display();
    }

}