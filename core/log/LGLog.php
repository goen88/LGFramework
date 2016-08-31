<?php
/**
 * 
 * Router Class
 * @author    goen <goen88@163.com>
 * 
 */


class LGLog{
	private static $log_path;
	private static $name;
	public  function __construct($name){
		self::$name = $name;
		self::$log_path = defined("LG_RUNTIME_LOG")?LG_RUNTIME_LOG:'';
		$this->setConfigure();
	}
	
	private  function setConfigure(){
		//echo self::$log_path;exit;
		Logger::configure(array(
			    'rootLogger' => array(
			        'appenders' => array('default'),
			    ),
			    'appenders' => array(
			        'default' => array(
			            'class' => 'LoggerAppenderFile',
			            'layout' => array(
			                'class' => 'LoggerLayoutPattern',
			                'params' => array(
			                    'conversionPattern' => '%date{Y-m-d H:i:s,u} %logger %-5level %msg%n'
			                )
			            ),
			            'params' => array(
			            	'file' => self::$log_path,
			            	'append' => true
			            )
			        )
			    )
		));
	}
	
	public function getLogger(){
		return Logger::getLogger(self::$name);
	}
}