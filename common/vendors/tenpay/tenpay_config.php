<?php
$spname="财付通支付";
$trade_mode= 1;										//交易模式（1.即时到帐模式，2.中介担保模式，3.后台选择（卖家进入支付中心列表选择））
$seller_id = "";							//卖家的商户号
$partner = "";                            //财付通商户号
$key = "";			//财付通密钥

$return_url = MBLOG_DOMAIN_NAME."/".MBLOG_SCRIPT_NAME."/pay/tenpaynotify/";			//显示支付结果页面,*替换成payReturnUrl.php所在路径
$notify_url = MBLOG_DOMAIN_NAME."/".MBLOG_SCRIPT_NAME."/pay/tenpaynotify/";;		//支付完成后的回调处理页面,*替换成payNotifyUrl.php所在路径
?>
