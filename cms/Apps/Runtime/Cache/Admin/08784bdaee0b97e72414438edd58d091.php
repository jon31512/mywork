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

    <title>栏目设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页设置 <span class="c-gray en">&gt;</span>栏目设置<span class="c-gray en">&gt;</span> 编辑栏目 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    

    <div class="page-container">
        <form method="post" class="form form-horizontal" id="form-category-eidt">
            <input type="hidden" name="id"  value="<?php echo ($list[0]["id"]); ?>">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr align="center">
                    <td width="80px" height="40px">栏目名称</td>
                    <td>
                        <div class="formControls">
                        <input type="text" class="input-text radius " value="<?php echo ($list[0]["name"]); ?>" placeholder="栏目名称" autocomplete="off" name="name" id="name">
                        </div>
                    </td>
                    <td width="80px">栏目链接</td>
                    <td>
                        <div class="formControls">
                        <input type="text" class="input-text radius"  value="<?php echo ($list[0]["link"]); ?>" placeholder="栏目链接"  name="link"  id="link">
                        </div>
                    </td>
                </tr>
                <tr align="center">
                    <td height="40px">栏目级别</td>
                    <td>
                        <span class="select-box radius">
                          <select class="select" size="1" name="pid">
                              <option value="0" <?php if($list[0][pid] == 0): ?>selected<?php endif; ?>>顶级栏目</option>
                              <?php if(is_array($pidlist)): $i = 0; $__LIST__ = $pidlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($list[0][pid] == $vo[id]): ?>selected<?php endif; ?>>|- &nbsp;<?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                        </span>
                    </td>
                    <td>栏目排序</td>
                    <td> <span class="select-box radius">
                          <select class="select" size="1" name="sort">
                              <option value="1" <?php if($list[0][sort] == 1): ?>selected<?php endif; ?>>1</option>
                              <?php $__FOR_START_4234__=2;$__FOR_END_4234__=11;for($i=$__FOR_START_4234__;$i < $__FOR_END_4234__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php if($list[0][sort] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?></option><?php } ?>
                          </select>
                        </span></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" height="80px" valign="center"><input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;修改&nbsp;&nbsp;"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>

        $("#form-category-eidt").validate({
            rules:{
                name:{
                    required:true,
                    minlength:2,
                    maxlength:16
                },
                link:{
                    required:true
                }
            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
            submitHandler:function(form){
                var postData = $(form).serializeArray();
                $.ajax({
                    type:"post",
                    url:"/mprotect/cms/admin.php/Home/category_edit/type/save",
                    data: postData,//表单数据
                    success:function(d){
                        if(d==='1'){
                            parent.layer.msg('保存成功!<script>setTimeout("window.location.reload();",500);<\/script>', {icon: 6,time:500});
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
    </script>


</body>
</html>