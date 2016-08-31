<?php
/**
 * PHP SDK for Douban OpenAPI
 *
 * @version 1.0
 * @author goen88@163.com
 * @copyright © 2013, by Goen
 */



 //申请到的appid
 //$_SESSION["appid"]    = yourappid;
 $_SESSION["Douban_appid"]    = '';

 //申请到的appkey
 //$_SESSION["appkey"]   = "yourappkey";
 $_SESSION["Douban_appkey"]   = "";

//登录成功后跳转的地址,请确保地址真实可用，否则会导致登录失败。
//$_SESSION["callback"] = "http://your domain/oauth/get_access_token.php";
$_SESSION["Douban_callback"] = "";

//QQ授权api接口.按需调用
$_SESSION["Douban_scope"] = "douban_basic_common,shuo_basic_r,shuo_basic_w,community_advanced_doumail_r";

?>
