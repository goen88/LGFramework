<?php


class Mailer {
	var $mail;
	
	function Mailer($host="ms.cfp.cn" , $username="cfp@cfp.cn" ,$password="cfp123") {

		//$username = 'cfp@cfp.cn';
		//$password = 'cfp12345';
		//$host="ms.cfp.cn";
		$mail = new phpmailer();
		$mail->IsSMTP();     

		$mail->Host = $host; 
		$mail->SMTPAuth = true;// 启用SMTP身份认证
		/**gmail set start 采用ssl****************/
		$mail->SMTPSecure = "ssl"; // 设置服务器前缀，gmail的smtp服务器是ssl://smtp.gmail.com
		$mail->Port = 465; // gmail的smtp端口是465
		/**gmail set end****************/
		$mail->Username = $username;
		$mail->Password = $password;
		//$mail->From = "cfp@cfp.cn";
		$mail->From = $username;
		$this->mail = $mail;
    }
    
    function addCC($address){
    	$this->mail->AddCC($address);
    }
    
    function addBCC($address){
    	$this->mail->AddBCC($address);
    }

	function setFrom($address){
    	$this->mail->From = $address;
    }

	function AddReplyTo($address){
    	$this->mail->AddReplyTo($address);
    }
    
    function addFile($file){
    	$this->mail->AddAttachment($file);
    }
    
    
    function send($to,$name,$subject,$message,$isHtml=false){
		//$mailto = split (",", $to);
		$mailto = explode(",", $to);
		foreach($mailto as $thekey=>$oneto ){
			if($oneto!=""){
				$this->mail->AddAddress($oneto);
			}
		}
		$this->mail->FromName = $name;		
		//$this->mail->Subject = "=?GB2312?B?".base64_encode($subject)."?=";
		$this->mail->Subject = "=?UTF-8?B?".base64_encode($subject)."?=";
		//$this->mail->Subject = base64_encode($subject);
		$this->mail->Body    = str_replace("\n","",$message);
		$this->mail->AltBody = $message;
		$this->mail->IsHTML($isHtml);
		if(!$this->mail->Send())
		{
			echo $this->mail->ErrorInfo;
			return -1;
		}
		return 0;
    }
}
?>
