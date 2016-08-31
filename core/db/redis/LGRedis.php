<?php
/**
 * Redis 操作类
 *
 * 需要在全局配置文件中加入 
   相应配置(可扩展为多memcache server)
     define('LG_REDIS_HOST', "127.0.0.1");
	 define('LG_REDIS_PORT', 6379);
    调用方式:
 		LGRedis::getInstance()->lpush('keyName','this is value');
 		LGRedis::getInstance()->lpop('keyName');
	    exit;
 * @access  public
 * @return  object
 * @author gaorunqiao<goen88@163.com>
 * @since 2016-01-13
 */

class LGRedis {
	private static $instance;
	
	private function __construct() {
	}
	public static function getInstance(){
		if(null === self::$instance) {
			self::$instance  = new Redis();
			if(self::$instance->connect(LG_REDIS_HOST, LG_REDIS_PORT)==false){
				throw  new LGDBException('Redis数据库存连接失败', '');
			}
		}
		return self::$instance;
	}
}
?>