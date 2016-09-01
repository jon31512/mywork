<?php
function prt_a($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die;
}
//转换时间戳为常用的日期格式
function time_string($timestamp,$i=1){
    if($timestamp <1){
        return '无效的Unix时间戳';
    }else{
        switch ($i){
            case 1:
                return date("Y-m-d H:i:s",$timestamp);
                break;
            case 2:
                return date("Y.m.d",$timestamp);
                break;
        }
    }
}
?>