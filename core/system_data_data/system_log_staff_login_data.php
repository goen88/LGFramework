<?php
/*
lid 	int(11) 			否 		auto_increment 	Browse distinct values 	更改 	删除 	主键 	唯一 	索引 	全文搜索
	uid 	int(11) 			否 	0 		Browse distinct values 	更改 	删除 	主键 	唯一 	索引 	全文搜索
	login_time 	timestamp 			否 	0000-00-00 00:00:00 		Browse distinct values 	更改 	删除 	主键 	唯一 	索引 	全文搜索
	login_ip 	varchar(100) 	utf8_general_ci 		否
          by hd
          10.01.28
*/
class system_log_staff_login_data
{
	  //var
	  var $link;
	  var $total;
	  var $table;
	  //construct
	  function system_log_staff_login_data($link)
	  {
		    $this->link = $link;
		    $this->total = 0;
		    $this->table = "system_log_staff_login";
	  }
	  
	  function add_one_login($uid,$ip)
	  {
		    //$uid =  $_SESSION['newa_user']['uid'];
		    $sql_ins = "insert into ".$this->table." ".
		               "(`uid`,`login_time`,".
		               "`login_ip`) ".
		               "values".
		               "('".addslashes($uid)."',now(),".
		               "'".$ip."')";
		    $res_ins = mysqli_query($sql_ins,$this->link);
		    $vid = mysqli_insert_id($this->link);
		    return $vid;  
	  }
	  	  
	  function get_all_login_info($begin,$limit)
	  {
		   $sql_v = "select * from ".$this->table." order by lid desc limit ".$begin.",".$limit;
		   $res_v = mysqli_query($sql_v,$this->link);
		   $num_v = mysqli_num_rows($res_v);
		   if ($num_v == 0)
		   {
			     return -1;
		   }
		   else
		   {
			     $arr_v = array();
			     while ($row_v = mysqli_fetch_assoc($res_v))
			     {
					   $arr_v[] = $row_v;
				 }
			     return $arr_v;
		   }
	  }
	  
 	  function select_all_row_by_page($whrArray,$begin,$limit,$order='order by lid desc')
	  {
		    $sql_sel = "select * from ".$this->table;
		    
		    if(!empty($whrArray))
	 		{
	 			$sql_sel .=" where ";
	 			$whereArr = "";
	 			if(isset($whrArray['uid'])) $whereArr[] = " uid={$whrArray['uid']} ";
	 			if(isset($whrArray['login_ip'])) $whereArr[] = " login_ip='{$whrArray['login_ip']}' ";
	 			$sql_sel .= implode(" and ",$whereArr);
	 		}
	 		$sql_sel .= " $order limit $begin,$limit ";
		   
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		    return $arr_sel;
	  }
	  
 	  function select_all_group_by_ip()
	  {
		    $sql_sel = "select * from ".$this->table." group by login_ip";
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		     return $arr_sel;
	  }

	  
	  function select_a_sum($whrArray)
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table."";
	 		if(!empty($whrArray))
	 		{
	 			$sql_sel .=" where ";
	 			$whereArr = "";
	 			if(isset($whrArray['uid'])) $whereArr[] = " uid={$whrArray['uid']} ";
	 			if(isset($whrArray['login_ip'])) $whereArr[] = " login_ip='{$whrArray['login_ip']}' ";
	 			$sql_sel .= implode(" and ",$whereArr);
	 		}
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
	  
}
?>
