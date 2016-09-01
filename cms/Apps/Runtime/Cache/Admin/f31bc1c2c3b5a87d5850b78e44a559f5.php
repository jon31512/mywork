<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="/mywork/cms/Public/js/jquery-1.10.1.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/html5.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/respond.min.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/lib/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/mywork/cms/Public/Hui/static/h-ui.admin/css/style.css" />
    <!--[if lt IE 9]>
    <link href="/mywork/cms/Public/Hui/static/h-ui/css/H-ui.ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 6]>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/layer/2.1/layer.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/static/h-ui/js/H-ui.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/mywork/cms/Public/Hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>

    <title>栏目设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>管理员管理<span class="c-gray en">&gt;</span> 角色设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    

    <div class="cl pd-5 bg-1 bk-gray mt-8">
        <span class="l">
        <a href="javascript:;" class="btn btn-danger radius" onclick="data_del()"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
        <a href="javascript:;" onclick="role_add('添加角色','/mywork/cms/admin.php/Admin/role_add/type/show',800,300)" class="btn btn-primary radius" id="myModal"><i class="Hui-iconfont">&#xe604;</i> 添加角色</a>
    </span>
       </div>
<div style="padding: 10px;">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="80">ID</th>
            <th>名称</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" name="checkbox" value="<?php echo ($vo["id"]); ?>"></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td class="f-14"><a title="编辑" href="javascript:;" onclick="role_edit('角色编辑','/mywork/cms/admin.php/Admin/role_edit/type/show','<?php echo ($vo["id"]); ?>','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="role_del(this,'<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
    <script>
        $('.table-sort').dataTable({
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,3]}// 制定列不参与排序
            ]
        });
        /*栏目-添加*/
        function role_add(title,url,w,h){
            layer_show(title,url,w,h);
        }
        /*栏目-编辑*/
        function role_edit(title,url,id,w,h){
            layer_show(title,url+"/id/"+id,w,h);
        }
        function datadel(){
            layer.alert("删除按钮",{icon: 3, title:'提示'});
        }
        /*栏目-多-删除*/
        function data_del(){
            var text = $("input:checkbox[name='checkbox']:checked").map(function(index,elem) {
                return $(elem).val();
            }).get().join(',');
            var postdata={"listid":text};
            layer.confirm('确认要删除这些吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    type: 'post',
                    url: '/mywork/cms/admin.php/Admin/role_del',
                    data:postdata,
                    success: function (data) {
                        if(data==="1"){
                            window.location.reload();
                        }else{
                            layer.confirm(data);
                        }
                    }});

            });
        }
        /*栏目-单-删除*/
        function role_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    type: 'get',
                    url: '/mywork/cms/admin.php/Admin/role_del/id/'+id,
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