<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-8-30
 * Time: 下午3:52
 */

namespace Index\Controller;
use Think\Controller;
class JoinController extends ControllerController {
    public function join(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $this->display();
    }
    public function joinzc(){
        $id=$_GET['cc'];
        $where= CONTROLLER_NAME.'/'.ACTION_NAME.'/cc/'.$id;
        $this->infoid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('pid');
        $this->idid=M("hometitle")->where('id="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->idid.'"')->order('sort')->Field('id,name,link')->select();
        $this->info=M('news')->where('id='.$id)->getField('content');
        $this->display();
    }
    public function joinwww(){
        $id=$_GET['cc'];
        $where= CONTROLLER_NAME.'/'.ACTION_NAME.'/cc/'.$id;
        $this->infoid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('pid');
        $this->idid=M("hometitle")->where('id="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->idid.'"')->order('sort')->Field('id,name,link')->select();
        $this->info=M('news')->where('id='.$id)->getField('content');
        $this->display();
    }
}