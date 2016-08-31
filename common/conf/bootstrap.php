<?php
/**
 * 框架初始化
 * 
 */
if(!defined("LG_ROOT")){
	define("LG_ROOT", dirname(dirname(__FILE__)));
}
require_once(LG_ROOT.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'db.php');
require_once(LG_ROOT.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'config.php');
require_once(LG_ROOT.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'loader'.DIRECTORY_SEPARATOR.'LGLoader.php');

//加载系统核心类
LGLoader::load('core/utils/*');
LGLoader::load('core/dir/*');
LGLoader::load('core/file/*');
LGLoader::load('core/image/*');
LGLoader::load('core/log/log4php/Logger.php');
LGLoader::load('core/log/*');
LGLoader::load('core/pager/normal_page_list.php');
LGLoader::load('core/system_data_data/*','_data.php');
LGLoader::load('core/router/*');
if(defined("LG_DB_MYSQL")&&LG_DB_MYSQL==true){
	LGLoader::load('core/db/mysql/*');
}
if(defined("LG_DB_REDIS")&&LG_DB_REDIS==true){
	LGLoader::load('core/db/redis/*');
}
if(defined("LG_DB_MEMCACHE")&&LG_DB_MEMCACHE==true){
	LGLoader::load('core/db/memcache/*');
}
LGLoader::load('core/session/*');
if(defined("LG_TEMPLATES_ENGINE")&&LG_TEMPLATES_ENGINE==true){
	LGLoader::load('core/templates/smarty/Smarty_class.php');
}

LGLoader::load('core/base/LGBase.php');
LGLoader::load('core/base/LG.php');

//加载公共类
LGLoader::load('common/comments/*');
LGLoader::load('common/data_data/*');
LGLoader::load('common/data_model/*');
LGLoader::load('common/data_trigger/*');
LGLoader::load('common/module/*');


//夹在项目目录下文件
if(defined("LG_WEB_ROOT")){
	LGLoader::load(str_replace(LG_ROOT.DIRECTORY_SEPARATOR, '', LG_WEB_ROOT.DIRECTORY_SEPARATOR.'comments/*'));
	LGLoader::load(str_replace(LG_ROOT.DIRECTORY_SEPARATOR, '', LG_WEB_ROOT.DIRECTORY_SEPARATOR.'models/*'));
	LGLoader::load(str_replace(LG_ROOT.DIRECTORY_SEPARATOR, '', LG_WEB_ROOT.DIRECTORY_SEPARATOR.'utils/*'));
}

