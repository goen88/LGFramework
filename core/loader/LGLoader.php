<?php
/**
 * 
 */

class LGLoader
{
	 function LGLoader()
	 {
	 	
     }
	 
	 /**
	  * 加载文件
	  * 
	  * @param string[路径] $path  [common/vendors/alipay/*] | [ommon/vendors/alipay/index.php]
	  * @param string[后缀] $file_suffix
	  * @copyright 2015 by gaorunqiao.ltd
	  * @author goen<goen88@163.com>
	  * @return boolean
	  */
	 public static function load($path,$file_suffix='.php'){
	 	$path = trim($path,"/");
	 	$pathArr = explode('/', $path);
	 	if(count($pathArr)==0){
	 		return;
	 	}
	 	$last_arr_val =  $pathArr[count($pathArr)-1];
	 	if($last_arr_val!='*'){
	 		$_self = new LGLoader();
	 		self::_loadFile($pathArr,$file_suffix);
	 	}else if($last_arr_val=='*'){
	 		self::_loadDir($pathArr,$file_suffix);
	 	}
	 }
	 
	
	 private static function _loadFile($pathArr,$file_suffix='.php'){
	 	$_dest_path = LG_ROOT.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $pathArr);
 		if(is_file($_dest_path)){
 			$cur_suffix = substr($_dest_path,strlen($file_suffix)*-1);
 			if($cur_suffix==$file_suffix){
 				require_once($_dest_path);
 			}
 		}else if(is_dir($_dest_path)){
 			self::_loadDir($pathArr,$file_suffix);
 		}
	 }
	 
	 private static function _loadDir($pathArr,$file_suffix='.php'){
	 	  if($pathArr[count($pathArr)-1]=='*'){
	 	  	array_pop($pathArr); //移出数组最后一个元素
	 	  }
	 	  $dir_path = LG_ROOT.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $pathArr);
	 	  $opened_dir = opendir($dir_path);
          while ($onefile=readdir($opened_dir))
          {
			    if(($onefile=='.') || ($onefile=='..'))
			    {
					  continue;
				}
				
                $cur_suffix = substr($onefile,strlen($file_suffix)*-1);
                
                if ($cur_suffix == $file_suffix)
                {
					$full_path = $dir_path."/".$onefile;
                    require_once($full_path);
                }
          }
          closedir($opened_dir);
	 }

} 
?>
