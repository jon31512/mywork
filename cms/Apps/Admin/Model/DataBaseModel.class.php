<?php
namespace Admin\Model;
use Think\Model;
class DataBaseModel extends Model {

    public function index(){
    }
//        检测表，没有则创建
    public function check_create($sql) {
        $link = mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
        mysql_select_db(C('DB_NAME'));
        if (mysql_query($sql)) {
            mysql_close($link);
            return 1;
        } else {
            $rs=mysql_error();
            mysql_close($link);
            return "Error creating table:".$rs;
        }
    }
//    说明：创建数据库
    public function create_database($databasename){
        $link = mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
        mysql_select_db(C('DB_NAME'));
        $sql="CREATE DATABASE {$databasename} DEFAULT CHARSET utf8 COLLATE utf8_general_ci";
        if (mysql_query($sql)) {
            mysql_close($link);
            return 1;
        } else {
            $rs=mysql_error();
            mysql_close($link);
            return "Error creating database:".$rs;
        }
    }
//    说明：增加一个列
    public function Alter_table($tablename,$cole_type){
        $link = mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
        mysql_select_db(C('DB_NAME'));
        $sql="alter table {$tablename} add column {$cole_type};";
        if (mysql_query($sql)) {
            mysql_close($link);
            return 1;
        } else {
            $rs=mysql_error();
            mysql_close($link);
            return "Error alter table:".$rs;
        }
    }

    //    说明：修改表中字段名称  alter table 表名 change 现有字段名称  修改后字段名称 数据类型
    public function Alter_table_change($tablename,$cole_type){
        $link = mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
        mysql_select_db(C('DB_NAME'));
        $sql="alter table {$tablename} change {$cole_type};";
        if (mysql_query($sql)) {
            mysql_close($link);
            return 1;
        } else {
            $rs=mysql_error();
            mysql_close($link);
            return "Error alter table:".$rs;
        }
    }

    //    说明：修改字段类型或长度  aalter table 表名 modify column 字段名 类型;
    public function Alter_table_modify ($tablename,$cole_type){
        $link = mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
        mysql_select_db(C('DB_NAME'));
        $sql="alter table {$tablename} modify column {$cole_type};";
        if (mysql_query($sql)) {
            mysql_close($link);
            return 1;
        } else {
            $rs=mysql_error();
            mysql_close($link);
            return "Error alter table:".$rs;
        }
    }
}