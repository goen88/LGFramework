LGFrameWork 1.0 框架说明文档
===================================

LGFrameWork 1.0 是基于MVC,在传统的MVC基础上加入了一层业务层的Model，实现了控制层和业务层的分离。

安装
=====

###Apache配置###
```
<VirtualHost *:80>
    ServerName lg.lh
    DocumentRoot "*/LGFramework/site/www/html"
    <Directory "*/LGFramework/site/www/html">
        AllowOverride All
        Require all granted
        <Files ~ "^(action)$" >
            ForceType   application/x-httpd-php
        </Files>
    </Directory>
    DirectoryIndex action index.php  index.html index.shtml index.htm
</VirtualHost>
```

###Nginx配置###

```
server {
    listen       80;
    server_name lg.lh;
    root         */LGFramework/site/www/html;
    index   index.php index.html index.shtml  index.htm;


    location / {
            try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```


目录结构
-------

```
├── common
│   ├── comments
│   ├── conf
│   ├── data_data
│   ├── data_model
│   ├── data_trigger
│   ├── module
│   └── vendors
├── core 系统核心程序
│   ├── base
│   ├── db
│   │   ├── memcache
│   │   ├── mysql
│   │   └── redis
│   ├── dir
│   ├── file
│   ├── image
│   ├── loader
│   ├── log
│   │   └── log4php
│   ├── mail
│   ├── pager
│   ├── router
│   ├── session
│   │   ├── lib_staff
│   │   └── lib_user
│   ├── system_data_data
│   ├── templates
│   │   └── smarty
│   └── utils
├── doc
└── site
    ├── api
    │   ├── action_prog
    │   ├── conf
    │   ├── html
    │   ├── models
    │   └── runtime
    ├── backend
    │   ├── action_prog
    │   ├── action_templates
    │   ├── action_templates_c
    │   ├── conf
    │   ├── html
    │   ├── models
    │   └── runtime
    └── www
        ├── action_prog
        │   └── home
        ├── action_templates
        ├── action_templates_c
        ├── conf
        ├── html
        ├── models        
        └── runtime
```

系统配置配置文件说明
-------

```
//是否开启调试模式，上线后关闭
define("LG_DEBUG",false);
//web根目录
define("LG_WEB_ROOT", dirname(dirname(__FILE__)) );
//控制器认证，默认关闭
define("LG_AUTHENTICATION",false);
//控制器路径
define("LG_STRUCTS_PATH", LG_WEB_ROOT.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'config_structs.php');
//控制器模式：0->共享模式，controller文件都放action_prog根目录;
//1-分离模式，controller文件放在action_prog和类名相同的目录，建议和LG_TEMPLATES_ENGINE_MODE同时使用
define("LG_ACTION_MODE",0);
//默认actin类名称
define("LG_ACTION_NAME",'home');
//默认actin类入口函数名称
define("LG_ACTION_FUNC",'go');
//默认actin类入口函数名称
define("LG_ACTION_FUNC_SUBFIX",'Action');
//默认acting目录名称
define("LG_ACTION_DIR_NAME",'action_prog');
//默认action类型后缀
define("LG_ACTION_SUBFIX",'_action.php');
//是否启用mysql数据库，默认开启
define("LG_DB_MYSQL",true);
//是否开启smary模板引擎，默认关闭
define("LG_TEMPLATES_ENGINE",true);
//模板引擎模式：0->共享模式，模板文件放在LG_TEMPLATES_DIR配置中;
//1-分离模式，模板文件和controller同目录,建议和LG_ACTION_MODE同时使用
define("LG_TEMPLATES_ENGINE_MODE",0);
//模板文件目录，在LG_TEMPLATES_ENGINE_MODE1时失效
define("LG_TEMPLATES_DIR",LG_WEB_ROOT.DIRECTORY_SEPARATOR.'action_templates');
//模板编译文件目录
define("LG_TEMPLATES_DIR_C",LG_WEB_ROOT.DIRECTORY_SEPARATOR.'action_templates_c');
//是否开启redis数据库，默认关闭
define("LG_DB_REDIS",false);
//是否开启memcache数据库，默认关闭
define("LG_DB_MEMCACHE",false);
//定义日志目录
define("LG_RUNTIME_LOG", LG_WEB_ROOT.DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR.'app.log' );
//定义日志目录,单位M（兆）,默认64M
define("LG_RUNTIME_LOG_SIZE", 32);
//定义sessiion存储模式：0->存在服务器;1-数据库
define("LG_SESSION_MODE", 0);
```


