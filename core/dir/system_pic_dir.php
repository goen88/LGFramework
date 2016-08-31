<?php
/*
    action与模板的对应关系
    * 
    * by hd
    2010.01.28
*/

class system_pic_dir
{
	
	   function system_pic_dir()
	   {
	   	
	   }
	   
       //得到相应的目录
       function get_sub_path($photoid)
       {
            $arr = str_split(strrev($photoid), 3);
            $path = sizeof($arr);
            $shift = array_shift($arr);
            $str = implode("/",$arr);
            if ($photoid<1000)
               $path = '1';
            else
            $path = $path."/".strrev($str);
            return $path;
       }
       function set_sub_path($curdir)
       {
	        if (!is_dir($curdir))
            {
    	        @system("mkdir -p ".$curdir);
    	        @chmod($curdir,0777);
            } 
       }

       //----------------------------------------------------------------------img
       function get_full_img($basepath,$pid,$pathtype,$ifcreate,$diskbase,$webbase,$ifnomark=0)
       {
	        //$basepath = get_base_img($pid);
           
       		if ($ifcreate == 1) //是否根据ID自动分割文件夹
            {
            	   $subpath = $this->get_sub_path($pid);
           		   $full_path = $basepath."/".$subpath;
		           $this->set_sub_path($diskbase."/".$full_path);
	        }else{
	        	$full_path = $basepath;
	        }
            
            if($ifnomark==0){            	$full_file = $full_path."/".$pid.".jpg";            }else{            	$full_file = $full_path."/".$pid."_.jpg";            }
            
            //根据返回类型作返回
            if($pathtype=="sys") 
            {
    	           return $diskbase."/".$full_file;
            }
            else 
            {
    	           return $webbase."/".$full_file;
            }
       }
	   
}


?>
