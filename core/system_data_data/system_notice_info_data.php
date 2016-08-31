<?php
/*
          网站公告数据表的对应类
          数据类
          by hd
          2011年09月27日
*/
class system_notice_info_data
{
	  //var
	  var $link;
	  var $total;
	  var $table;
	  //var $dd;
	  //construct
	  function system_notice_info_data($link)
	  {
		    $this->link = $link;
		    $this->total = 0;
		    $this->table = "system_notice_info";
		    
	  }
	  
	  function insert_a_row($row_rec)
	  {
		    $dd = new database_data($this->link);
		    $sql_ins = $dd->_get_insert_sql_by_one_row($this->table,$row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $id = $dd->_insert_one_row($this->table,$sql_ins);
		    return $id;
	  }

	  function update_a_row_by_nid($row_rec,$nid)
	  {
		    $dd = new database_data($this->link);
		    //$sql_update = $dd->_get_update_sql_by_one_row($this->table,$row_rec,$where_cond);
		    $sql_update = $dd->_get_update_sql_by_one_row($row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $sql_up = "update ".$this->table." set ".$sql_update." where nid=".$nid;
		    //echo "sql_up:".$sql_up."<br/>";
		    $dd->_update_one_row($this->table,$sql_up);
	  }
	  
	  
	  function delete_a_row_by_pkid($pkid)
	  {
		    $sql_delete = "delete from ".$this->table." where pkid=".$pkid;
		    $dd = new database_data($this->link);
		    $dd->_delete_one_row($this->table,$sql_delete);
	  }
	  
	  function delete_a_row_by_main_id($main_id,$grade=1)
	  {
		    $sql_delete = "delete from ".$this->table." where grade=$grade and main_id=".$main_id;
		    $dd = new database_data($this->link);
		    $dd->_delete_one_row($this->table,$sql_delete);
	  }
	  
	  
	  function select_a_row_by_nid($nid)
	  {
		    $sql_sel = "select * from ".$this->table." where nid='".$nid."'";
		    $dd = new database_data($this->link);
		    $row_sel = $dd->_select_one_row($sql_sel);
		    return $row_sel;
	  }
	  
	  //检测用户是否阅读过消息
	  function is_readed_notice($nid,$uid){
	  		$sql_sel = "select * from ".$this->table."  where  FIND_IN_SET( $uid, readed_users) and nid='$nid'";
		    $dd = new database_data($this->link);
		    $row_sel = $dd->_select_one_row($sql_sel);
		    return $row_sel;
	  }
	  
	  function select_more_row_by_page($cond,$begin,$limit)
	  {
		    $sql_sel = "select * from ".$this->table." where field='".$cond."' order by id desc limit ".$begin.",".$limit;
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		    return $arr_sel;
	  }
	  
	  
	  function select_all_row_by_cond($cond)
	  {
		    $sql_sel = "select * from ".$this->table." where field=".$cond." order by pid desc";
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		     return $arr_sel;
	  }
	  
	  function select_all_row_by_page($begin,$limit,$order="order by nid desc")
	  {
		    $sql_sel = "select * from ".$this->table." $order  limit ".$begin.",".$limit;
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		    return $arr_sel;
	  }
	  
	  //取得用户系统通知
	  function select_user_row_by_page($uid,$begin,$limit,$order="order by nid desc")
	  {
		    $sql_sel = "select * from ".$this->table." where (uid='$uid' && grade=1) or grade=0  $order  limit ".$begin.",".$limit;
		    $dd = new database_data($this->link);
		    $arr_sel = $dd->_select_multi_row($sql_sel);
		    return $arr_sel;
	  }
	  
	  function select_a_sum_by_cond($cond)
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table." where field='".$cond."'";
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
	  //取得用户系统通知总数
 	  function select_user_sum($uid)
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table." where (uid='$uid' && grade=1) or grade=0 ";
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
	  
	  function select_a_sum()
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table."";
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
}
?>
