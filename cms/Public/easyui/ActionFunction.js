/**
 * Created by Administrator on 2016/7/7.
 */


//添加数据方法函数    url打开页面地址与提交地址   dialogid打开窗口ID   tableid 刷新的页标签id   #fm为提交数据Form表单Id
function AddAction(title,url,dialogid,tableid,width,height){
    if(!width){width=500;}
    if(!height){height=500;}
    if(!title){title='添加角色';}
    $('#'+dialogid).dialog({
        title: title,
        width: width,
        height: height,
        closed: false,
        cache: false,
        href:url,
        modal: true,
        buttons:[{
            text:'保存',
            iconCls:'icon-ok',
            handler:function(){
                var validate = $("#fm").form('validate');
                if (validate == false) {
                    return false;
                }
                var postData = $("#fm").serializeArray();
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: postData,
                    success: function (data) {
                        //$.messager.alert("提示", data);
                        if(data==1){
                             $.messager.alert("提示", "操作成功");
                        }
                        if(data==0){
                             $.messager.alert("提示", "操作失败");
                        }
                    }});
                $('#'+dialogid).dialog('close');
                $('#'+tableid).datagrid('reload')
            }},{
            text:'取消',
            iconCls:'icon-no',
            handler:function(){
                $('#'+dialogid).dialog('close');
            }
        }]
    });
    $('#'+dialogid).dialog('refresh', url);

}

//删除方法
function DeleteAction(url,tableid) {
    //得到用户选择的数据的ID
    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length >= 1) {
        //遍历出用户选择的数据的信息，这就是用户用户选择删除的用户ID的信息
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        //最后去掉最后的那一个,
        ids = ids.substring(0, ids.length - 1);
        var postData = {id: ids };//传入id字段

        //然后确认发送异步请求的信息到后台删除数据
        $.messager.confirm("删除确认", "您确认删除选定的记录吗？", function (action) {
            if (action) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'html',
                    data: postData,
                    success: function (data) {
                        //$.messager.alert("提示", data);return false;
                        if (data=="1") {
                            $.messager.alert("提示", "删除选定的记录成功");
                            $("#"+tableid).datagrid("reload");
                            //当删除完成之后，第二次删除的时候还记得上次的信息，这样是不可以的，所以我们需要清除第一次的信息
                            rows.length = "";//第一种方法
                            $("#"+tableid).datagrid("clearSelections");//第二种方法
                        }
                        else {
                            $.messager.alert("提示", "操作失败"+data);
                        }
                    },
                    error: function(e) {
                        alert(e);
                    }
                });
            }
        });
    }
    else {
        $.messager.alert("提示", "请选择你要删除的数据");
    }
}

//实现编辑数据的方法
function EditAction(url,dialogid,tableid,title) {

    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length >= 1) {
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);

        $('#'+dialogid).dialog({
            title: title,
            width: 400,
            height: 200,
            closed: false,
            cache: false,
            href: url+'?id='+ids,
            modal: true,
            buttons:[{
                text:'保存',
                iconCls:'icon-ok',
                handler:function(){
                    var validate = $("#fm").form('validate');
                    if (validate == false) {
                        return false;
                    }
                    var postData = $("#fm").serializeArray();
                    $.ajax({
                        type: "POST",
                        url: url,
                        async: false,
                        data: postData,
                        success: function (data) {

                            if(data==1){
                                $.messager.alert("提示", "操作成功");
                            }
                            if(data==0){
                                $.messager.alert("提示", "操作失败");
                            }
                        }});
                    $('#'+dialogid).dialog('close');
                    $('#'+tableid).datagrid('reload')
                }},{
                text:'取消',
                iconCls:'icon-no',
                handler:function(){
                    $('#'+dialogid).dialog('close');
                }
            }]
        });

    }else {
        $.messager.alert("提示", "请选择你要操作的数据");
    }

}
function EditActiontwo(title,url,dialogid,tableid,width,height) {
    if(!title){title='编辑角色';}
    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length >= 1) {
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);
        $('#'+dialogid).dialog({
            title:title,
            width: width,
            height: height,
            closed: false,
            cache: false,
            href: url+"?id="+ids,
            modal: true
        });
}}

function EditActionthree(url,dialogid,tableid,title,width,height) {
    if(!width){width=500;}
    if(!height){height=500;}
    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length >= 1) {
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);
        $('#'+dialogid).dialog({
            title: title,
            width: width,
            height: height,
            closed: false,
            cache: false,
            href: url+'?id='+ids,
            modal: true,
            buttons:[{
                text:'保存',
                iconCls:'icon-ok',
                handler:function(){
                    var validate = $("#fm").form('validate');
                    if (validate == false) {
                        return false;
                    }
                    var postData = $("#fm").serializeArray();
                    $.ajax({
                        type: "POST",
                        url: url,
                        async: false,
                        data: postData,
                        success: function (data) {
                            $.messager.alert("提示", data);
                            //if(data==1){
                            //    alert("修改成功");
                            //}
                            //if(data==0){
                            //    alert("修改失败");
                            //}
                        }});
                    $('#'+dialogid).dialog('close');
                    $('#'+tableid).datagrid('reload')
                }},{
                text:'取消',
                iconCls:'icon-no',
                handler:function(){
                    $('#'+dialogid).dialog('close');
                }
            }]
        });

    }else {
        $.messager.alert("提示", "请选择你要修改的数据");
    }

}

