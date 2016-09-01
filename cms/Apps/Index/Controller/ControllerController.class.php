<?php
namespace Index\Controller;
use Think\Controller;
class ControllerController extends Controller {
    protected function _initialize(){
        $this->list=M("hometitle")->where('pid=0 and status=1')->order("sort")->select();
    }
}