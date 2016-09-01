<?php
namespace Index\Controller;
use Think\Controller;
class ControllerController extends Controller {
    protected function _initialize(){
        $url=__INFO__;
        $where= rtrim($url,'.html');
        $pid=  M("hometitle")->where('link ="'.$where.'"')->getField('pid');
        if($pid==='0'){
            $id=  M("hometitle")->where('link ="'.$where.'"')->getField('id');
            $navigation=  M("hometitle")->where('pid ="'.$id.'"')->order('sort')->limit(1)->select();
        }else{
            $navigation=  M("hometitle")->where('link ="'.$where.'"')->limit(1)->select();
        }
        foreach($navigation as$vo){
            $navigation=$vo;
            $navigation['pname']=M("hometitle")->where('id ="'.$vo['pid'].'"')->getField('name');
        }
        $this->assign('navigation',$navigation);
        $this->list=M("hometitle")->where('pid=0 and status=1')->order("sort")->select();
    }
}