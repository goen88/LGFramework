<?php
/**
 * 首页
 *
 */
class home_action extends api_base_action{
	function home_action() {
		//LG_TEMPLATES_ENGINE_MODE=1有效
		$action_name = str_replace(str_replace('.php','',LG_ACTION_SUBFIX), '', get_class($this));
		$tpl_dir = LG_WEB_ROOT.DIRECTORY_SEPARATOR.LG_ACTION_DIR_NAME.DIRECTORY_SEPARATOR.$action_name;
		//echo $tpl_dir;
		parent::__construct($action_name,$tpl_dir);
	}
	
	
	public function goAction()
    {    
       //数据调用实例
       $userObj = new sg_users_data($this->link);
       $user = $userObj->select_a_row_by_uid(1);
       var_dump($user);
       //rest full api示例
       //LG::rest(10001, array());
    }
    
    
    public function listAction(){
    	$userObj = new sg_users_data($this->link);
    	$users = $userObj->select_muti_num_and_rows(array(),"*",0,10,array('uid'=>'desc'));
//    	echo "<pre>";
//   	var_export($users); 
		$datas['num_items'] = $users['totalCount'];
		$datas['items'] = $users['items'];
		$datas['has_more'] = ($users['totalCount']>10)?true:false;
		LG::rest(0, $datas);
    }
}
?>