使用说明
-------

1、参考安装说明，选择合适的Web server，安装配置
2、添加数据配置在工程跟目录下common/db.php

```
//mysql数据库配置文件，可修改
define("LG_MYSQL_HOST","127.0.0.1");
define("LG_MYSQL_USER","root");
define("LG_MYSQL_PASS","123");
define("LG_MYSQL_DBNAME","shoppingguide");
```

3、默认工程为框架更目录下的site/www,且web根目录为site/www/html
4、工程目录文件说明

```
site/www
        ├── action_prog #controller文件目录
        │   └── home #LG_ACTION_MODE等于1的时候才会子目录
        ├── action_templates #模板文件目录，LG_TEMPLATES_ENGINE_MODE等于时有效
        ├── action_templates_c #模板编译文件
        ├── conf #www项目配置文件目录
        |   └── config_const_var.php #项目配置文件，具体配置参见配置文件说明
		|	└── config_structs.php #控制器访问权限配置，LG_AUTHENTICATION开启生效，暂不用到可以不管
        ├── html  # web目录
        ├── models  #数据模型      
        └── runtime #运行日志目录
```
5、controller使用说明，默认controller为home_action ,所有controller都继承自common/comments/base_action.php，具体site/www/action_prog/目录已经有了，可参看，新建一个新的topic的controller为例：

```
(1) 由于工程默认这里配置的是 LG_TEMPLATES_ENGINE_MODE 和 LG_TEMPLATES_ENGINE_MODE都为1（分离模式），所以action目录应该
为
├── action_prog #controller文件目录
│   └── home
│       └── home_action.php
│	└── topic
│       └── topic_action.php

(2) topic_action.php 内容为：

class topic_action extends base_action{
	function home_action() {
		//LG_TEMPLATES_ENGINE_MODE=1有效
		$tpl_dir = LG_WEB_ROOT.DIRECTORY_SEPARATOR.LG_ACTION_DIR_NAME.DIRECTORY_SEPARATOR.str_replace(str_replace('.php','',LG_ACTION_SUBFIX), '', get_class($this));
		parent::__construct($tpl_dir);
	}


	public function goAction()
    {    
       //访问方式：http://xxx/topic
    }

    public function listAction(){
    	//访问方式：http://xxx/topic/list
    }

}

```

6、调试文件位于当前项目的 runtime目录

7、常用的方法

```
	//日志调试方法
    LG::log()->［info|warn|error]('') ;#输出到runtime/app.log文件中

	//支持restfull API调用统一输出函数
	LG::rest($code, //状态：0-表示成功;>0 表示有错误 ，错误代码类：core/log/LGError.php
			 array(
				'has_more'=>true, //是否还有数据,
				'num_items'=>0, // 总数据量
				'items'=> array()//数据
		);

	//request获取get、post参数、请求判断
	LG::reqeust()->[getInt('parama')|getFloat('parama')|getString('parama')|getArray('parama')|isAjax()|isGet()|isPost()]

	//获取用户自定义参数，参数配置文件，common/conf/params.php
	LG::$params['opsdk'][...];

```

8、数据库表类位于common/data_data目录下 里面有个一个例子

9、数据库操作使用说明情参考工程目录下的readme_db.pdf文件或者 [PHP-MySQLi-Database-Class](https://github.com/joshcam/PHP-MySQLi-Database-Class)  这个网址
