<?php
/*
          系统设置页内数量等数字的数据表对应类
          数据类
          by hd
          2011年09月26日
*/
class system_settings_digit_data
{
	  //var
	  var $link;
	  var $total;
	  var $table;
	  //var $dd;
	  //construct
	  function system_settings_digit_data($link)
	  {
		    $this->link = $link;
		    $this->total = 0;
		    $this->table = "system_settings_digit";
		    
	  }
	  
	  function insert_a_row($row_rec)
	  {
		    $dd = new database_data($this->link);
		    $sql_ins = $dd->_get_insert_sql_by_one_row($this->table,$row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $id = $dd->_insert_one_row($this->table,$sql_ins);
		    return $id;
	  }

	  function update_a_row_by_info_id($row_rec,$info_id)
	  {
		    $dd = new database_data($this->link);
		    //$sql_update = $dd->_get_update_sql_by_one_row($this->table,$row_rec,$where_cond);
		    $sql_update = $dd->_get_update_sql_by_one_row($row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $sql_up = "update ".$this->table." set ".$sql_update." where info_id=".$info_id;
		    //echo "sql_up:".$sql_up."<br/>";
		    $dd->_update_one_row($this->table,$sql_up);
	  }
	  
	  
	  function delete_a_row_by_pkid($pkid)
	  {
		    $sql_delete = "delete from ".$this->table." where pkid=".$pkid;
		    $dd = new database_data($this->link);
		    $dd->_delete_one_row($this->table,$sql_delete);
	  }
	  
	  
	  function select_a_row_by_info_id($info_id)
	  {
		    $sql_sel = "select * from ".$this->table." where info_id='".$info_id."'";
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
	  
	  function select_all_row_by_page($begin,$limit)
	  {
		    $sql_sel = "select * from ".$this->table." order by info_id desc limit ".$begin.",".$limit;
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
	  
	  function select_a_sum()
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table."";
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
}
?>
