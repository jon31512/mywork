<?php
namespace Admin\Controller;
use Think\Controller;
class AboutController extends ControllerController {
//    新闻咨询首页
    public function index(){
        if($_GET['id']){
            $this->info= M("news")->where('id='.$_GET['id'])->select();
            $this->display('indexdex');
        }else {
            $newslist = M("news")->where('type>=3')->order("istop desc,times desc")->select();
            $this->assign('list', $newslist);
            $this->display();
        }
    }

//    添加新闻
    public function indexadd(){
        if($_GET['type']==='show'){
            $this->display();
        }
        if($_GET['type']==='show_v'){
            $this->display('indexadd_v');
        }
        if($_GET['type']==='upload_v'){
            $item_id=$_GET['upid'];
            $now=time();
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     104857600 ;// 设置附件上传大小100M
            $upload->saveName = $now."_".rand(0,100); // 采用时间戳命名
            $upload->exts      =     array("flv", "swf", "mkv", "avi", "rm", "rmvb", "mpeg", "mpg");// 设置附件上传类型
            $upload->rootPath = './Public/Uploads/file/';
            $filesavepath = '/Public/Uploads/file/';
            $upload->savePath ='';// 设置附件上传目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                echo json_encode(array('state' => $upload->getError()));
            }else{// 上传成功
                foreach($info as $vo){
                    $info=$vo;
                    $data['name']=$vo['name'];
                    $data['savename']=$vo['savename'];
                    $data['savepath']=$vo['savepath'];
                    $data['link']=$filesavepath.$vo['savepath'].$vo['savename'];
                }
                $data['fileid']=$item_id;
                M('uploadfile')->add($data);
                echo '{"serverPath":"'.$info[ "savepath" ] . '","url":"' .$data['link']. '","fileType":"' . $info[ "type" ] . '","original":"' . $info[ "name" ] . '","state":"SUCCESS"}';
        }
        }
        if($_GET['type']==='upload'){
            $filetype=$_GET['dir'];
            $item_id=$_GET['fileid'];
            $now=time();
            $file_name = $_FILES['imgFile']['name'];
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            $upload = new \Think\Upload();// 实例化上传类
            $upload->saveName = $now."_".rand(0,200); // 采用时间戳命名
            $upload->maxSize  = 104857600 ;// 设置附件上传大小100M
            $upload->allowTypes  = "" ;
            $fileallowTypes  = array(
                'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
                'flash' => array('swf', 'flv'),
                'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
                'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
            );// 设置附件上传类型
            //检查扩展名
            if (in_array($file_ext,$fileallowTypes[$dir_name]) === false) {
                echo json_encode(array('error' => 1,'message' =>"上传文件扩展名是不允许的扩展名。\n只允许" . implode(",",  $fileallowTypes[$dir_name]) . "格式。" ));
                exit;
            }
            $upload->rootPath = './Public/Uploads/'.$filetype.'/';
            $filesavepath = '/Public/Uploads/'.$filetype.'/';
            $upload->savePath ='';// 设置附件上传目录
            $info= $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                echo json_encode(array('error' => 1,'message' => $upload->getError()));
                exit;
            }else{// 上传成功 获取上传文件信息

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

                echo json_encode(array('error' => 0, 'url' => $picinfo[0]['showpath'],'filenames'=>"附件:".$file_name));
            }
        }
        if($_GET['type']==='fdelete'){
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
            $_POST['type']=isset($_POST['type'])?$_POST['type']:3;
            $_POST['times']=time();
            $rs=M("news")->add($_POST);
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
            $this->info=M("news")->where("id=".$_GET["id"])->select();
            $htmlData = '';
            if (!empty($this->info[0]['content'])) {
                if (get_magic_quotes_gpc()) {
                    $htmlData = stripslashes($this->info[0]['content']);
                } else {
                    $htmlData = $this->info[0]['content'];
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
            $fileid=M("news")->where("id=".$_POST['id'])->getField('fileid');
            $data['fileid']=$fileid;
            M('uploadfile')->where('fileid="'.$_POST['fileid'].'"')->save($data);
            $_POST['fileid']=$fileid;
            $rs=M("news")->where("id=".$_POST['id'])->save($_POST);
            if($rs){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
        }
    }

//    删除栏目
    public function indexdel(){
            $id=M("news")->where("id=".$_GET['id'])->getField('id');
            $fileid=M("news")->where("id=".$id)->getField('fileid');
            $flink=M('uploadfile')->where('fileid="'.$fileid.'"')->Field('id,link')->select();
            if($flink){
                foreach($flink as $key=>$vo){
                    $filepath=".".$vo['link'];
                    unlink($filepath);
                    M('uploadfile')->where('fileid="'.$fileid.'"')->delete();
                }
            }
            $rs=M("news")->where("id=".$id)->delete();
            if($rs){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn('添加失败');
            }
    }
}