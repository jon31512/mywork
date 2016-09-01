<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-8-18
 * Time: 上午8:51
 */

namespace Admin\Controller;
use Think\Controller;
class ControllerController extends Controller {

//    前置操作方法
    public function _before_index(){
        header("Content-type: text/html; charset=utf-8");
        $this->checkbrow();
        echo $this->Mysql();

    }
    public function index(){
        echo "1111";
    }
    protected function Mysql(){

        if(D('Controller')->index()===1){
            return 1;
        }else{
            return D('Controller')->index();
        }
    }
    protected function checkbrow(){
           if($this->getBrowser()=="ie" &&$this->getBrowserVer()<9){
            echo "<script>alert('您的浏览器版本太低，请使更换浏览器使用！');location='http://www.baidu.com';</script>";die;
           }
        if($this->getBrowser()=="unknown" || $this->getBrowserVer()=="unknown"){
            echo "<script>alert('你的浏览器兼容性太差，请使更换浏览器使用！');location='http://www.baidu.com';</script>";die;
        }
    }
//    检测浏览器版本
    function getBrowser(){
        $agent=$_SERVER["HTTP_USER_AGENT"];
        if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
            return "ie";
        else if(strpos($agent,'Firefox')!==false)
            return "firefox";
        else if(strpos($agent,'Chrome')!==false)
            return "chrome";
        else if(strpos($agent,'Opera')!==false)
            return 'opera';
        else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
            return 'safari';
        else
            return 'unknown';
    }

    function getBrowserVer(){
        if (empty($_SERVER['HTTP_USER_AGENT'])){    //当浏览器没有发送访问者的信息的时候
            return 'unknow';
        }
        $agent= $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
            return $regs[1];
        elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
            return $regs[1];
        elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
            return $regs[1];
        elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
            return $regs[1];
        elseif ((strpos($agent,'Chrome')==false)&&preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
            return $regs[1];
        else
            return 'unknow';
    }

}