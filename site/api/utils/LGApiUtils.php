<?php

class LGApiUtils extends LGUtils {
    // 统一的前缀，用于同一  MC 服务上和其它应用系统的 key 区分开，比如测试和正式的区分开。
    protected static $m_prefix = MEMCACHE_PREFIX;
    
    static function makeSmsCodeKey($unique_id) {
        return self::makeMcKey('smsCode', array('unique_id' => $unique_id));
    }

    /**
     * 统一生成键
     *
     * @param string $obj_name
     *        	MC 对象名字
     * @param string $key_factors
     *        	MC 的 key 因素。支持多维数组，建议仅使用一维数组。
     * @return string
     */
    static function makeMcKey($obj_name, $key_factors = array()) {
        // 数组的第一维先按键名排序，以实现入参乱序时规范化成一致。
        ksort($key_factors, SORT_STRING);
        // print_r($key_factors);
        // http_build_query 支持多维数组，并且会使数组元素的值会统一转换成字符串，以避免 serialize 时保持值类型带来的不一致。比如 array('a'=>1) 和 array('a'=>'1') 应生成一样的 key。
        // echo http_build_query($key_factors);
        $key = self::$m_prefix . '|' . $obj_name . '|' . md5(http_build_query($key_factors));
        return $key;
    }
    
    /**
     * 统一数组中的值转成字符串
     *
     * @param array $data
     *        	
     * @return array
     */
    static function data_string($data){
        if(!is_array($data)) return $data;
        foreach($data as $k=>$v){
            if($k == 'mobile_phone'){
                $k = "mobile";
            }
            $new_data[$k] = (string)$v;
        }
        return $new_data;
    }
}
