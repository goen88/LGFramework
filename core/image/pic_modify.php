<?php
/*
   切图
   * 
   * 2010.03.29
*/

class pic_modify
{
     function pic_modify()
     {

	 }

	function cut($origpic,$destpic,$size,$waterflag=0)
	{
			//得到小图的路径
			//$tmbpic=get_full_tmb($pid,$pathtype='sys',$ifcreate="1");
			//生成小图
						$cmdtmb = "/usr/bin/convert -size ".$size."x".$size;
			$cmdtmb .= " -resize ".$size."x".$size." +profile '*'  ";
			//$cmdtmb .= " -border 60x60 -bordercolor '#000000' ".
			$cmdtmb .= $origpic." ".$destpic." 2>&1";
			$rettmb=shell_exec($cmdtmb);
						//添加水印		   if($waterflag==1){		   		$picture_info = getimagesize($destpic);			   	$WIDTH =  intval($picture_info[0]);			   	$HEIGHT = intval($picture_info[1]);			   	$WIDTH =  $WIDTH/2-100;			   	$HEIGHT = $HEIGHT/2+10;			   	$cmdtmb = "/usr/bin/convert -font helvetica -fill '#f0f0f0' -pointsize 36 ";		   	 	$cmdtmb .= " -draw 'text $WIDTH,$HEIGHT \" Lightacad.com \"' ";		   	 	$cmdtmb .= $destpic." ".$destpic." 2>&1";		   	 	$rettmb=shell_exec($cmdtmb); 		   }
    }
    
    function cut_to_square($origpic,$destpic,$size)
    {
		
		   $i_f = new pic_file();
		   $i_f->get_width_height_size($origpic);
		   $width = $i_f->width;
		   $height = $i_f->height;
		
            if ($width > $height) 
            {
				$max = $width;
                $crop=($height*$max)/$width;
                $left=($max-$crop)/2;
                $top=0;
                $syssqu="/usr/bin/convert -crop ".$crop."x".$crop."+".$left."+".$top." ".$origpic." ".$destpic." 2>&1";
            } 
            else if ($height > $width) 
            {
				$max = $height;
                $crop=($width*$max)/$height;
                $left=0;
                $top=($max-$crop)/2;
                $syssqu="/usr/bin/convert -crop ".$crop."x".$crop."+".$left."+".$top." ".$origpic." ".$destpic." 2>&1";
            } 
            else 
            {
                $syssqu="/usr/bin/convert -size ".$size."x".$size." -resize ".$size."x".$size." ".$origpic." ".$destpic." 2>&1";
            }
            
            $retrs5=shell_exec($syssqu);
            if ($width<>$height) {
                $syssiz="/usr/bin/mogrify -size ".$size."x".$size." -resize ".$size."x".$size." ".$destpic;
                $retrs6=shell_exec($syssiz);
            }
		        /*
				$cmdtmb="/usr/bin/convert -geometry ".$size." ".$origpic." -crop ".$size."x".$size."+0+22 ".$destpic."";
					//" -resize ".$size."x".$size." +profile '*' ".$origpic." ".$destpic." 2>&1";
				//echo "cmdtmb:".$cmdtmb."\n";
				$rettmb=shell_exec($cmdtmb);
				*/
	}
    
	function cut_by_width($origpic,$destpic,$width)
	{
			//得到小图的路径
			//$tmbpic=get_full_tmb($pid,$pathtype='sys',$ifcreate="1");
			//生成小图

				$cmdtmb="/usr/bin/convert -resize ".$width." +profile '*' ".$origpic." ".$destpic." 2>&1";
				//echo "cmdtmb:".$cmdtmb."\n";
				$rettmb=shell_exec($cmdtmb);

		    //return $pid;
    }
    
