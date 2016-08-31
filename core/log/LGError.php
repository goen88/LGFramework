<?php


class  LGError{
	/**
	 * 错误标识
	 * 
	 * @var array
	 */
	public static $RROR_MESSAGES = array(
	    //API级别10001~19999
	    '10001'=>'服务器正在维护，请稍候重试',
	    '10009'=>'缺少参数',
	    '10010'=>'参数值超出范围',
	    '10011'=>'参数值类型不符',
	    '10020'=>'记录不存在',
	    '10030'=>'超出限制',
	    '10032'=>'不支持的操作',
	    '10034'=>'内部错误',
	    '10035'=>'未知的Controller',
	    '10036'=>'未知的API',
	    '10039'=>'此版本的客户端已经停止使用。请更新至新版本',
	    '10040'=>'模块错误',
	
	    //权限20001~29999
	    '20010'=>'需要登录',
	    '20022'=>'邮箱未验证，禁止登录',
	    '20026'=>'用户名或密码错误，请重新登录',
	    '26001'=>'不支持的认证方式',
	    '26003'=>'请传入有效的Access Token',
	
	    //认证30001~39999
	    '30001'=>'用户名长度不符（1-30个字符）',
	    '30011'=>'密码长度至少为6个字符',
	    '30021'=>'邮箱格式不符合规范',
	
	    //业务级别错误70000~89999
	    '70001'=>'商品库存不足',
	    '70002'=>'商品已下架',
	    '70003'=>'商品暂时不可用',
	    '70004'=>'代金劵不可用',
	    '70005'=>'代金券已失效',
	    '70006'=>'代金券不存在',
	    '70007'=>'减免期间不能使用代金券',
	    '70008'=>'促销活动已结束',
	    '70009'=>'促销活动已开始',
	    '70010'=>'收货地址不在配送范围',
	    '70011'=>'业务在该平台不可使用',
	    '70012'=>'用户红包不存在',
	    '70013'=>'红包不存在',
	    '70014'=>'红包已失效',
	    '70015'=>'红包已被使用',
	
	    //HTTP错误 90000~99999
	    '90405'=>'405 Method not allowed',
	);
	
	/**
	 * 
	 * 系统错误类型
	 * @var array
	 */
	public static $ERROR_TYPES = array (                  
        E_ERROR              => 'Error',                  
        E_WARNING            => 'Warning',                  
        E_PARSE              => 'Parsing Error',                  
        E_NOTICE             => 'Notice',                  
        E_CORE_ERROR         => 'Core Error',                  
        E_CORE_WARNING       => 'Core Warning',                  
        E_COMPILE_ERROR      => 'Compile Error',                  
        E_COMPILE_WARNING    => 'Compile Warning',                  
        E_USER_ERROR         => 'User Error',                  
        E_USER_WARNING       => 'User Warning',                  
        E_USER_NOTICE        => 'User Notice',                  
        E_STRICT             => 'Runtime Notice',                  
        E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'                  
    );      
	
	
}