<?php
/*
    action与模板的对应关系
    * 
    * by hd
    2010.01.28
*/

class common_pic_dir
{
	    var $disk_base;
	    var $web_base;
	
	   function common_pic_dir()
	   {
	       $this->disk_base =NEWA_DVIMG_DIR."/ware";
	       $this->web_base = "/ware";//NEWA_DVIMG_PATH."/ware";
	   }
	   
	   
	  //取得临时文件地址
	  function get_tmp_dir($uid){
	  	 return "tmp";
	  }
	   
	   //原始图片地址
       function get_base_orig($vid)
       {
	        return "goods/orig";
       }
		
       function get_base_big($vid)
       {
	        return "goods/big";
       }
       
       function get_base_mid($vid)
       {
	        return "goods/mid";
       }

       function get_base_tmb($vid)
       {
	        return "goods/tmb";
       }
	   function get_base_icon($vid)
       {
	        return "goods/icon";
       }
       
       //图片库上传地址
	   function get_upload_orig($vid)
       {
	        return "upload/orig";
       }
       function get_upload_big($vid)
       {
	        return "upload/big";
       }
       function get_upload_mid($vid)
       {
	        return "upload/mid";
       }
       function get_upload_tmb($vid)
       {
	        return "upload/tmb";
       }
	   function get_upload_icon($vid)
       {
	        return "upload/icon";
       }
       
       
       //获取品牌的logo
	   function get_brand_logo($vid)
       {
	        return "brand";
       }
       
	  //获取品牌认领的证件图片
	   function get_brand_card($vid)
       {
	        return "brand/card";
       }
       
       //获取店铺广告目录
       function get_shopADS_dir(){
       	   return "ads/shop";
       }
       
	  //获取用户图像
	   function get_user_headimg($vid)
       {
	        return "userhead/orig";
       }
	  //获取用户图像
	   function get_user_headimg_mid($vid)
       {
	        return "userhead/mid";
       }
	  //获取用户图像
	   function get_user_headimg_tmb($vid)
       {
	        return "userhead/tmb";
       }
       
		//获取幻灯图片
	   function get_slider_dir($id)
       {
	        return "slider";
       }
       
		//获取幻灯店铺图片
	   function get_slider_shop_dir($id)
       {
	        return "slider/shop";
       }
       
	   //获取幻灯店铺图片
	   function get_slider_gallery_dir($id)
       {
	        return "slider/gallery";
       }
       
	   //获取订单图片
	   function get_order_dir($id)
       {
	        return "order";
       }
       

	   //app专题封面
	   function get_topicapp_dir_cover($id)
       {
	        return "appimg/topic/cover";
       }
       
	   //app专题内容详情图片
	   function get_topicapp_dir_con($id)
       {
	        return "appimg/topic/content";
       }
       
       
       //网站专题图片目录
	   function get_topic_cover_dir($id)
       {
	        return "topic/cover";
       }
       
        //促销活动
	   function get_promotion_icon_dir($id)
       {
	        return "promotion/icon";
       }
       
       
       
		function get_full_tmp($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_tmp_dir($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       //----goods img------------------------------------------------------------------img
       function get_full_orig($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_base_orig($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       function get_full_big($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_base_big($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
	   function get_full_mid($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_base_mid($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       function get_full_tmb($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_base_tmb($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
		function get_full_icon($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_base_icon($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	  //----upload img------------------------------------------------------------------img
       function get_upload_full_orig($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_upload_orig($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       function get_upload_full_big($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_upload_big($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
	   function get_upload_full_mid($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_upload_mid($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       function get_upload_full_tmb($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_upload_tmb($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
		function get_upload_full_icon($pid,$pathtype,$ifcreate)
       {
	        $basepath = $this->get_upload_icon($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
       
       //取得品牌logo
       function get_full_brand_logo($pid,$pathtype,$ifcreate){
       		$basepath = $this->get_brand_logo($pid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$pid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	  //取得用户图像原图
       function get_full_user_headimg($uid,$pathtype,$ifcreate){
       		$basepath = $this->get_user_headimg($uid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$uid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	 	//取得用户图像中图
       function get_full_user_headimg_mid($uid,$pathtype,$ifcreate){
       		$basepath = $this->get_user_headimg_mid($uid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$uid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
		//取得用户图像小图
       function get_full_user_headimg_tmb($uid,$pathtype,$ifcreate){
       		$basepath = $this->get_user_headimg_tmb($uid);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$uid,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
		//取得幻灯图片地址
       function get_full_slider($id,$pathtype,$ifcreate){
       		$basepath = $this->get_slider_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	   //取得幻灯店铺图片地址
       function get_full_slider_shop($id,$pathtype,$ifcreate){
       		$basepath = $this->get_slider_shop_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	  //取得幻灯画廊图片地址
       function get_full_slider_gallery($id,$pathtype,$ifcreate){
       		$basepath = $this->get_slider_gallery_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
 	   //取得平排店铺广告图片地址
       function get_full_shopADS_img($id,$pathtype,$ifcreate){
       		$basepath = $this->get_shopADS_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
 	   //取得图片认领证件图片地址
       function get_full_brandcard_img($id,$pathtype,$ifcreate=0){
       		$basepath = $this->get_brand_card($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	   //取得app专题960px地址
       function get_full_topicapp_cover($id,$pathtype,$ifcreate){
       		$basepath = $this->get_topicapp_dir_cover($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	   //取得app专题640px地址
       function get_full_topicapp_cover_new($id,$pathtype,$ifcreate){
       		$basepath = $this->get_topicapp_dir_cover($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base,1);
            return $picdir;
       }
       
	   //取得app专题内容地址
       function get_full_topicapp_con($id,$pathtype,$ifcreate){
       		$basepath = $this->get_topicapp_dir_con($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
	   //取得订单图片的地址
       function get_full_order_img($id,$pathtype,$ifcreate){
       		$basepath = $this->get_order_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
		//取得专题封面图片的地址
       function get_full_topic_cover_img($id,$pathtype,$ifcreate){
       		$basepath = $this->get_topic_cover_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
		//根据时间获取上传APP文件目录
       function get_full_upload_app_date_dir($pathtype='sys'){
			$save_path = $this->disk_base."/upload" . "/";
			$save_url = $this->web_base."/upload" . "/";
			if (!file_exists($save_path)) {
				mkdir($save_path);
				chmod($save_path, 0777);
			}
			
			$save_path .= "app/" ;
			$save_url .= "app/" ;
      		if (!file_exists($save_path)) {
				mkdir($save_path);
				chmod($save_path, 0777);
			}
			
			$ymd = date("Ymd");
			$save_path .= $ymd ;
			$save_url .= $ymd ;
			if (!file_exists($save_path)) {
				mkdir($save_path);
				chmod($save_path, 0777);
			}
			if($pathtype=='web'){
				return $save_url;
			}else{
				return  $save_path;
			}
       }
       
		//取得促销活动地址
	   function get_full_promotion_icon_img($id,$pathtype,$ifcreate){
       		$basepath = $this->get_promotion_icon_dir($id);
		    $spd = new system_pic_dir();
		    $picdir = $spd->get_full_img($basepath,$id,$pathtype,$ifcreate,$this->disk_base,$this->web_base);
            return $picdir;
       }
       
       
}


?>
