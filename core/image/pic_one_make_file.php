<?php

/* 
    单独入库一个视频的类
 
*/
class pic_one_make_file
{
	
	function pic_one_make_file()
	{
		
	}
	
	function make_one_pic($file_path,$pid,$mid_size,$tmb_size)
	{
           $hpd = new common_pic_dir_upload();
           $origpic=$hpd->get_full_orig($pid,'sys',"1");
           $midpic=$hpd->get_full_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_full_tmb($pid,'sys',"1");
           
           //得到原始图
           copy($file_path,$origpic);
           
           //得到中图
	       $i_f = new pic_modify(); 
	       $i_f->cut($origpic,$midpic,$mid_size,1);
	       
	       //生成小图
	       //$i_f->cut_to_square($midpic,$tmbpic,$tmb_size);
	       $i_f->cut($origpic,$tmbpic,$tmb_size,0);
	}			//生成不带水印的中图	function make_one_pic_nomark($pid,$mid_size,$tmb_size)	{	       $hpd = new common_pic_dir_upload();	       $origpic=$hpd->get_full_orig($pid,'sys',"1");	       $midpic=$hpd->get_full_mid_nomark($pid,'sys',"1");	       	       //得到不带水印中图	       $i_f = new pic_modify(); 	       $i_f->cut($origpic,$midpic,$mid_size,0);	}
	
	
	//通过自定义函数生成图片缩略图
	function make_one_pic_thumb($file_path,$pid,$mid_size,$tmb_size)
	{
           $hpd = new common_pic_dir_upload();
           $origpic=$hpd->get_full_orig($pid,'sys',"1");
           $midpic=$hpd->get_full_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_full_tmb($pid,'sys',"1");
           
          //得到原始图
          //@copy($file_path,$origpic);
           
          /* 方式1
           * //得到中图
	       $i_f = new pic_modify(); 
	       $i_f->makethumb($file_path,$midpic,$mid_size,$mid_size);
	       //生成小图
	       $i_f->makethumb($file_path,$tmbpic,$tmb_size,$tmb_size);
	       */
           //方式2
          new image_cut($file_path,$midpic,$mid_size,$mid_size,1,"ffffff",1, 0);
	      new image_cut($file_path,$tmbpic,$tmb_size,$tmb_size,1,"ffffff",1, 0);
	}
	
	
	//良品图片切图
	function pic_one_cropper($file_path,$pid,$ow=0,$oh=0,$w=0,$h=0,$x1=0,$y1=0){
		   $hpd = new common_pic_dir_upload();
           //$origpic=$hpd->get_full_orig($pid,'sys',"1");
           $bigpic=$hpd->get_full_big($pid,'sys',"1");
           $midpic=$hpd->get_full_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_full_tmb($pid,'sys',"1");
           $iconpic=$hpd->get_full_icon($pid,'sys',"1");
           
           $picModObj = new pic_modify();
		   $picModObj->imageCropper($file_path,$bigpic,GOODS_IMG_BIG,GOODS_IMG_BIG,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$midpic,GOODS_IMG_MID,GOODS_IMG_MID,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$tmbpic,GOODS_IMG_TMB,GOODS_IMG_TMB,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$iconpic,GOODS_IMG_ICON,GOODS_IMG_ICON,$ow,$oh,$w,$h,$x1,$y1); 
		   
		    //=======七牛云存储：上传商品图到七牛========
	      $QNSObj = new QiniuStorage();
		  $QNSObj->delete(ltrim($hpd->get_full_orig($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_full_big($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_full_mid($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_full_tmb($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_full_icon($pid,'web',"1"),'/'));
		  
		  $QNSObj->uploadFile($file_path,ltrim($hpd->get_full_orig($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($bigpic,ltrim($hpd->get_full_big($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($midpic,ltrim($hpd->get_full_mid($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($tmbpic,ltrim($hpd->get_full_tmb($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($iconpic,ltrim($hpd->get_full_icon($pid,'web',"1"),'/'));
	}
	
	function pic_one_cropper_upload($file_path,$pid,$ow=0,$oh=0,$w=0,$h=0,$x1=0,$y1=0){
		   $hpd = new common_pic_dir_upload();
           //$origpic=$hpd->get_upload_full_orig($pid,'sys',"1");
           $bigpic=$hpd->get_upload_full_big($pid,'sys',"1");
           $midpic=$hpd->get_upload_full_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_upload_full_tmb($pid,'sys',"1");
           $iconpic=$hpd->get_upload_full_icon($pid,'sys',"1");
           
           $picModObj = new pic_modify();
		   $picModObj->imageCropper($file_path,$bigpic,GOODS_IMG_BIG,GOODS_IMG_BIG,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$midpic,GOODS_IMG_MID,GOODS_IMG_MID,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$tmbpic,GOODS_IMG_TMB,GOODS_IMG_TMB,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$iconpic,GOODS_IMG_ICON,GOODS_IMG_ICON,$ow,$oh,$w,$h,$x1,$y1); 
		   
		  //=======七牛云存储：上传商品图到七牛========
	      $QNSObj = new QiniuStorage();
		  $QNSObj->delete(ltrim($hpd->get_upload_full_orig($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_upload_full_big($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_upload_full_mid($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_upload_full_tmb($pid,'web',"1"),'/'));
		  $QNSObj->delete(ltrim($hpd->get_upload_full_icon($pid,'web',"1"),'/'));
		  
		  $QNSObj->uploadFile($file_path,ltrim($hpd->get_upload_full_orig($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($bigpic,ltrim($hpd->get_upload_full_big($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($midpic,ltrim($hpd->get_upload_full_mid($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($tmbpic,ltrim($hpd->get_upload_full_tmb($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($iconpic,ltrim($hpd->get_upload_full_icon($pid,'web',"1"),'/'));
	}
	
	//生成用户图像
	function make_one_user_thumb($file_path,$pid)
	{
           $hpd = new common_pic_dir_upload();
           $origpic=$hpd->get_full_user_headimg($pid,'sys',"1");
           $midpic=$hpd->get_full_user_headimg_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_full_user_headimg_tmb($pid,'sys',"1");
           
          //得到原始图
          //@copy($file_path,$origpic);
           
           //得到中图
	      new image_cut($file_path,$origpic,USER_IMG_BIG,USER_IMG_BIG,1);
	      new image_cut($file_path,$midpic,USER_IMG_MID,USER_IMG_MID,1,"ffffff",1);
	      new image_cut($file_path,$tmbpic,USER_IMG_TMB,USER_IMG_TMB,1,"ffffff",1);
	      
	      //=======七牛云存储：上传用户图像到七牛========
	      $QNSObj = new QiniuStorage();
	      $QNSObj->delete(ltrim($hpd->get_full_user_headimg($pid,'web',"1"),'/'));
	      $QNSObj->delete(ltrim($hpd->get_full_user_headimg_mid($pid,'web',"1"),'/'));
	      $QNSObj->delete(ltrim($hpd->get_full_user_headimg_tmb($pid,'web',"1"),'/'));
	      
		  $QNSObj->uploadFile($origpic,ltrim($hpd->get_full_user_headimg($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($midpic,ltrim($hpd->get_full_user_headimg_mid($pid,'web',"1"),'/'));
		  $QNSObj->uploadFile($tmbpic,ltrim($hpd->get_full_user_headimg_tmb($pid,'web',"1"),'/'));
	}
	
	function pic_one_cropper_userhead($file_path,$pid,$ow=0,$oh=0,$w=0,$h=0,$x1=0,$y1=0){
		   $hpd = new common_pic_dir_upload();
           $origpic=$hpd->get_full_user_headimg($pid,'sys',"1");
           $midpic=$hpd->get_full_user_headimg_mid($pid,'sys',"1");
           $tmbpic=$hpd->get_full_user_headimg_tmb($pid,'sys',"1");
           
           $picModObj = new pic_modify();
		   $picModObj->imageCropper($file_path,$origpic,USER_IMG_BIG,USER_IMG_BIG,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$midpic,USER_IMG_MID,USER_IMG_MID,$ow,$oh,$w,$h,$x1,$y1);
		   $picModObj->imageCropper($file_path,$tmbpic,USER_IMG_TMB,USER_IMG_TMB,$ow,$oh,$w,$h,$x1,$y1);
		   
		   $this->make_one_user_thumb($file_path,$pid); //生成圆角
	}
	
	//生成首页幻灯图像
	function make_one_slider($file_path,$pid,$width,$height)
	{
           $hpd = new common_pic_dir_upload();
           //$origpic=$hpd->get_full_user_headimg($pid,'sys',"1");
           $pic=$hpd->get_full_slider($pid,'sys',"0");
           
          //得到原始图
          //@copy($file_path,$origpic);
           
          
	      new image_cut($file_path,$pic,$width,$height,1,"ffffff",1, 0);
	}
	
	//生成app专题图片
	function make_one_topicapp($file_path,$pid,$width,$height)
	{
           $hpd = new common_pic_dir_upload();
           $pic480=$hpd->get_full_topicapp480($pid,'sys',0);
           $pic960=$hpd->get_full_topicapp960($pid,'sys',0);
          
           
          //重新生成960px图
	      new image_cut($file_path,$pic960,TOPICAPP_IMG_BIG,$height,1,"ffffff",1, 0);
	      //生成大480px图
	      new image_cut($file_path,$pic480,TOPICAPP_IMG_SMALL,intval($height/2),1,"ffffff",1, 0);
	}
}

?>
