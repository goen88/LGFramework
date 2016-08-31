<?php
/**
 * 数据访访问基础类
 * 
 * @author goen
 *
 */

class database_link
{
	 private static $instance;
	 private $link;
	 private $master_link;
	 private function __construct()
	 {
	 	  $this->master_link = $this->_get_master_link();
		  $this->link = new MysqliDb($this->master_link);
     }
     
     public static  function getInstance(){
     	if(!self::$instance instanceof  self){
     		self::$instance = new self();
     	}
     	return self::$instance;
     }
     
     private function _get_master_link()
     {
     	try{
	     	  $host = LG_MYSQL_HOST;
	     	  $username = LG_MYSQL_USER;
	     	  $password = LG_MYSQL_PASS;
	     	  $databaseName = LG_MYSQL_DBNAME;
	          $mysqli = new mysqli($host, $username, $password, $databaseName);
		      if (mysqli_connect_errno()) {
		      	  throw new LGDBException("Connect failed: ".mysqli_connect_error());
		      }
	          $mysqli->set_charset('utf8');
	          return $mysqli;
     	}catch (LGDBException $e){
     			$e->displayException(); 
     	}
	 }
	 
	 public function get_link(){
	 	return $this->link;
	 }
} 
?>
