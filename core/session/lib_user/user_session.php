<?php
/*
 *     微博的session系统
 *         by hd
 *         2010.01.28
*/

class user_session 
{
        function user_session ($link) 
        {
			  // echo "1111111111111111111111";
			   $uc = new user_cookie($link);
			   $_SESSION['newa_user']['ifu'] = "-1";
			   if (!isset($_POST['username']) || !isset($_POST['password']))
			   {
				     //return ;
				     //echo "begin to check:";
				     $uc->if_cookie_right();
			   }
			   else
			   {
			   		$username = trim($_POST['username']);
			   		$password = $_POST['password'];
			   		
			   		//如果密码为空
			   		if(!isset($_POST['isQKLogin'])&&empty($password)){                                                                                                           
                        return 0;
                    }
			   		
               		$ui = new v_user_info_data($link);
               		$row_u = -1;
               		if(is_phone_num($username)){ //是否是手机号码
               			$row_u = $ui->get_one_user_by_mobile($username);
               		} 
               		
               		if(substr_count($username,'@')>0){ //邮箱登录
					 	$row_u = $ui->get_one_user_by_email($username);
					}
					
					if($row_u==-1){
						$row_u = $ui->get_one_user_by_username($username);
					}
					
               		//print_r($row_u);
               		if (!is_array($row_u))
               		{
				           $_SESSION['newa_user']['ifu']  = "0";
			   		}
			   		else
			   		{
					     //核对密码
					     if(isset($_POST['isQKLogin'])&&$_POST['isQKLogin']==1){ //如果是快速登录
					     	$curpass = $password;
					     }else{
					     	$curpass = get_pass($password);
					     }
					    
					     //if (($curpass != $row_u['password']) || ($row_u['is_validated'] != '1')) //需要激活版本，必须验证邮箱
					     if (($curpass != $row_u['password'])) //不需要激活版本
					     {
							  //$if_v_u = 0;
							  $_SESSION['newa_user']['ifu']  = "0";
						 }
					 	else
						 {
							  if (!isset($row_u['r']))
							  {
								    $row_u['r']="";
							  }
							  $_SESSION['newa_user']['uid'] = $row_u['uid'];
							  $_SESSION['newa_user']['username'] = $row_u['username'];
							  $_SESSION['newa_user']['nickname'] = $row_u['nickname'];
							  $_SESSION['newa_user']['email']  = $row_u['email'];
							  //$_SESSION['newa_user']['password']  = $row_u['password'];
							  $_SESSION ['newa_user'] ['role'] = 'kh';
							  $_SESSION['newa_user']['usertype']  = $row_u['u_type'];
							  if($row_u['u_type']==1){ //如果是品牌店铺用户
							  	$claimInfoObj = new sg_claim_info_data($link);
							  	$claimInfo = $claimInfoObj->select_a_row_by_uid($row_u['uid']);
							  	$_SESSION['newa_user']['claimbrandid']  = $claimInfo['brand_id'];
							  }
							  
							  $_SESSION['newa_user']['ifu']  = "1";
							  //-----------------------------------------保存ip和brow
							  
							  $md5brow = $uc->get_md5_brow();
							  //更新
							  $ui->set_md5_brow_by_uid($md5brow,$row_u['uid']);
							  
							  //-----------------------------------------保存cookie
							  if(isset($_POST['remember'])){ //是否需要保存Cookie,保存7天
							  	 $uc->set_cookie($row_u['uid'],$row_u['username'],md5($row_u['password']));
							  }
							  
							  //记录活动信息
							  if(isset($_POST['active_name'])&&!empty($_POST['active_name'])){
							  	$this->addActiveInfo( $row_u['uid'], trim($_POST['active_name']) );
							  }
							  
							  //echo "set session end<br/>";
							  //exit;
							  
							  $uid = $row_u['uid'];
							  $ip = $_SERVER['REMOTE_ADDR'];
							  $lld = new system_log_user_login_data($link);
							  $lld->add_one_login($uid,$ip); 
						 }
			   		}
		    	}
				//$this->if_v_u = $if_v_u;
            	return ;
        }
}

?>
