<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="/mprotect/cms/Public/js/jquery-1.10.1.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/html5.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/respond.min.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/lib/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/mprotect/cms/Public/Hui/static/h-ui.admin/css/style.css" />
    <!--[if lt IE 9]>
    <link href="/mprotect/cms/Public/Hui/static/h-ui/css/H-ui.ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 6]>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/layer/2.1/layer.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/static/h-ui/js/H-ui.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/mprotect/cms/Public/Hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>

    
    <!--编辑器组件-->
    <script type="text/javascript"  src="/mprotect/cms/Public/kindeditor/kindeditor-all.js"></script>
    <script type="text/javascript"  src="/mprotect/cms/Public/kindeditor/lang/zh_CN.js"></script>
    <title>添加内容</title>
    <script>
        var nowtimes;
        nowtimes=Date.parse(new Date())/1000;
        KindEditor.ready(function(K) {
            var editor = K.create('textarea[name="content"]', {
                resizeType : 2,  // 2时可以拖动改变宽度和高度，1时只能改变高度，0时不能拖动。
                allowFileManager : true,  //显示浏览远程服务器按钮
                pasteType :1,//0禁止粘贴   1文本模式  2:HTML粘贴
                uploadJson:'/mprotect/cms/admin.php/About/indexadd/type/upload/SSID/<?php echo session_id();?>/fileid/'+nowtimes,
                afterBlur: function(){this.sync();},
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=content]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=content]')[0].submit();
                    });
                },
                afterChange : function() {
                    $('.word_count1').html(this.count()); //字数统计包含HTML代码
                    $('.word_count2').html(this.count('text'));  //字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字
                    //////////
                    //限制字数
                    var limitNum = 15000;  //设定限制字数
                    var pattern = '还可以输入' + limitNum + '字';
                    $('.word_surplus').html(pattern); //输入显示
                    if(this.count() > limitNum) {
                        pattern = ('字数超过限制，请适当删除部分内容');
                        //超过字数限制自动截取
                        var strValue = editor.text();
                        strValue = strValue.substring(0,limitNum);
                        editor.text(strValue);
                    } else {
                        //计算剩余字数
                        var result = limitNum - this.count();
                        pattern = '还可以输入' +  result + '字';
                    }
                    $('.word_surplus').html(pattern); //输入显示
                }
            });
            prettyPrint();
        });
    </script>

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 内容管理 <span class="c-gray en">&gt;</span>关于我们<span class="c-gray en">&gt;</span> 添加内容 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    
    <div class="page-container">
        <form method="post" class="form form-horizontal" id="form-category-add" autocomplete="off">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr align="center">
                <td width="50px">标题</td>
                <td>
                    <div class="formControls">
                        <input type="text" class="input-text radius " value="" placeholder="标题" autocomplete="off" name="title" id="title">
                    </div>
                </td>
                <tr>
                <tr align="center">
                    <td>内容</td>
                    <td>
                        <div class="formControls">
                            <textarea id="editor" name="content" style="width:100%;height:500px;"></textarea>
                        </div>
                    </td>
                <tr>
                <tr>
                    <td>字符统计</td>
                    <td>您当前输入了 <span class="word_count1">0</span>字.<span class="word_surplus"></span>
                    </td>
                </tr>
                    <td colspan="2" align="center" valign="center">
                        <input name="fileid" id="fileid" type="hidden">
                        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                        <input id="reset" type="reset" class="btn btn-primary radius" value="&nbsp;&nbsp;重置&nbsp;&nbsp;">
                        <input id="close" class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        $("#form-category-add").validate({
            rules:{
                title:{
                    required:true
                },
                content:{
                    required:true
                }
            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
            submitHandler:function(form){
                $('#fileid').val(nowtimes);
                var postData = $(form).serializeArray();
                $.ajax({
                    type:"post",
                    url:"/mprotect/cms/admin.php/About/indexadd/type/save",
                    data: postData,//表单数据
                    success:function(d){
                        if(d===1){
                            parent.layer.msg('保存成功!<script>setTimeout("window.location.reload();",500);<\/script>', {icon: 6,time:1000});
                            parent.$('.btn-refresh').click();
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        }else{
                            layer.msg(d);
                        }
                    }
                });
            }
        });
        var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
        $('#close').on('click', function(){
            $.ajax({
                type:"get",
                url:"/mprotect/cms/admin.php/About/indexadd/type/fdelete/fileid/"+nowtimes,
                success:function(d){
                    parent.layer.close(index); //执行关闭
                }
            });
        });
    </script>


</body>
</html>