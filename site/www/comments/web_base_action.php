<?php
/**
 * web action基类
 * 
 * @author goen
 *
 */
class web_base_action extends base_action {
	public function __construct($son_action_name='',$tpl_dir=null){
		parent::__construct($son_action_name,$tpl_dir);
	}
}