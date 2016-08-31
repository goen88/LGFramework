<?php

class LGBase{
	private static $_db;
	private static  $_logger;
	private static $_smarty;
	private static $_app;
	
	public static $LG_start_time=0;
	public static $params=array(); //系统自定义参数
	public static $redis;
	public static $memcache;
	
	public static  function createAppliaction(){
		self::$LG_start_time = microtime();
		
		/**
		 * init user self paramas
		 */
		if(file_exists(LG_ROOT."/common/conf/params.php")){
			self::$params = require_once(LG_ROOT."/common/conf/params.php");
		}
		
		/**
		 * init redis and memcache Cache DB,if is needed
		 */
		self::getRedis();
		self::getMemcache();
		
		/**
		 * start application now
		 */
		self::$_app =  new LGRouter();
		return self::$_app;
	}
	
	
	public static function log($name='Application'){
		self::$_logger = new LGLog($name);
		self::$_logger = self::$_logger->getLogger();
		return self::$_logger;
	}

	/**
	 * 获取请求数据
	 * 
	 * @since File available since Version 1.0 2016-1-4
	 * @author goen<goen88@163.com>
	 * @return object
	 */
	public static function reqeust(){
		return  new Context;
	}

	
	/**
	 * 
	 * API返回数据结果集接口
	 * @param  $status 状态
	 * @param  $datas 数据
	 * @param  $account_id 账户
	 * @since File available since Version 1.0 2015-12-29
	 * @author goen<goen88@163.com>
	 * @return json
	 */
	public static function rest($status,$datas,$account_id=0){
		$cost = (microtime()-self::$LG_start_time);
		$ret = array();
		$ret['meta'] = array(
			'status'=>$status,
			'server_time'=>date("Y-m-d H:i:s"),
			'account_id'=>$account_id,
			'cost'=> $cost,
			'errdata'=> null,
			'errmsg'=> ""
		);
		$ret['version'] = 1;
		if($status==0){
			$ret['data']['has_more'] =  isset($datas['has_more'])?$datas['has_more']:false;
			$ret['data']['num_items'] =   isset($datas['num_items'])?$datas['num_items']:0;
			$ret['data']['items'] = isset($datas['items'])?$datas['items']:array();
		}else{
			$ret['meta']['errmsg'] =  isset(LGError::$RROR_MESSAGES[$status])?LGError::$RROR_MESSAGES[$status]:'';
			$ret['meta']['errdata'] = isset($datas['errdata'])?$datas['errdata']:null;
			$ret['data']['alert_msg'] = isset($datas['alert_msg'])?$datas['alert_msg']:LGError::$RROR_MESSAGES[$status];
		}
		exit( json_encode($ret) );
	}
	
	
	/**
	 * 
	 * 输出异常信息
	 * 
	 * @param Exception $e
	 * @copyright 2015 by gaorunqiao.ltd
	 * @since File available since Version 1.0 2015-12-30
	 * @author goen<goen88@163.com>
	 * @return null
	 */
	public static function displayException($e){
		if($e instanceof LGDBException){
			$e->displayException();
		}else if($e instanceof  LGException){
			$e->displayException();
		}else{
			$msg = get_class($this).': '.$e->getMessage().' ('.$e->getFile().':'.$e->getLine().")\n";
			$msg .= $e->getTraceAsString()."\n";
			LG::log()->error($msg);
		}
	}
	
	
	/**
	 * 权限认证
	 * 
	 * @copyright 2015 by gaorunqiao.ltd
	 * @since File available since Version 1.0 2015-12-31
	 * @author goen<goen88@163.com>
	 * @return the bare_field_name
	 */
	public static function authentication(){
		exit('权限认证...');
	}
	
	
	/**
	 * 
	 * 框架退出
	 * 
	 * @copyright 2015 by gaorunqiao.ltd
	 * @author goen<goen88@163.com>
	 * @return none
	 */
	public static function end(){
		exit(1);
	}
	
	/**
	 * 获取redis数据库句柄
	 * 
	 * @since File available since Version 1.0 2016-1-13
	 * @author goen<goen88@163.com>
	 * @return null
	 */
	public static function getRedis(){
		if(LG_DB_REDIS==true){
			self::$redis = LGRedis::getInstance();
		}
	}
	
	/**
	 * 获取Memcace数据库句柄
	 * 
	 * @since File available since Version 1.0 2016-1-13
	 * @author goen<goen88@163.com>
	 * @return null
	 */
	public static function getMemcache(){
		if(LG_DB_MEMCACHE==true){
			self::$memcache = LGMemcache::getInstance();
		}
	}
}
