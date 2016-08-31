<?php
/*
    class videoinfo
	用来得到视频文件的属性

	备注：是文件自身的属性，不包含相关的说明信息
		 2008-03-20
*/

class tar_file
{
	  //var $nopathfile;


      //构造函数，初始化文件路径
	  function tar_file()
	  {
		    
	  }

      function tar_one_file($tarpath,$onefile)
      {
             $basename = basename($onefile);
             $dirname  = dirname($onefile);
             //添加文件到tar ball
             if (!is_file($tarpath))
             {
                     $cmd_param = "cPf";
             }
             else
             {
                     $cmd_param = "rPf";
             }

             //得到命令行，并运行
             $cmd_tar = "/bin/tar -".$cmd_param." ".$tarpath." -C ".$dirname." ".$basename;
             //echo "<br/>".$cmd_tar."<br/>";
             $ret_tar = shell_exec($cmd_tar." 2>&1");
             //echo $ret_tar."<br/>";
             //echo filesize($tarpath)."<br/>";
	  }


      function make_a_tar_file_by_arr($tarfile,$arr_v)
      {
           //检查目录
      	   $fsu = new file_system_utils();
      	   $fsu->check_a_file_path_dir($tarfile);

           foreach($arr_v as $kv => $onefile)
           {
                 $this->tar_one_file($tarfile,$onefile);
                 
           }
           //返回tar文件路径
           return $tarfile;
	  }

	function down_a_tar_file($pathfile,$down_name)
	{
		
		
//$file_path="/bank/file_dv/tar/20111001/1_181412_1541253296.tar";
//echo filesize($file_path);
		
	   $file_path = $pathfile;
	   //判断要下载的文件是否存在
	   if(!is_file($file_path))
	   {
		   //echo "对不起,你要下载的文件不存在。";
		   return 0;
	   }
	   //echo "file_path:".$file_path."<br/>";
	   //$file_size=filesize($file_path);
	   $file_size = $this->get_tar_file_size($file_path);
	  // exit;
	   //echo filesize($file_path)."<br/>";
	   //echo "size:".$file_size."<br/>";
	   //exit;
		header( "Pragma: public" );
		header( "Expires: 0" ); // set expiration time
		header( "Cache-Component: must-revalidate, post-check=0, pre-check=0" );
		header( "Content-type:application/download");
		header( "Content-Length: $file_size"  );
		header( "Content-Disposition: attachment; filename=\"image_".$down_name."\"");
		header( 'Content-Transfer-Encoding: binary' );
		readfile( $file_path );

	   return 1;
	}
	
	function get_tar_file_size($file_path)
	{
		  $cmd_tar = "/bin/ls -l ".$file_path;
		  $ret_tar = shell_exec($cmd_tar." 2>&1");
		  //echo $ret_tar;
		  $arr_tar = explode(" ",$ret_tar);
		  //print_r($arr_tar);
		  $filesize = $arr_tar[4];
		  return $filesize;
	}
	
}     //end   class videoinfo

?>
