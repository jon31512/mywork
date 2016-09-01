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
    <link rel="stylesheet" href="/mprotect/cms/Public/kindeditor/themes/default/default.css" />
    <title>添加产品</title>
    <script>
        var nowtimes;
        nowtimes=Date.parse(new Date())/1000;
        KindEditor.ready(function(K) {
            var editor = K.create('textarea[name="content"]', {
                resizeType : 1,  // 2时可以拖动改变宽度和高度，1时只能改变高度，0时不能拖动。
                allowFileManager : true,  //显示浏览远程服务器按钮
                pasteType :1,//0禁止粘贴   1文本模式  2:HTML粘贴
                width:'100%',
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist'],
                uploadJson:'/mprotect/cms/admin.php/Product/indexadd/type/upload/SSID/<?php echo session_id();?>/fileid/'+nowtimes,
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
                var uploadbutton = K.uploadbutton({
                    button : K('#uploadbtn')[0],
                    fieldName : 'imgFile',
                    url : '/mprotect/cms/admin.php/Product/indexadd/type/upload/fileid/'+nowtimes,
                    afterUpload : function(data) {
                        if (data.error === 0) {
                            var url = K.formatUrl(data.url, 'absolute');
                            $('#img_url_0').val(url);
                            $('#imgshow').attr("src",'');
                            $('#imgshow').css("display","inline");
                            $('#imgshow').attr("src",url);
                            $('#delete_files').css("display","inline");
                            $('.btnupload').css("display","none");
                        } else {
                            alert(data.message);
                        }
                    },
                    afterError : function(str) {
                        alert('自己定义错误信息: ' + str);
                    }
                });
                uploadbutton.fileBox.change(function(e) {
                    uploadbutton.submit();
                });
        });
    </script>

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 内容管理 <span class="c-gray en">&gt;</span>产品管理<span class="c-gray en">&gt;</span> 添加产品 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    
    <div class="page-container">
        <form method="post" class="form form-horizontal" id="form-category-add" autocomplete="off">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr align="center">
                <td width="50px">名称</td>
                <td>
                    <div class="formControls">
                        <input type="text" class="input-text radius " value="" placeholder="名称" autocomplete="off" name="name" id="name">
                    </div>
                </td>
                <td width="50px">副标题</td>
                <td>
                    <div class="formControls">
                        <input type="text" class="input-text radius " value="" placeholder="副标题" autocomplete="off" name="pname" id="pname">
                    </div>
                </td>
                </tr>
                <tr align="center">
                    <td width="50px">香型</td>
                    <td>
                        <div class="formControls">
                            <input type="text" class="input-text radius " value="" placeholder="香型" autocomplete="off" name="xx" id="xx">
                        </div>
                    </td>
                    <td width="50px">包装</td>
                    <td>
                        <div class="formControls">
                            <input type="text" class="input-text radius " value="" placeholder="包装" autocomplete="off" name="bz" id="bz">
                        </div>
                    </td>
                </tr>
                <tr align="center">
                    <td width="50px">酒精度</td>
                    <td>
                        <div class="formControls">
                            <input type="text" class="input-text radius " value="" placeholder="酒精度" autocomplete="off" name="jjd" id="jjd">
                        </div>
                    </td>
                    <td width="50px">净含量</td>
                    <td>
                        <div class="formControls">
                            <input type="text" class="input-text radius " value="" placeholder="净含量" autocomplete="off" name="jhl" id="jhl">
                        </div>
                    </td>
                </tr>
                <tr align="center">
                    <td>介绍</td>
                    <td width="400px">
                        <div class="formControls">
                            <textarea id="content" name="content" style="height: 400px"></textarea>
                        </div>
                    </td>
                    <td colspan="2" valign="bottom">
                        <div style="width: 100%"><img id="imgshow" style="width: 100%;height:100%;"></div>
                        <span class="btnupload" >
                          <input type="button" multiple name="file_0" id="uploadbtn" value="上传图片">
                        </span>
                        <input type="hidden" name="beautyTown.img_0" id="img_url_0" value="" readonly="readonly"/>
                        <span id="delete_files" style="color: red;display: none;cursor: pointer;font-size: 18px;"><i title="删除" class="Hui-iconfont Hui-iconfont-del"></i></span>
                    </td>
                </tr>
                <tr>
                    <td>字符统计</td>
                    <td colspan="3">您当前输入了 <span class="word_count1">0</span>字.<span class="word_surplus"></span>
                    </td>
                </tr>
                <tr align="center">
                    <td>排序</td>
                    <td width="400px">
                        <div class="formControls">
                            <span class="select-box radius">
                          <select class="select" size="1" name="sort">
                              <option value="1" selected>1</option>
                              <?php $__FOR_START_8151__=2;$__FOR_END_8151__=11;for($i=$__FOR_START_8151__;$i < $__FOR_END_8151__;$i+=1){ ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
                          </select>
                        </span>
                        </div>
                    </td>
                    <td>所属类别</td>
                    <td>
                        <div class="formControls">
                            <span class="select-box radius">
                          <select class="select" size="1" name="pid" id="pid">
                              <option value="">请选择</option>
                              <?php if(is_array($Product)): $i = 0; $__LIST__ = $Product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo[id]); ?>"><?php echo ($vo[name]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center" valign="center">
                        <input name="fileid" id="fileid" type="hidden">
                        <input class="btn btn-primary radius" id="btnsubmit" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                        <input id="reset" type="reset" class="btn btn-primary radius" value="&nbsp;&nbsp;重置&nbsp;&nbsp;">
                        <input id="close" class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        $("#btnsubmit").click(function(){
                if($('#name').val()===''){
                    layer.msg('名称不能为空');
                    return false;}
            if($('#pname').val()===''){
                layer.msg('副标题不能为空');
                return false;}
            if($('#content').val()===''){
                layer.msg('介绍不能为空');
                return false;}
            if($('#pid').val()===''){
                layer.msg('所属类别不能为空');
                return false;}
                $('#fileid').val(nowtimes);
                var postData = $('#form-category-add').serializeArray();
                $.ajax({
                    type:"post",
                    url:"/mprotect/cms/admin.php/Product/indexadd/type/save",
                    data: postData,//表单数据
                    success:function(d){
                        layer.alert(d);
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
        });
        var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
        $('#close').on('click', function(){
            $.ajax({
                type:"get",
                url:"/mprotect/cms/admin.php/Product/indexadd/type/fdelete/fileid/"+nowtimes,
                success:function(d){
                    parent.layer.close(index); //执行关闭
                }
            });
        });
        $("#delete_files").click(function(){
            $.ajax({
                type: 'GET',
                url : '/mprotect/cms/admin.php/Product/indexadd/type/delete/fileid/'+nowtimes,
                async: true,
                success: function (data) {
                    if(data==1){
                        layer.msg("文件已删除");
                        $('#delete_files').css("display","none");
                        $('.btnupload').css("display","inline");
                        $('#imgshow').css("display","none");
                    }else{
                        layer.alert(data);
                    }

                }
            });
            return false;
        });
    </script>


</body>
</html>