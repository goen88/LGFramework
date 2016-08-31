<?php
/*
    class videoinfo
	用来得到视频文件的属性

	备注：是文件自身的属性，不包含相关的说明信息
	     by hd
		 2008-03-20
*/

class txt_file
{

      //构造函数，初始化文件路径
	  function txt_file()
	  {
		     //$this->link=$link;
	  }

      function make_a_txt_file($txt_path,$outstr)
      {
      	   $fsu = new file_system_utils();
      	   $fsu->check_a_file_path_dir($txt_path);
      	
            $_fp = fopen($txt_path,"w+");
            fwrite($_fp,$outstr);
            fclose($_fp);
		    //返回
		    return $txt_path;
	  }


	function down_a_txt_file($pathfile,$down_name)
	{
	   $file_path = $pathfile;
	   //判断要下载的文件是否存在
	   if(!is_file($file_path))
	   {
		   //echo "对不起,你要下载的文件不存在。";
		   return 0;
	   }
	
	   $file_size=filesize($file_path);
	   
		header( "Pragma: public" );
		header( "Expires: 0" ); // set expiration time
		header( "Cache-Component: must-revalidate, post-check=0, pre-check=0" );
		header( "Content-type:application/download");
		header( "Content-Length: $file_size"  );
		header( "Content-Disposition: attachment; filename=\"text_".$down_name."\"");
		header( 'Content-Transfer-Encoding: binary' );
		readfile( $file_path );

	   return 1;
	}
}     //end   class videoinfo

?>
