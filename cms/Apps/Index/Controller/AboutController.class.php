<?php
namespace Index\Controller;
use Think\Controller;
class AboutController extends ControllerController {
    public function index(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $rs=split('/',$this->menu2list[0]['link']);
        $this->content=M('news')->where('id='.$rs[3])->getField('content');
        $this->display();
    }
    public function org(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->linkid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $id=M("hometitle")->where('link="'.$where.'"')->getField('pid');
        $this->jqid=M("hometitle")->where('id='.$id)->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $this->display();
    }
}