<?php
/*
 *     微博的session系统
 *         by hd
 *         2010.01.28
*/

class staff_session 
{
        function staff_session ($link) 
        {
        	
			  // echo "1111111111111111111111";
			   //$uc = new staff_cookie($link);
			   $_SESSION['adm_user']['ifu'] = "-1";
			  
			   if (!isset($_POST['username']) || !isset($_POST['password']))
			   {
				     //return ;
				     //echo "begin to check:";
				     //$uc->if_cookie_right();
				     
			   }
			   else
			   {
			   	 
			   $username = trim($_POST['username']);
			   $password = $_POST['password'];
			    
               $ui = new v_staff_info_data($link);
               $row_u = $ui->get_one_user_by_username($username);
               //print_r($row_u);
               //exit;
			
               if (!is_array($row_u))
               {
				           $_SESSION['adm_user']['ifu']  = "0";
			   }
			   else
			   {
				     //核对密码
				     $curpass = get_pass($password);
				     //$curpass = $password;
				     //echo $curpass."___".$row_u['upass']."___".$row_u['ifmod'];
				     //exit;
				     if (($curpass != $row_u['password']) || ($row_u['ifmod'] != '1'))
				     {
						  //$if_v_u = 0;
						  $_SESSION['adm_user']['ifu']  = "0";
					 }
					 else
					 {
					 	 
						  if (!isset($row_u['r']))
						  {
							    $row_u['r']="";
						  }
						  //$_SESSION['adm_user']['u_id']  = $row_u['u_id'];
						  $_SESSION['adm_user']['uid'] = $row_u['uid'];
						  $_SESSION['adm_user']['username'] = $row_u['username'];
						  $_SESSION['adm_user']['nickname']  = $row_u['truename'];
						  $_SESSION['adm_user']['password']  = $row_u['password'];
						  $_SESSION['adm_user']['role']  = $row_u['userrole'];
						  $_SESSION['adm_user']['ifu']  = "1";
						  
						  //-----------------------------------------保存ip和brow
						  
						  //$md5brow = $uc->get_md5_brow();
						  
						  //更新
						  //$ui->set_md5_brow_by_uid($md5brow,$row_u['uid']);
						  
						  //-----------------------------------------保存cookie
						  //$uc->set_cookie($row_u['uid'],$row_u['nickname'],md5($row_u['password']));
						  //-----------------------------------------记录登录情况
						  
						  
						  //print_r($_COOKIE);
						  
						  //echo "set session end<br/>";
						  //exit;
						  
						  $uid = $row_u['uid'];
						  $ip = $_SERVER['REMOTE_ADDR'];
						  $lld = new system_log_staff_login_data($link);
						  $lld->add_one_login($uid,$ip);
						
						  /*
						  $arr_p = array("u"=>$row_u['u'],
                          "d"=>date("Y-m-d H:i:s"),
                          "i"=>$_SERVER['REMOTE_ADDR']
                          );
                          $l_i = new user_login_info($link);
						  $l_i->rec_log($arr_p);
						  */
						  //session_register("adm_user");
						  //$if_v_u = 1;
						  
					 }
			   }
		   }
			   //$this->if_v_u = $if_v_u;
               return ;
        }
}

?>
