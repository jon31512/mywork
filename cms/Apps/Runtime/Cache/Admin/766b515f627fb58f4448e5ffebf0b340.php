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

    <title>行业动态</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>新闻管理<span class="c-gray en">&gt;</span> 行业动态 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    

    <div class="cl pd-5 bg-1 bk-gray mt-8">
        <span class="l">
        <a href="javascript:;" onclick="category_add('添加行业动态','/mprotect/cms/admin.php/News/industry_add/type/show',900,650)" class="btn btn-primary radius" id="myModal"><i class="Hui-iconfont">&#xe600;</i> 添加行业动态</a>
    </span>
       </div>
<div style="padding: 10px;">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th>标题</th>
            <th width="80">类型</th>
            <th width="150">时间</th>
            <th width="80">浏览数</th>
            <th width="80">置顶</th>
            <th width="80">状态</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td onclick="layer_show('<?php echo ($vo["title"]); ?>','/mprotect/cms/admin.php/News/news/id/<?php echo ($vo["id"]); ?>',900,650)"><?php echo ($vo["title"]); ?></td>
                <td><?php if($vo[type] == 2): ?>行业动态<?php endif; ?></td>
                <td><?php echo (date('Y-d-m H:i:s',$vo["times"])); ?></td>
                <td><?php echo ($vo["view"]); ?></td>
                <td><?php if($vo[istop] == 1): ?>置顶<?php else: ?>正常<?php endif; ?></td>
                <td><?php if($vo[status] == 1): ?>正常<?php else: ?>关闭<?php endif; ?></td>
                <td class="f-18"><a title="编辑" href="javascript:;" onclick="category_edit('行业动态编辑','/mprotect/cms/admin.php/News/industry_edit/type/show','<?php echo ($vo["id"]); ?>','900','650')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="category_del(this,'<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
    <script>
        $('.table-sort').dataTable({
            "aoColumnDefs": [
                {"orderable":false,"aTargets":[1,4,5,6]}// 制定列不参与排序
            ]
        });
        /*栏目-状态更改*/
        function statusops(id,status){
            var postdata={'id':id,'status':status}
            $.ajax({
                type: 'post',
                url: '/mprotect/cms/admin.php/News/category_edit/type/status',
                data:postdata,
                success: function (data) {
                    if(data===1){
                        window.location.reload();
                    }else{
                        layer.alert(data);
                    }
                }});
        }
        /*栏目-添加*/
        function category_add(title,url,w,h){
            layer_show_noclose(title,url,w,h);
        }
        /*栏目-编辑*/
        function category_edit(title,url,id,w,h){
            layer_show_noclose(title,url+"/id/"+id,w,h);
        }

        /*栏目-单-删除*/
        function category_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    type: 'get',
                    url: '/mprotect/cms/admin.php/News/industry_del/id/'+id,
                    success: function (data) {
                        if(data==="1"){
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                        }else{
                            layer.confirm(data);
                        }
                    }});

            });
        }
    </script>

</body>
</html>