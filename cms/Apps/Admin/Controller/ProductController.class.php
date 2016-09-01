<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends ControllerController {
//    产品中心
    public function index(){
        if($_GET['id']){
            $this->info= M("product")->where('id='.$_GET['id'])->select();
            $this->display('indexdex');
        }else {
            $list = M("product")->join(' hometitle ON product.pid = hometitle.id')->Field('hometitle.name as pidname,product.*')->select();
            $this->assign('list', $list);
            $this->display();
        }
    }

//    添加产品
    public function indexadd(){
        if($_GET['type']==='show'){
            $Product = M("hometitle")->where('pid=5')->select();
            $this->assign('Product', $Product);
            $this->display();
        }
        if($_GET['type']==='upload'){
            $now=time();
            $item_id=$_GET['fileid'];
            $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     104857600 ;// 设置附件上传大小100M
            $upload->saveName = $now."_".rand(0,100); // 采用时间戳命名
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录
                $upload->rootPath = './Public/Uploads/product/';
                $filesavepath='/Public/Uploads/product/';
                $upload->savePath ='';// 设置附件上传目录
                // 上传文件
                $info   =   $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    echo json_encode(array('error' => 1,'message' => $upload->getError()));
                    exit;
                }else{// 上传成功
                    $picinfo =$info;
                    $data=array();
                    foreach($picinfo as $key=>$vo){
                        $data['name']=$vo['name'];
                        $data['savename']=$vo['savename'];
                        $data['savepath']=$vo['savepath'];
                        $data['link']=$filesavepath.$vo['savepath'].$vo['savename'];
                    }
                    $data['fileid']=$item_id;
                    M('uploadfile')->add($data);
                    $picinfo[0]['savepath']='/'.$data['link'];
                    $picinfo[0]['showpath']=__ROOT__.$picinfo[0]['savepath'];
                    echo json_encode(array('error' => 0, 'url' => $picinfo[0]['showpath']));
                }
        }
        if($_GET['type']==='delete'){
           $fileid=$_GET['fileid'];
            $rs=M('uploadfile')->where('fileid="'.$fileid.'"')->Field('link')->select();
            if($rs){
                foreach($rs as $key=>$vo){
                        $filepath=".".$vo['link'];
                    unlink($filepath);
                }
                M('uploadfile')->where('fileid="'.$fileid.'"')->delete();
                $this->ajaxReturn(1);
            }
        }
        if($_GET['type']==='save'){
            $link=M('uploadfile')->where('fileid="'. $_POST['fileid'].'"')->getField('link');
            $data['link']=empty($link)?0:$link;
            $data['product']=trim($_POST['content']);
            $data['fieldid']=trim($_POST['fileid']);
            $data['name']=trim($_POST['name']);
            $data['pname']=trim($_POST['pname']);
            $data['xx']=trim($_POST['xx']);
            $data['bz']=trim($_POST['bz']);
            $data['jjd']=trim($_POST['jjd']);
            $data['jhl']=trim($_POST['jhl']);
            $data['sort']=trim($_POST['sort']);
            $data['pid']=trim($_POST['pid']);
            $rs=M('product')->add($data);
            if($rs){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
        }
    }
    //    编辑新闻
    public function indexedit(){
        if($_GET['type']==='show'){
            $Product = M("hometitle")->where('pid=5')->select();
            $this->assign('Product', $Product);
            $this->info=M("product")->where("id=".$_GET["id"])->select();
            $htmlData = '';
            if (!empty($this->info[0]['product'])) {
                if (get_magic_quotes_gpc()) {
                    $htmlData = stripslashes($this->info[0]['product']);
                } else {
                    $htmlData = $this->info[0]['product'];
                }
            }
            $this->content= htmlspecialchars($htmlData);
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
            $link=M('uploadfile')->where('fileid="'. $_POST['fileid'].'"')->getField('link');
            if(!empty($link)){$data['link']=$link;}else{$data['link']=0;
            }
            $data['product']=trim($_POST['content']);
            $data['fieldid']=trim($_POST['fileid']);
            $data['name']=trim($_POST['name']);
            $data['pname']=trim($_POST['pname']);
            $data['sort']=trim($_POST['sort']);
            $data['xx']=trim($_POST['xx']);
            $data['bz']=trim($_POST['bz']);
            $data['jjd']=trim($_POST['jjd']);
            $data['jhl']=trim($_POST['jhl']);
            $data['pid']=trim($_POST['pid']);
            $rs=M("product")->where("id=".$_POST['id'])->save($data);
            if($rs){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
        }
    }

//    删除栏目
    public function indexdel(){
            $id=M("product")->where("id=".$_GET['id'])->getField('id');
            $fileid=M("product")->where("id=".$id)->getField('fieldid');
            $flink=M('uploadfile')->where('fileid="'.$fileid.'"')->Field('id,link')->select();
            if($flink){
                foreach($flink as $key=>$vo){
                    $filepath=".".$vo['link'];
                    unlink($filepath);
                    M('uploadfile')->where('fileid="'.$fileid.'"')->delete();
                }
            }
            $rs=M("product")->where("id=".$id)->delete();
            if($rs){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
    }
}