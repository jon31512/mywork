<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-8-18
 * Time: 上午8:51
 */

namespace Admin\Controller;
use Think\Controller;
class DataBaseController extends Controller {

    public function index(){
        header("Content-type: text/html; charset=utf-8");

        $RS=D('DataBase')-> create_database('dalcms');
        if($RS===1){
            echo "Database is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $web_user = "
CREATE TABLE web_user(
id INT(10) NOT NULL AUTO_INCREMENT,
username VARCHAR (50)  COMMENT '账户',
password VARCHAR (50)  COMMENT '密码',
nickname VARCHAR (500)  COMMENT '昵称',
phone VARCHAR (20) COMMENT '电话',
qq INT (18) COMMENT 'QQ',
sex INT (1) COMMENT '性别',
pic VARCHAR (300) COMMENT '头像',
role VARCHAR (50) COMMENT '角色',
rid INT (6) COMMENT '角色id',
ctime INT (6) COMMENT '创建时间',
login INT (6) COMMENT '登录次数',
lasttime INT (6) COMMENT '最后登录时间',
lastip VARCHAR (50) COMMENT '最后登录ip',
islock INT (1) DEFAULT 0 COMMENT '锁定',
PRIMARY  KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统用户表';
            ";
        $RS=D('DataBase')->check_create($web_user);
        if($RS===1){
            echo "web_user is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $web_group = "
CREATE TABLE web_role (
id INT (8) NOT NULL AUTO_INCREMENT,
title VARCHAR(100) NOT NULL DEFAULT '',
status tinyint(1) NOT NULL DEFAULT '1',
rules VARCHAR(80) NOT NULL DEFAULT '0',
pid INT (80) NOT NULL DEFAULT '0' COMMENT '父节点',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色组表';
            ";
        $RS=D('DataBase')->check_create($web_group);
        if($RS===1){
            echo "web_group is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="auth_group_access";
        $sql = "
CREATE TABLE {$table_name} (
uid INT (8) NOT NULL COMMENT '用户id',
group_id INT(8) NOT NULL COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户-角色关联表';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="auth_node";
        $sql = "
CREATE TABLE {$table_name} (
id INT (8)  NOT NULL AUTO_INCREMENT,
name VARCHAR (80) NOT NULL DEFAULT '0' COMMENT '规则唯一标识',
title VARCHAR(20) NOT NULL DEFAULT '0' COMMENT '规则中文名称',
status INT (1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
type VARCHAR(80) NOT NULL DEFAULT '0',
pid INT (2) NOT NULL DEFAULT '0' COMMENT '父节点',
sort INT (2) NOT NULL DEFAULT '0' COMMENT '排序',
conditions VARCHAR(100) COMMENT '规则表达式,为空表示存在就验证，不为空表示按照条件验证',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='功能规则表';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="hometitle";
        $sql = "
CREATE TABLE {$table_name} (
id INT (8)  NOT NULL AUTO_INCREMENT,
name VARCHAR (80) NOT NULL DEFAULT '0' COMMENT '栏目名称',
link VARCHAR(100) NOT NULL DEFAULT '0' COMMENT '栏目连接',
sort INT (4) NOT NULL DEFAULT '0' COMMENT '排序',
status INT (1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
pid INT (8) NOT NULL DEFAULT '0' COMMENT '父节点',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页栏目菜单';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="news";
        $sql = "
CREATE TABLE {$table_name} (
id INT (8)  NOT NULL AUTO_INCREMENT,
title VARCHAR (200) NOT NULL DEFAULT '0' COMMENT '标题',
content VARCHAR(15000) NOT NULL DEFAULT '0' COMMENT '内容',
type INT (1) NOT NULL DEFAULT '0' COMMENT '类型',
view INT (4) NOT NULL DEFAULT '0' COMMENT '浏览数目',
fileid INT (10) NOT NULL DEFAULT '0' COMMENT '图片文件id',
status INT (1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
istop INT (1) NOT NULL DEFAULT '0' COMMENT '状态：为1置顶，为0正常',
times INT (10) NOT NULL DEFAULT '0' COMMENT '时间',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新闻';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="uploadfile";
        $sql = "
CREATE TABLE {$table_name} (
id INT (8)  NOT NULL AUTO_INCREMENT,
name VARCHAR (200) NOT NULL DEFAULT '0' COMMENT '原名称',
savename VARCHAR(200) NOT NULL DEFAULT '0' COMMENT '保存名称',
link VARCHAR(400) NOT NULL DEFAULT '0' COMMENT '文件路径',
savepath VARCHAR(200) NOT NULL DEFAULT '0' COMMENT '保存路径',
fileid INT (10) NOT NULL DEFAULT '0' COMMENT '对应id',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上传文件路径';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }

        $table_name="product";
        $sql = "
CREATE TABLE {$table_name} (
id INT (8)  NOT NULL AUTO_INCREMENT,
name VARCHAR (200) NOT NULL DEFAULT '0' COMMENT '产品名称',
pname VARCHAR (200) NOT NULL DEFAULT '0' COMMENT '产品父标题',
product VARCHAR(1000) NOT NULL DEFAULT '0' COMMENT '产品介绍',
link VARCHAR(400) NOT NULL DEFAULT '0' COMMENT '图片路径',
xx VARCHAR(100) NOT NULL DEFAULT '0' COMMENT '香型',
bz VARCHAR(100) NOT NULL DEFAULT '0' COMMENT '包装',
jjd VARCHAR(100) NOT NULL DEFAULT '0' COMMENT '酒精度',
jhl VARCHAR(100) NOT NULL DEFAULT '0' COMMENT '净含量',
fieldid INT (10) NOT NULL DEFAULT '0' COMMENT '图片文件ID',
status INT (1) NOT NULL DEFAULT '1' COMMENT '状态',
pid INT (3) NOT NULL DEFAULT '0' COMMENT '父类',
sort INT (2) NOT NULL DEFAULT '0' COMMENT '排序',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品信息';
            ";
        $RS=D('DataBase')->check_create($sql);
        if($RS===1){
            echo "{$table_name} is create..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }
/** 添加字段调用方法
        $RS=D('DataBase')-> Alter_table('auth_node','INT (2) NOT NULL DEFAULT "0" COMMENT "排序"');
        if($RS===1){
            echo "Alter_table is SUCCESS..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }
*/

        /*修改字段字段名称调用方法
        $RS=D('DataBase')-> Alter_table_change('auth_rule','conditionm conditions VARCHAR(100)');
        if($RS===1){
            echo "Alter_table is SUCCESS..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }
*/

        /** 修改字段类型或长度
        $RS=D('DataBase')-> Alter_table_modify('auth_rule','conditions varchar(120)');
        if($RS===1){
            echo "Alter_table is SUCCESS..."."<br><br>";
        }else{
            echo $RS."<br><br>";
        }
*/

    }

}