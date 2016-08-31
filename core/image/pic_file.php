<?php
/*
   切图
   * 
   * 2010.03.29
*/

class pic_file
{
     var $file;
     var $width=0;
     var $height=0;
     var $size;
     var $origid;
     var $origfile;
     var $origtype;
     
     function pic_file()
     {
		  //$this->file = $file;
	 }

     function get_width_height_size($file)
     {
         $imgsize = GetImageSize($file);
         $this->width = $imgsize[0];
         $this->height = $imgsize[1];
         if (($this->width=='') || ($this->width=='0'))
         {
                 $cmdiden="/usr/bin/identify '".$file."'";
                 $retiden=shell_exec($cmdiden." 2>&1");
                 $idenarr=explode(" ",$retiden);
                 $arrsize=explode("x",$idenarr['2']);
                 $this->width = $arrsize[0];
                 $this->height = $arrsize[1]; 
         }
         
		 $size=filesize($file);
		 $this->size=$size;
	 }

     function get_file_name_info($file)
     {
			//原始文件名
			$this->origfile=basename($file);

			//下面得到文件的原始类型 
			$arrtype=explode(".",$file);
			$this->origtype=strtolower($arrtype[sizeof($arrtype)-1]);
     }

     function get_info($file)
     {
		    $this->get_w_h($file);
		    //下面得到视频的文件大小
			$size=filesize($file);
			$this->size=$size;

			//下面得到视频文件的原始id
			$origarr=explode("/",$file);
			$filename=$origarr[sizeof($origarr)-1];
			$this->origid=$filename;
			
			//原始文件名
			$this->origfile=basename($file);

			//下面得到文件的原始类型 
			$arrtype=explode(".",$this->origid);
			$this->origtype=strtolower($arrtype[sizeof($arrtype)-1]);
	 }
	 
	function down_pic($down_name,$file)
	{
	   $file_path = $file;
	   //echo $file_path;
	   //exit;
	   //判断要下载的文件是否存在
	   if(!is_file($file_path))
	   {
		   echo "对不起,你要下载的文件不存在。";
		   return 0;
	   }
	
	   $file_size=filesize($file_path);
	   
		header("Pragma: no-cache");
		header("Expires: -1" ); // set expiration time
		header( "Cache-Component: must-revalidate, post-check=0, pre-check=0" );
		header( "Cache-Control: no-cache, must-revalidate");
		header( "Content-type:application/download");
		header( "Content-Length: $file_size"  );
		header( "Content-Disposition: attachment; filename=\"image_".$down_name."\"");
		header( "Content-Transfer-Encoding: binary" );
		readfile( $file_path );

	   return 1;
	}
	 
}
?>
