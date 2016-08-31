<?php
/**
 * 
 * Router Class
 * 
 * @author    goen <goen88@163.com>
 * 
 */

class LGRouter{
	private $default_c = '';
	private $default_a = '';
	private $default_a_subfix = '';
	private $controller = '';
	private $function = '';
	private $path = '';
	private $subfix = '';
	
	public function LGRouter(){
		$this->default_c = LG_ACTION_NAME;
		$this->default_a = LG_ACTION_FUNC;
		$this->path = LG_WEB_ROOT.DIRECTORY_SEPARATOR.LG_ACTION_DIR_NAME.DIRECTORY_SEPARATOR;
		$this->subfix = LG_ACTION_SUBFIX;
		$this->default_a_subfix = LG_ACTION_FUNC_SUBFIX;
	}
	
	public function run(){
		if(LG_ENABLE_EXCEPTION_HANDLER){
			set_exception_handler(array($this,'handleException'));
		}	
		if(LG_ENABLE_ERROR_HANDLER){
			set_error_handler(array($this,'handleError'),error_reporting());
		}
		
		register_shutdown_function(array($this,'end'),0,false);
		try{
			$this->parsePath();			//解析URL
			$this->getActionFile();		//加载控制器文件
			$this->getActionClass();	//实例化控制器类
			LG::end();
		}catch (LGException $e){
			LG::displayException($e);
		}catch (LGDBException $e){
			LG::displayException($e);
		}catch (Exception $e){
			LG::displayException($e);
		}finally{
			LG::rest(10034, array());
		}
	} 
	
	/**
	 * 解析URL路径
	 * 获得控制器、控制器中函数、参数
	 */
	private function parsePath(){
		if(isset($_GET['uri'])){
			//index.php?uri=/home/index/1/2/3
			$_SERVER['REQUEST_URI'] = preg_replace('/(.*).php/','',$_GET['uri']);
		}else{
			//index.php/home/index/1/2/3
			$_SERVER['REQUEST_URI'] = preg_replace('/(.*).php/','',$_SERVER['REQUEST_URI']);
		}
		
		if(isset($_SERVER['REQUEST_URI'])){
			$tmb = $_SERVER['REQUEST_URI'];
			if(stripos($tmb,'?')){
				$tmb = substr($tmb, 0,stripos($tmb,'?'));
			}
			$url_param = explode('/',$tmb);
			$this->controller 	= (isset($url_param[1]) && $url_param[1]!=''&& strpos($url_param[1], '?')===false)?$url_param[1]:$this->default_c;
			$this->function		= (isset($url_param[2]) && $url_param[2]!='')?$url_param[2]:$this->default_a;
		}else{
			$this->controller 	= $this->default_c;
			$this->function		= $this->default_a;
		}
		$this->controller = strtolower($this->controller);
		$this->function = strtolower($this->function);
		
	}

	
	
	private function  getActionFile(){
		$filename	=	$this->controller;
		$filename	=	$filename.$this->subfix;
		if(LG_ACTION_MODE==1){
			$file = $this->path.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$filename; //站点控制器文件
		}else{
			$file = $this->path.$filename; //站点控制器文件
		}
		//if($this->controller=='favicon.ico') return ;
		if(!file_exists($file)) {
			$this->throwException("错误:找不到文件({$file})");
			// exit("错误:找不到文件({$file})<br>");
		}else{
			require_once($file);
		}
	}
	
	
	private function  getActionClass(){
		//if($this->controller=='favicon.ico') return ;
		$actionClass = $this->controller."_action";
		
		if(!class_exists($actionClass)) {
			$this->throwException("错误:类不存在( class ".$actionClass." )");
			//exit("错误:类不存在( class ".$actionClass." )");
		}else{
			$class = new $actionClass();
			if(!method_exists($class,$this->function.$this->default_a_subfix)){
				$this->throwException("错误:控制器中缺少函数 > {$this->function}");
				//exit("错误:控制器中缺少函数》> {$this->function}");
			}
			$fun = $this->function.$this->default_a_subfix;
			$class->$fun();
		}	
	}
	
	

	    /**
	     * 
	     * 抛出一个错误
	     * @param  $message 内容
	     * @copyright 2015 by gaorunqiao.ltd
	     * @since File available since Version 1.0 2015-12-28
	     * @author goen<goen88@163.com>
	     * @return the bare_field_name
	     */
		function throwException($message){
//			if($this->config['is_bug']===false){
//				return;
//			}
			throw new LGException($message);
		}
		
		
		public function handleError($code,$message,$file,$line)
		{
			if($code & error_reporting())
			{
				// disable error capturing to avoid recursive errors
				restore_error_handler();
				restore_exception_handler();
				$log="$message ($file:$line)\nStack trace:\n";
				$trace=debug_backtrace();
				// skip the first 3 stacks as they do not tell the error position
				if(count($trace)>3)
					$trace=array_slice($trace,3);
				foreach($trace as $i=>$t)
				{
					if(!isset($t['file']))
						$t['file']='unknown';
					if(!isset($t['line']))
						$t['line']=0;
					if(!isset($t['function']))
						$t['function']='unknown';
					$log.="#$i {$t['file']}({$t['line']}): ";
					if(isset($t['object']) && is_object($t['object']))
						$log.=get_class($t['object']).'->';
					$log.="{$t['function']}()\n";
				}
				if(isset($_SERVER['REQUEST_URI']))
					$log.='REQUEST_URI='.$_SERVER['REQUEST_URI'];
				//Yii::log($log,CLogger::LEVEL_ERROR,'php');
				LG::log('HandleError')->error($log);
			}
		}
		
		
		
		public function handleException($exception)
		{
			// disable error capturing to avoid recursive errors
			restore_error_handler();
			restore_exception_handler();
			$message=$exception->__toString();
			if(isset($_SERVER['REQUEST_URI']))
				$message.="\nREQUEST_URI=".$_SERVER['REQUEST_URI'];
			if(isset($_SERVER['HTTP_REFERER']))
				$message.="\nHTTP_REFERER=".$_SERVER['HTTP_REFERER'];
			$message.="\n---";
			LG::log('HandleEeception')->error($message);
		}
		
		public function end($status=0,$exit=true)
		{
			exit($status);
		}
}
