<?php
/*
          前台被禁用的ip
          数据类
          by hd
          2011年09月21日
*/
class system_black_ip_web_data
{
	  //var
	  var $link;
	  var $total;
	  var $table;
	  //var $dd;
	  //construct
	  function system_black_ip_web_data($link)
	  {
		    $this->link = $link;
		    $this->total = 0;
		    $this->table = "system_black_ip_web";
		    
	  }
	  
	  function insert_a_row($row_rec)
	  {
		    $dd = new database_data($this->link);
		    $sql_ins = $dd->_get_insert_sql_by_one_row($this->table,$row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $id = $dd->_insert_one_row($this->table,$sql_ins);
		    return $id;
	  }

	  function update_a_row_by_pkid($row_rec,$pkid)
	  {
		    $dd = new database_data($this->link);
		    //$sql_update = $dd->_get_update_sql_by_one_row($this->table,$row_rec,$where_cond);
		    $sql_update = $dd->_get_update_sql_by_one_row($row_rec);
		    //$res_ins = mysqli_query($sql_ins,$this->link);
		    $sql_up = "update ".$this->table." set ".$sql_update." where pkid=".$pkid;
		    //echo "sql_up:".$sql_up."<br/>";
		    $dd->_update_one_row($this->table,$sql_up);
	  }
	  
	  
	  function delete_a_row_by_bipid ($bipid)
	  {
		    $sql_delete = "delete from ".$this->table." where bipid =".$bipid ;
		    $dd = new database_data($this->link);
		    $dd->_delete_one_row($this->table,$sql_delete);
	  }
	  
	  
	  function select_a_row_by_pkid($pkid)
	  {
		    $sql_sel = "select * from ".$this->table." where pkid='".$pkid."'";
		    $dd = new database_data($this->link);
		    $row_sel = $dd->_select_one_row($sql_sel);
		    return $row_sel;
	  }
	  
	  function select_a_row_by_black_ip($black_ip)
	  {
		    $sql_sel = "select * from ".$this->table." where black_ip='".$black_ip."'";
		   
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
	  
	  function select_a_sum_by_cond($cond)
	  {
		    $sql_sel = "select count(*) as sum from ".$this->table." where field='".$cond."'";
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
	  
	  function select_all_row_by_page($whrArray,$begin,$limit,$order='order by bipid asc')
	  {
            
		    $sql_sel = "select * from ".$this->table;
		    
	  		if(!empty($whrArray))
	 		{
	 			$sql_sel .=" where ";
	 			$whereArr = "";
	 			if(isset($whrArray['bipid'])) $whereArr[] = " bipid={$whrArray['bipid']} ";
	 			if(isset($whrArray['black_ip'])) $whereArr[] = " black_ip='{$whrArray['black_ip']}' ";
	 			$sql_sel .= implode(" and ",$whereArr);
	 		}
	 		$sql_sel .= " $order limit $begin,$limit ";
	 		
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
	 			if(isset($whrArray['bipid'])) $whereArr[] = " bipid={$whrArray['bipid']} ";
	 			if(isset($whrArray['black_ip'])) $whereArr[] = " black_ip='{$whrArray['black_ip']}' ";
	 			$sql_sel .= implode(" and ",$whereArr);
	 		}
		    $dd = new database_data($this->link);
		    $sum_sel = $dd->_select_sum_row($sql_sel);
		    return $sum_sel;
	  }
}
?>
