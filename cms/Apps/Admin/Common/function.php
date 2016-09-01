<?php

function node_merge($node,$pid=0){

	$arr=array();
	foreach($node as $v){

		if($v['pid']==$pid){
			$v['child']=node_merge($node,$v['id']);
			$arr[]=$v;
		}
	}
	return $arr;
}

//验证操作权限函数
function checkauth($thisoporit,$uid){
    import('ORG.Util.Auth');
    $auth=new Auth();
    if($auth->getAuth($thisoporit,$uid)) {
        return 1;
    }else{
        return 0;
    }
}
?>