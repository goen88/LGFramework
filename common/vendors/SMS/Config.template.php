<?php
/**
 * 
 * 云通讯 短信平台配置文件
 * 
 * @author gaorq<goen88@163.com>
 * @since 2014-11-13
 */

global $SMS_Config;

//是否是测试环境
$SMS_Config['isSandbox'] = true;

//主帐号,对应开官网发者主账号下的 ACCOUNT SID
$SMS_Config['accountSid'] = '';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
$SMS_Config['accountToken'] = '';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
$SMS_Config['appId'] = '';

//请求地址
//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//生产环境（用户应用上线使用）：app.cloopen.com
$SMS_Config['serverIP'] = $SMS_Config['isSandbox']?'sandboxapp.cloopen.com':'app.cloopen.com';

//请求端口，生产环境和沙盒环境一致
$SMS_Config['serverPort'] = '8883';

//REST版本号，在官网文档REST介绍中获得。
$SMS_Config['softVersion'] = '2013-12-26';

//验证码失效时间
//单位：分钟
$SMS_Config['expireTime'] = '2'; 

//短信验证码默认模板
$SMS_Config['templateId'] = '1';//'1'; 