function DeleteActiontwo(url) {

    $.ajax( {
        // 注意这里有个参数callback=?
        url: url,
        async: false, // 同步请求，发送请求后浏览器将被锁定，只有等到该请求完成(无论成功或失败)后，用户才能操作，js代码才会继续执行
        dataType: "html", // 返回JSON格式的数据
        success: function( data ){
            if (data == "1") {
                $.messager.alert("提示", "删除选定的记录成功");
            }
            else {
                $.messager.alert("提示", "操作失败");
            }
        }
    });
}
function addTab_ifreams(title, url,tt){
    if ($('#'+tt).tabs('exists', title)){
            $('#'+tt).tabs('select', title);
        } else {

            var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
            $('#'+tt).tabs('add',{
                title:title,
                content:content,
                closable:true
            });
        }
}
function addTab(title, url,tt,target){

    if ($('#'+tt).tabs('exists', title)){
        $('#'+tt).tabs('select', title);
    } else {
        if(target=="self"){
            $('#'+tt).tabs('add',{
                title:title,
                href:url,
                closable:true
            });
        }else{
            if ($('#'+tt).tabs('exists', title)){
                $('#'+tt).tabs('select', title);
            } else {
                var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
                $('#'+tt).tabs('add',{
                    title:title,
                    content:content,
                    closable:true
                });
            }
        }
    }

}

function addTab_edit(title, url,tt,target,tableid){
    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length >= 1) {
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);

        if ($('#' + tt).tabs('exists', title)) {
            $('#' + tt).tabs('select', title);
        } else {

            if (target == "self") {
                $('#' + tt).tabs('add', {
                    title: title,
                    href: url,
                    closable: true
                });
            } else {
                if ($('#' + tt).tabs('exists', title)) {
                    $('#' + tt).tabs('select', title);
                } else {
                    var content = '<iframe scrolling="auto" frameborder="0"  src="' + url + '?id='+ids+'" style="width:100%;height:100%;"></iframe>';
                    $('#' + tt).tabs('add', {
                        title: title,
                        content: content,
                        closable: true
                    });
                }
            }
        }
    }else {
        $.messager.alert('提示','请选择要修改的数据');
    }

}
//打开弹出显示详细信息
function opendiag(dialogid,title,url,width,height){
    $('#'+dialogid).dialog({
        title: title,
        width: width,
        height: height,
        closed: false,
        closable:true,
        cache: false,
        href: url,
        modal: true
    });
}
function opendiagnox(dialogid,title,url,width,height){
    $('#'+dialogid).dialog({
        title: title,
        width: width,
        height: height,
        resizable: true,
        closable:false,
        cache: false,
        maximizable:true,
        href: url,
        modal: true
    });
}
function opendiagedit(dialogid,tableid,title,url,width,height){
    var rows = $("#"+tableid).datagrid("getSelections");
    if (rows.length == 1) {
        var ids = "";   //1,2,3,4,5
        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);
    $('#'+dialogid).dialog({
        title: title,
        width: width,
        height: height,
        resizable: true,
        closable:false,
        cache: false,
        maximizable:true,
        href: url+"/id/"+ids,
        modal: true
    });
    }else{
        $.messager.alert("提示","请先选择数据");
    }
}
//树形表格操作函数  添加 修改
function treegridhandle(title,url,dialog,grid,width,height){

    $('#'+dialog).dialog({
        title: title,
        width: width,
        height: height,
        closed: false,
        cache: false,
        href:url,
        modal: true,
        buttons:[{
            text:'保存',
            iconCls:'icon-ok',
            handler:function(){
                var validate = $("#fm").form('validate');
                if (validate == false) {
                    return false;
                }
                var postData = $("#fm").serializeArray();
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: postData,
                    success: function (data) {
                        if(data==1){
                            $.messager.alert('提示', "操作成功");
                        }
                        if(data==0){
                            $.messager.alert('提示', "操作失败");
                        }
                    }});
                $( $('#'+dialog)).dialog('close');
                $('#'+grid).treegrid('reload')
            }},{
            text:'取消',
            iconCls:'icon-no',
            handler:function(){
                $('#'+dialog).dialog('close');
            }
        }]
    });
    $('#'+dialog).dialog('refresh', url);
}
//树形表格操作函数  删除
function treegridhandledelete(url,grid){

    var rows = $("#"+grid).treegrid("getSelections");
    if (rows.length >= 1) {
        var ids = "";   //1,2,3,4,5

        for (var i = 0; i < rows.length; i++) {
            ids += rows[i].id + ",";//传入id字段
        }
        ids = ids.substring(0, ids.length - 1);

    $.ajax({
        type: "get",
        url: url+'/id/'+ids,
        success: function (data) {
            if(data==1){
                $.messager.alert('提示', "操作成功");
            }
            if(data==0){
                $.messager.alert('提示', "操作失败");
            }
        }});
    $("#"+grid).treegrid('reload');
}else{
        {$.messager.alert('提示','请单击要操作的数据');}
    }
}