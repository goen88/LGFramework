<?php
/**
 * 
 * controller base class
 * 
 * @author goen
 *
 */

class base_action{
	public $link;  //数据库句柄
	public $smarty;//smarty模板引擎句柄
	
	private $smarty_tpl_dir;//smarty模板引擎目录
	private $son_action_name; //子类类名去除后缀的,home_action->home
	
	public function __construct($son_action_name='',$tpl_dir=null){
		$this->smarty_tpl_dir = $tpl_dir;
		$this->_init();
	}
	
	private function _init(){
		$this->_getMysqlLink();
		$this->_getSmarty();
		
		$this->authenticationCheck($this->son_action_name);
	}
	
	private function _getMysqlLink(){
		if(LG_DB_MYSQL==true){
			$dbIns = database_link::getInstance();
			$this->link = $dbIns->get_link();
		}else{
			$this->link = null;	
		}
	}
	
	
	private function _getSmarty(){
		if(LG_TEMPLATES_ENGINE==true){
			$this->smarty = new Smarty;
			if(defined("LG_TEMPLATES_DIR_C")){
				$this->smarty->compile_dir  = LG_TEMPLATES_DIR_C;
			}
			//模板共享模式
			if(LG_TEMPLATES_ENGINE_MODE==0){
				$this->smarty->template_dir  = LG_TEMPLATES_DIR;
			}else if(LG_TEMPLATES_ENGINE_MODE==1){
				if($this->smarty_tpl_dir==null){
					throw new LGException('');
				}else{
					$this->smarty->template_dir  = $this->smarty_tpl_dir;
				}
			}
		}else{
			$this->smarty = null;
		}
		//$smarty->template_dir = '../templates/';
		//$smarty->compile_dir  = '../templates_c/';
	}
	
	/**
	 * 
	 * 控制器权限认证
	 * @param string $action 控制器名称
	 * @copyright 2015 by gaorunqiao.ltd
	 * @since File available since Version 1.0 2015-12-31
	 * @author goen<goen88@163.com>
	 * @return null
	 */
	protected  function authenticationCheck($action,$acces=array('admin','user','guest')){
		if($action!=''&&LG_AUTHENTICATION==true){
			$auth = new LGAuthentication();
			$row_struct = $auth->get_stuct_info($action);
			if($auth->get_stuct_info($this->controller)){
				LG::authentication($row_struct,$acces);
			}
		}
	}
	
	
}