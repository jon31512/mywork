<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($info[0]["title"]); ?></title>
    <style>
        body {padding:0; margin:0; border:0; font-size:14px; background:#F6FDFF; font-family: "宋体";}
        .mainBox {width:850px; height:auto; margin:20px auto; background:#F3FDFF; border:1px solid #E2E7EA; border-radius:20px;box-shadow: 0 0 1px 1px rgba(0,0,0,0.1); padding-bottom: 30px;}
        .newsTop {margin: 15px 0 0; text-align: center;}
        .newsTop h1 {font-size: 20px; overflow: visible; color: #333; line-height: 30px; font-weight: normal;}
        .newsTop .tip {line-height: 20px; color: #999; font-size: 12px;}
        .newsTop .tip .ndate {margin-right:10px;}
        .nCont p {line-height:1.5em; margin: 15px 35px 0 35px; word-wrap: break-word; word-break: break-all; color: #666;font-family:宋体, simsun; text-indent:2em;}
    </style>
</head>
<body>
<!-- 内容开始 -->
<div class="mainBox">
    <div class="newsTop">
        <h1><strong><?php echo ($info[0]["title"]); ?></strong></h1>
        <p class="tip">
            <span class="ndate"><?php echo time_string($info[0][times]);?></span>
            <span class="nDepart"><span class="green">浏览量:<?php echo ($info[0]["view"]); ?></span></span>
        </p>
    </div>
    <div class="nCont">
        <?php echo ($info[0][content]); ?>
    </div>
    <!-- 内容结束 -->
</div>
</body>
</html>