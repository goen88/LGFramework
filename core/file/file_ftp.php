<?php
/*
 *    把图片及其他文件ftp出去
 *         by hd
 *        2011.03.03
*/
class file_ftp
{
	 var $link;    //到ftp服务器的连接
	 
	 function file_ftp()
	 {
		   
     }
     
     function ftp_link($ftp_host,$username,$password)
     {
           //$ftp_server='190.148.20.201';//serverip
           $this->link = ftp_connect($ftp_host); 
           $login_result = ftp_login($this->link, $username, $password); 
	 }
	 
	 function mkdir($dir_name)
	 {
		  ftp_mkdir($this->link,$dir_name);
     }
	 
	 function chdir($dir_name)
	 {
		ftp_chdir($this->link, $dir_name);
	 }
	 
	 function ftp_pasv()
	 {
		ftp_pasv($this->link, true);
	 }
	 
	 function put_one_file($local_name,$dest_name)
	 {
		 $upload = ftp_put($this->link, $dest_name,$local_name, FTP_BINARY); 
     }
	 
	 function end_ftp()
	 {
		   ftp_close($this->link);
	 }
	 
function ftp_is_dir( $dir ) 
{
    //global $ftpcon;
    // get current directory
    $original_directory = ftp_pwd( $this->link );
    // test if you can change directory to $dir
    // suppress errors in case $dir is not a file or not a directory
    if ( @ftp_chdir( $this->link, $dir ) ) {
        // If it is a directory, then change the directory back to the original directory
        ftp_chdir( $this->link, $original_directory );
        return true;
    }
    else {
        return false;
    }       
} 
	 
	 
}
?>
