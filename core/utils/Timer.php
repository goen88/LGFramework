<?php
/**
 * 
 * php计时器类
 * 
 * @author goen
 * @since 2014-02-28 00:00:01
 * 
 */

class Timer {
  var $StartTime = 0;
  var $StopTime = 0;
  var $TimeSpent = 0;
 
  function start(){
   		$this->StartTime= microtime(true);
  }
  
   function stop(){
  		 $this->StopTime= microtime(true);
  }
 
   function spent()
  {
	    if($this->TimeSpent) {
	       return $this->TimeSpent;
	    } else
	    {
	      $this->TimeSpent = $this->StopTime - $this->StartTime;
	      return  $this->TimeSpent."秒";
	    }
  }
}