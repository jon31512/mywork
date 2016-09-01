<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <meta name="keywords" content="瑞泽天下，泸州酒"/>
    <script src="/mywork/cms/Public/js/jquery-1.10.1.js"></script>
    <title>泸州润泽天下酒类销售有限责任公司,欢迎您！</title>
    <style>
        *{margin: 0; padding: 0;font-size: 18px;}
        html,body{height: 100%;}
        .clearfix:after { clear:both; content:"."; display:block; line-height:0; font-size:0; visibility:hidden;}
        .body{
            background:url('/mywork/cms/Public/img/index/index.png') no-repeat top;position: relative;width: 100%;height: 100%;background-size: 100% 100%;margin: 0 auto;max-width:1920px;}
        .title{position: absolute;top: 50px;left: 20px;width:500px; }
        .title img {cursor: pointer;border: 0;}
        .top_right{position: absolute; width:400px;top:50px;right: 10px;}
        .top_right .r02{
           position: absolute;right: 30px;top: 0px;cursor: pointer;
        }
        .r01{
            position: absolute;right: 80px;top: 0px;width: 220px;
        }
        .r01 img{margin-left: 25px;cursor: pointer;}
        .menu{
            background-repeat: no-repeat;background-position:center center;background-size: 100% 100%;
            width: 105px;background-image: url("/mywork/cms/Public/img/index/munu_03.png");position: absolute;right: 23px;display: none;top: 75px;}
        ul{list-style:none;padding: 0 0 10px 10px;margin-bottom:-1px;}
        li{margin-top: 12px;border-bottom:1px solid #2fa5d6;width: 85px;padding-bottom: 8px;}
        li:first-child{margin-top: 25px;}
        li:last-child{border:none}
        a {font-size:16px}
        a:link {color: #fff; text-decoration:none;}
        a:active{color: #fff; }
        a:visited {color:#fff;text-decoration:none;}
        a:hover {color: #000000; text-decoration:none;}
    </style>

</head>
<body>
<div class="body clearfix">
<span class="title">
<a href="javascript:;"><img src="/mywork/cms/Public/img/index/logo.png"></a>
</span>
    <span class="top_right">
        <span class="r01">
            <img src="/mywork/cms/Public/img/index/top01.png">
            <img src="/mywork/cms/Public/img/index/wbo1.png" >
            <img src="/mywork/cms/Public/img/index/qq1.png" >
        </span>
    <span class="r02"><img src="/mywork/cms/Public/img/index/top_right_04_03.png"></span>
    </span>
    <div class="menu">
        <ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>&nbsp;<a href="/mywork/cms/<?php echo ($vo["link"]); ?>" class="link"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
</div>
</div>
<script>
    var height=$(window).height(); //浏览器当前窗口可视区域高度
    var width =$(window).width(); //浏览器当前窗口可视区域高度
    $('.r02').click(function(){
        if($('.menu').css('display')==="none"){
            $('.menu').css('display','block');
        }else{
            $('.menu').css('display','none');
        }
    });
    var text=document.title
    var timerID
    function newtext() {
        clearTimeout(timerID)
        document.title=text.substring(1,text.length)+text.substring(0,1)
        text=document.title.substring(0,text.length)
        timerID = setTimeout("newtext()", 600)
    }
    newtext();
</script>
</body>
</html>