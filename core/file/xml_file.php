<?php 
/*
 *  根据传入的图片id,得到xml内容
 *      by hd
 *      2011.03.03
*/

class xml_file
{
      var $link;
      
      function xml_file()
      {

      }
      
      function get_one_row_xml_str($row)
      {
           $str_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
           $str_xml .= "<News>";
           
           foreach ($row as $key => $value)
           {
			     $str_xml .= "<".$key.">".$value."</".$key.">";
		   }
           //end 
           $str_xml .= "</News>";
           
           return $str_xml;
      }

      function make_one_xml_file($file_xml,$str_xml)
      {
      	   $fsu = new file_system_utils();
      	   $fsu->check_a_file_path_dir($file_xml);
      	   
		    file_put_contents($file_xml,$str_xml);
		    return $file_xml;
      }
}


?>
