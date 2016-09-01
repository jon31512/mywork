<?php
namespace Index\Controller;
use Think\Controller;
class NewsController extends ControllerController {
    public function index(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $this->newslist=M('news')->where('type=1')->order('times desc')->Field('id,title,times')->select();
        $this->display();
    }
    public function industry(){
        $where= CONTROLLER_NAME.'/'.ACTION_NAME;
        $this->linkid=M("hometitle")->where('link="'.$where.'"')->getField('id');
        $id=M("hometitle")->where('link="'.$where.'"')->getField('pid');
        $this->jqid=M("hometitle")->where('id='.$id)->getField('id');
        $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
        $this->newslist=M('news')->where('type=2')->order('times desc')->Field('id,title,times')->select();
        $this->display();
    }
    public function dex(){
        if($_GET['news']){
            $where= CONTROLLER_NAME.'/index';
            $this->jqid=M("hometitle")->where('link="'.$where.'"')->getField('id');
            $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
            $this->xxxxx=$this->menu2list[0]['id'];
            $this->title_cn="新闻资讯";
            $this->title_en="NEWS INFORMATION";

            $news=M('news');
            $this->newsinfo=$news->where('type=1 and id='.$_GET['news'])->select();
            $news->where('type=1 and id='.$_GET['news'])->setInc('view');
            $id=$this->newsinfo[0]['id'];
            //上一篇
            $front=$news->where("type=1 and id<".$id)->order('id desc')->limit(1)->find();
            $f=!$front?'没有了':'<a href="'.__ROOT__.'/News/dex/news/'.$front['id'].'.html">'.$front['title'].'</a>';
            $this->assign('front',$f);
            //下一篇
            $after=$news->where("type=1 and id>".$id)->limit('1')->find();
            $a=!$after?'没有了':'<a href="'.__ROOT__.'/News/dex/news/'.$after['id'].'.html">'.$after['title'].'</a>';
            $this->assign('after',$a);

            $this->display();
        }
        if($_GET['industry']){
            $where= CONTROLLER_NAME.'/industry';
            $this->linkid=M("hometitle")->where('link="'.$where.'"')->getField('id');
            $id=M("hometitle")->where('link="'.$where.'"')->getField('pid');
            $this->jqid=M("hometitle")->where('id='.$id)->getField('id');
            $this->menu2list=M("hometitle")->where('pid="'.$this->jqid.'"')->order('sort')->Field('id,name,link')->select();
            $this->xxxxx=$this->linkid;
            $this->title_cn="行业动态";
            $this->title_en="INDUSTRY NEWS";

            $news=M('news');
            $this->newsinfo=$news->where('type=2 and id='.$_GET['industry'])->select();
            $news->where('type=2 and id='.$_GET['industry'])->setInc('view');
            $id=$this->newsinfo[0]['id'];
            //上一篇
            $front=$news->where("type=2 and id<".$id)->order('id desc')->limit(1)->find();
            $f=!$front?'没有了':'<a href="'.__ROOT__.'/News/dex/industry/'.$front['id'].'.html">'.$front['title'].'</a>';
            $this->assign('front',$f);
            //下一篇
            $after=$news->where("type=2 and id>".$id)->limit('1')->find();
            $a=!$after?'没有了':'<a href="'.__ROOT__.'/News/dex/industry/'.$after['id'].'.html">'.$after['title'].'</a>';
            $this->assign('after',$a);

            $this->display();
        }
    }
}