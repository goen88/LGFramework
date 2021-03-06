<?php
/**
 * php兼容IOS Android 的AES加密解密算法
 * 
 * 参考来源  http://www.funboxpower.com/php_android_ios_aes
 * @author goen
 * 
 * @example 使用示例
 * 	$encryption = new MCrypt();
 * 	echo $encryption->encrypt('123456') . "<br/>";
 * 	echo $encryption->decrypt('tpyxISJ83dqEs3uw8bN/+w==');
 *
 */


class LGMCrypt {
    private $hex_iv = '00000000000000000000000000000000'; # converted JAVA byte code in to HEX and placed it here           
    private $key = LG_AES_SALT; #Same as in JAVA /ios
    function __construct($salt=null) {
    	if($salt){
    		$this->key = $salt;
    	}
        $this->key = hash('sha256', $this->key, true);
        //echo $this->key.'<br/>';
    }
    function encrypt($str) {   
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($td, $this->key, $this->hexToStr($this->hex_iv));
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $pad = $block - (strlen($str) % $block);
        $str .= str_repeat(chr($pad), $pad);
        $encrypted = mcrypt_generic($td, $str);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);    
        return base64_encode($encrypted);
    }
    function decrypt($code) {    
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($td, $this->key, $this->hexToStr($this->hex_iv));
        $str = mdecrypt_generic($td, base64_decode($code));
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);    
        return $this->strippadding($str);           
    }
    /*
      For PKCS7 padding
     */
    private function addpadding($string, $blocksize = 16) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }
    private function strippadding($string) {
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);
        if (preg_match("/$slastc{" . $slast . "}/", $string)) {
            $string = substr($string, 0, strlen($string) - $slast);
            return $string;
        } else {
            return false;
        }
    }
    
	function hexToStr($hex)
	{
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2)
	    {
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}
}
 
?>