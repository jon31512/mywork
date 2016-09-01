<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($index_title); ?></title>
    <meta name="keywords" content="<?php echo ($index_keywords); ?>"/>
    <meta name="description" content="<?php echo ($index_descript); ?>"/>
    <meta name="author" content="泸州大浪科技制作"/>
    <script src="/mywork/cms/Public/js/jquery-1.10.1.js"></script>
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/easyui/demo.css">

    <script type="text/javascript" src="/mywork/cms/Public/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
    <style>
        *{margin: 0;padding: 0;}
        body{_width:960px; min-width:960px;font-size: 12px;height: 100%;background-color: #000;}
        .clearfix:after { clear:both; content:"."; display:block; line-height:0; font-size:0; visibility:hidden;}
        .bottom{background-color: #4d4d4d;height: 50px;color: #fff;}
        .bottom a{ text-align:center; display:block;line-height : 50px;}
        .top-logo{margin:5px 0 5px 50px;cursor: pointer;}
        .left{background-color:#282D30;width: 150px;height: 90%;position: relative;top: 5%;left:30px;}
        .menu-2{background-color:#000;width: 120px;height: 100%;position: relative;left: 150px;border-right: 1px #242424 solid;color: #fff;text-align: center;}
        .telephone{width:148px;height:42px;color: #fff;position: absolute;bottom: 15%;}
        .telephone img{width:135px;height:42px;margin:0 8px 0 8px;}
        .menu{width: 150px;position: absolute;background-color: #282D30;border: 0;}
        .menu ul{list-style:none;padding: 0 0 10px 0;}
        .menu ul li{border-bottom:1px solid #282D30;padding-bottom: 12px;width: 150px;text-align: center;padding-top: 12px;}
        .menu ul li:first-child{margin-top: 25px;}
        .menu ul li:last-child{border:none}
        .menu ul li a {font-size:16px}
        .menu ul li a:link {color: #fff; text-decoration:none;}
        .menu ul li a:active{color: #fff;}
        .menu ul li a:visited {color:#fff;text-decoration:none;}
        .menu ul li:hover {color: #fff;background-color: #151616;}
        .top-right{position:absolute;right: 10px;}
        .top-right img{margin-right: 20px;cursor: pointer;}
        .top-right img:hover{margin-right: 20px;cursor: pointer;color: #fff;}
    </style>
    
    <style>
        .menu-2-ul{list-style:none;position:relative;top: 120px;font-size: 16px;}
        .menu-2-ul li{padding: 10px 0 10px 0;}
        .menu-2-ul li a:visited {color:#fff;text-decoration:none;}
        .menu-2-ul li a:link{color: #fff; text-decoration:none;}
        .titleinfo{position: absolute;top: 18px;left: 320px;}
        .title-cn{font-size: 18px;color: #b5b5b6;line-height: 28px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu }
        .title-en{font-size: 16px;color: #b5b5b6;font-family: arial, helvetica, sans-serif;}
        hr{position: absolute;top: 70px;left: 320px;width: 835px;border:1px #595757 solid ;}
        .hr2{position: absolute;top: 60px;left: 0px;width: 835px;border:1px #595757 solid ;}
        .hr3{position: absolute;top: 490px;left: 0px;width: 835px;border:1px #595757 solid ;}
        .index{color: #595757;position: absolute;left: 980px;top: 50px;}
        .newstitle{color: #fff;position: absolute;left: 320px;top: 90px;height:530px; width: 835px;}
        .c-title-h1{line-height: 30px;}
        .c-title-h2{color: #595757;}
        .c-title-c{font-size: 14px;height:400px;overflow-y: auto; margin-top: 25px; width: 840px;padding-right: 40px;}
        .pages{margin-top:30px;}
        .p2{position: absolute;right: 0px;}
        .pages a {font-size:12px;}
        .pages a img {margin: 0 10px 0 10px;}
        .pages a:link {color: #fff; text-decoration:none;}
        .pages a:active{color: #fff;}
        .pages a:visited {color:#fff;text-decoration:none;}
        .pages:hover {color: #fff;background-color: #151616;}
    </style>

</head>
<body class="easyui-layout">
<div data-options="region:'north',border:false" style="height:40px;background:#4D4D4D;padding: 0;">
    <img class="top-logo" src="/mywork/cms/Public/img/index/title.png" style="border: 0;" height="26px">
    <span class="top-right">
        <img src="/mywork/cms/Public/img/index/wchat1.png" >
        <img src="/mywork/cms/Public/img/index/wbo1.png" >
        <img src="/mywork/cms/Public/img/index/qq1.png" >
    </span>
</div>

<div data-options="region:'center',border:false" style="background-color: #000;">
    <div class="left">
        <div class="menu">
            <ul>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="li-<?php echo ($vo["id"]); ?>"><a href="/mywork/cms/<?php echo ($vo["link"]); ?>.html" class="link"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="menu-2">
            
<ul class="menu-2-ul">
    <?php if(is_array($menu2list)): $i = 0; $__LIST__ = $menu2list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="menu2-li<?php echo ($vo["id"]); ?>"><a href="/mywork/cms/<?php echo ($vo["link"]); ?>.html"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

        </div>

        <div class="telephone">
            <img src="/mywork/cms/Public/img/index/tll.png">
        </div>

    </div>
    
    <span class="titleinfo"><span class="title-cn"><?php echo ($title_cn); ?></span><br><span class="title-en"><?php echo ($title_en); ?></span></span><span class="index"><img src="/mywork/cms/Public/img/index/news02.png" style="margin: 0;vertical-align:top;"> 首页 > 新闻中心 > <?php echo ($title_cn); ?></span>
    <hr/>
    <div class="newstitle">
        <div class="c-title">
            <span class="c-title-h1"><h3><?php echo ($newsinfo[0][title]); ?></h3></span>
            <span class="c-title-h2">点击：<?php echo ($newsinfo[0][view]); ?>    来源：www.lzrzjt.com    发布时间：<?php echo time_string($newsinfo[0][times]);?></span>
            <hr class="hr2"/>
            <div class="c-title-c">
                <?php echo ($newsinfo[0][content]); ?>
            </div>
        </div>
        <hr class="hr3"/>
        <div class="pages">
            <span class="p1"><img src="/mywork/cms/Public/img/index/pre.png" style="border: 0;vertical-align: middle">上一篇 <?php echo ($after); ?></span>
            <span class="p2">下一篇 <?php echo ($front); ?><img src="/mywork/cms/Public/img/index/next.png" style="border: 0;vertical-align: middle"></span>
        </div>
    </div>

</div>

<div data-options="region:'south',border:false" style="height:50px;background:#4D4D4D;">
    <span class="bottom"><a>蜀ICP备12027884号  Copyright 2016 lzrzjt. ALL Rights Reserved  地址：四川省泸州市酒业集中发展区  电话：400-0830-888  技术支持：大浪科技</a></span>
</div>

<script>
        $('.top').mouseenter(function(){
        });
        var text=document.title
        var timerID
        function newtext() {
            clearTimeout(timerID)
            document.title=text.substring(1,text.length)+text.substring(0,1)
            text=document.title.substring(0,text.length)
            timerID = setTimeout("newtext()", 600)
        }
        if(text.lenth>10){
            newtext();
        }
</script>

    <script type="text/javascript" src="/mywork/cms/Public/js/divscroll.js"></script>
    <script>
        $(function() {
            $('.c-title-c').perfectScrollbar();
        });
        $("#li-<?php echo ($jqid); ?>").css({
            "color":"#fff",
            "background-color":"#151616"
        });
        $("#menu2-li<?php echo ($xxxxx); ?>").css({
            "border-right":"1px #6a7074 solid"
        });
        $("#menu2-li<?php echo ($xxxxx); ?>").find('a').css({
            "color":"#999797"
        });

    </script>

</body>
</html>