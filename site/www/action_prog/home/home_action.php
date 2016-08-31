<?php
/**
 * 首页
 *
 */
class home_action extends web_base_action{
	function home_action() {
		//LG_TEMPLATES_ENGINE_MODE=1有效
		$action_name = str_replace(str_replace('.php','',LG_ACTION_SUBFIX), '', get_class($this));
		$tpl_dir = LG_WEB_ROOT.DIRECTORY_SEPARATOR.LG_ACTION_DIR_NAME.DIRECTORY_SEPARATOR.$action_name;
		//echo $tpl_dir;
		parent::__construct($action_name,$tpl_dir);
		
		//this->link; //数据库句柄
		//$this->smarty; 模板(smarty)句柄
	}
	
	
	public function goAction()
    {    
       //数据调用实例
       //$userObj = new sg_users_data($this->link);
       //$user = $userObj->select_a_row_by_uid(1);
       
       //echo LG::reqeust()->getInt('dd');
//       if(LG::reqeust()->isGet()){
//       		echo "is get request";
//       }
       
       $this->smarty->assign('name','name');
       $this->smarty->display('home.htm');

       
       
       //rest full api示例
       //LG::rest(10001, array());
   
       
    }
    
    public function listAction(){
    	exit("list action");
    }

}
?>
