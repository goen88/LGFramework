<?php
//session_start ();
header ( "content-type:text/html; charset=utf-8" );

if(!file_exists('../conf/config_const_var.php')){
	exit('配置文件['.dirname(dirname(__FILE__)).'/conf/config_const_var.php]不存在！<br>请拷贝当前目录下的config_const_var.php~sample为config_const_var.php');
}
require_once('../conf/config_const_var.php');

LG::createAppliaction()->run();

