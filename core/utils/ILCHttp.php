<?php
/**
* ILCHttp
*/
class ILCHttp
{
    private static function request($method, $url, $pem, $params){
        if (!in_array($method, array('GET', 'POST'))){
            throw new Exception('Method not allowed');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        if ($method == 'POST'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        if ($pem) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 
            curl_setopt($ch, CURLOPT_CAINFO, $pem);
        }
        // curl_setopt($ch, CURLOPT_VERBOSE, true);
        // $file = fopen("/tmp/curl.log","a");
        // curl_setopt($ch, CURLOPT_STDERR, $file);
        // fclose($file);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);
    }

    static function POST($url, $pem, $params=array())
    {
        return ILCHttp::request('POST', $url, $pem, $params);
    }
    
    static function GET($url, $pem, $params=array())
    {
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        return ILCHttp::request('GET', $url, $pem, array());
    }
}

?>