	/*构造函数-生成缩略图+水印,参数说明:
	$srcFile-图片文件名,
	$dstFile-另存文件名,
	$markwords-水印文字,
	$markimage-水印图片,
	$dstW-图片保存宽度,
	$dstH-图片保存高度,
	$rate-图片保存品质
	makethumb("1.jpg","aa/b.jpg","50","50");
	*/
	function makethumb($srcFile,$dstFile,$dstW,$dstH,$rate=100,$markwords=null,$markimage=null)
	{
		$data = GetImageSize($srcFile);
		switch($data[2])
		{
			case 1:
				$im=@ImageCreateFromGIF($srcFile);
				break;
			case 2:
				$im=@ImageCreateFromJPEG($srcFile);
				break;
			case 3:
				$im=@ImageCreateFromPNG($srcFile);
				break;
		}
		
		if(!$im) return False;
		
		$srcW=ImageSX($im);
		$srcH=ImageSY($im);
		$dstX=0;
		$dstY=0;
		if ($srcW*$dstH>$srcH*$dstW)
		{
			$fdstH = round($srcH*$dstW/$srcW);
			$dstY = floor(($dstH-$fdstH)/2);
			$fdstW = $dstW;
		}
		else
		{
			$fdstW = round($srcW*$dstH/$srcH);
			$dstX = floor(($dstW-$fdstW)/2);
			$fdstH = $dstH;
		}
		$ni=ImageCreateTrueColor($dstW,$dstH);
		$dstX=($dstX<0)?0:$dstX;
		$dstY=($dstX<0)?0:$dstY;
		$dstX=($dstX>($dstW/2))?floor($dstW/2):$dstX;
		$dstY=($dstY>($dstH/2))?floor($dstH/s):$dstY;
		$white = ImageColorAllocate($ni,255,255,255);
		$black = ImageColorAllocate($ni,0,0,0);
		imagefilledrectangle($ni,0,0,$dstW,$dstH,$white);// 填充背景色
		ImageCopyResized($ni,$im,$dstX,$dstY,0,0,$fdstW,$fdstH,$srcW,$srcH);
		if($markwords!=null)
		{
			$markwords=iconv("gb2312","UTF-8",$markwords);
			//转换文字编码
			ImageTTFText($ni,20,30,450,560,$black,"simhei.ttf",$markwords); //写入文字水印
			//参数依次为，文字大小|偏转度|横坐标|纵坐标|文字颜色|文字类型|文字内容
		}
		elseif($markimage!=null)
		{
			$wimage_data = GetImageSize($markimage);
			switch($wimage_data[2])
			{
				case 1:
					$wimage=@ImageCreateFromGIF($markimage);
					break;
				case 2:
					$wimage=@ImageCreateFromJPEG($markimage);
					break;
				case 3:
					$wimage=@ImageCreateFromPNG($markimage);
					break;
			}
			imagecopy($ni,$wimage,500,560,0,0,88,31); //写入图片水印,水印图片大小默认为88*31
			imagedestroy($wimage);
		}
		ImageJpeg($ni,$dstFile,$rate);
		//ImageJpeg($ni,$srcFile,$rate);
		imagedestroy($im);
		imagedestroy($ni);
	}
	
	
	//去图片剪切保存
	/**
	 * $srcFile 原始图片路径
	 * $dstFile 保存图片路径
	 * $dstW 存储图片宽度
	 * $dstH 存储图片的高度
	 * $webW 图片在网页中的宽度
	 * $webH 图片在网页中的高度
	 * $selectW 选择框的宽度
	 * $selectH 选择框的高度
	 * $x 选择点的X坐标
	 * $y 选择点的Y坐标
	 * $quaity 生成图片的品质
	 */
	function imageCropper($srcFile,$dstFile,$dstW,$dstH,$webW,$webH,$selectW,$selectH,$x,$y,$quaity=92)
	{
		$data = GetImageSize($srcFile);
		switch($data[2])
		{
			case 1:
				$im=@ImageCreateFromGIF($srcFile);
				break;
			case 2:
				$im=@ImageCreateFromJPEG($srcFile);
				break;
			case 3:
				$im=@ImageCreateFromPNG($srcFile);
				break;
		}
		
		if(!$im) return False; 
    	$srcW=ImageSX($im)?ImageSX($im):0;
		$srcH=ImageSY($im)?ImageSY($im):0;
		
		//如果原图小于当前要截图的大小，直接拷贝
		if($srcW<$dstW&&$srcH<$dstH){
			$dstW = $srcW;
			$dstH = $srcH;
		}
		
		
		if(!empty($selectW)&&intval($selectW)!=0){
			$ratioWSW = doubleval($srcW/$webW); //原图宽和web中宽比率
			$ratioHSH = doubleval($srcH/$webH); //原图高和web中高比率
			
			$realX = round($ratioWSW*$x); //相对原图的X坐标
	        $realY = round($ratioHSH*$y); //真是图片的Y坐标
	        $realW = round($ratioWSW*$selectW); //相对原图长度
	        $realH = round($ratioHSH*$selectH); //真是图片宽度
	        if($realX+$realW>$srcW){
	        	$realX = ($srcW-$realW)>0?($srcW-$realW):0;
	        }
			if($realY+$realH>$srcH){
	        	$realY = ($srcH-$realH)>0?$srcH-$realH:0;
	        }
		}else{
			$realX= 0;
			$realY = 0;
			$realW = $srcW;
			$realH = $srcH;
		}
		
		//改变后的图象的比例
      if($dstH!=0)$resize_ratio = $dstW/$dstH; else $resize_ratio =1;
       //实际图象的比例
      if($realH!=0)$ratio = $realW/$realH; else $ratio=1;
      
	 if($ratio==$resize_ratio)
      {
               $newimg = imagecreatetruecolor($dstW,$dstH);
			   $white = ImageColorAllocate($newimg,255,255,255);
			   imagefill($newimg, 0, 0, $white); //填充背景色
               //ImageCopyResized($newimg, $im, 0, 0, $realX, $realY, $dstW,$dstH/$resize_ratio,$realW,$realH);
               imagecopyresampled($newimg, $im, 0, 0, $realX, $realY, $dstW,$dstH,$realW,$realH);
               ImageJpeg($newimg,$dstFile,$quaity);
      } 
	 if($ratio>$resize_ratio)
      {
               $newimg = imagecreatetruecolor($dstW,$dstH/$ratio);
			   $white = ImageColorAllocate($newimg,255,255,255);
			   imagefill($newimg, 0, 0, $white); //填充背景色
               //ImageCopyResized($newimg, $im, 0, 0, $realX, $realY, $dstW,$dstH/$resize_ratio,$realW,$realH);
               imagecopyresampled($newimg, $im, 0, 0, $realX, $realY, $dstW,$dstH/$ratio,$realW,$realH);
               ImageJpeg($newimg,$dstFile,$quaity);
      }
      if($ratio<$resize_ratio)
      {
               $newimg = imagecreatetruecolor($dstW*$ratio,$dstH);
               $white = ImageColorAllocate($newimg,255,255,255);
			   imagefill($newimg, 0, 0, $white); //填充背景色
               //ImageCopyResized($newimg, $im, 0, 0, $realX, $realY, $dstW*$resize_ratio,$dstH,$realW,$realH);
               imagecopyresampled($newimg, $im, 0, 0, $realX, $realY, $dstW*$ratio,$dstH,$realW,$realH);
               ImageJpeg($newimg,$dstFile,$quaity);
      }
	}
	
	//图片缩放
	function imgResizedByWidth($src_img,$dst_w,$quality=100){		ob_clean();
		// 缩略图尺寸
		list($width, $height) = getimagesize($src_img);
		// 缩略图比例
		$percent = $dst_w/$width;
		$newwidth = intval($width * $percent);
		$newheight = intval($height * $percent);
		// 加载图像
		$data = GetImageSize($src_img);
		switch($data[2])
		{
			case 1:
				$src_im = @ImageCreateFromGIF($src_img);
				break;
			case 2:
				$src_im=@ImageCreateFromJPEG($src_img);
				break;
			case 3:
				$src_im=@ImageCreateFromPNG($src_img);
				break;
		}
		$dst_im = imagecreatetruecolor($newwidth, $newheight);
		$ret = imagecopyresampled($dst_im, $src_im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		//输出缩小后的图像
		header("Content-type:image/jpeg");
		imagejpeg($dst_im,null,$quality);
		imagedestroy($dst_im);
	}
}
?>
