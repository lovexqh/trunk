<?php
if (! defined ( 'SITE_PATH' ))
	exit ();

return array (
		// 数据库常用配置
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'localhost', // 数据库服务器地址
		'DB_NAME' => 'trunk', // 数据库名
		'DB_USER' => 'root', // 数据库用户名
		'DB_PWD' => '', // 数据库密码
		'DB_PORT' => 3306, // 数据库端口
		'DB_PREFIX' => 'ts_', // 数据库表前缀（因为漫游的原因，数据库表前缀必须写在本文件）
		'DB_CHARSET' => 'utf8', // 数据库编码
		'DB_FIELDS_CACHE' => true, // 启用字段缓存
		'VAR_PAGE' => "pagenum",
		'PAGE_LISTROWS' => 20,
		                           
		// 'COOKIE_DOMAIN' => '.thinksns.com', //cookie域,请替换成你自己的域名 以.开头
		                           
		// Cookie加密密码
		'SECURE_CODE' => 'SECURE16112',
		
		// 默认应用
		'DEFAULT_APPS' => array (
				'api',
				'admin',
				'content',
				'auth',
				'home',
				'house',
				'theme',
				'member',
				'wap',
				'w3g' 
		),
		
		// 是否开启URL Rewrite
		'URL_ROUTER_ON' => false,
		
		// 是否开启调试模式 (开启AllInOne模式时该配置无效, 将自动置为false)
		'APP_DEBUG' => false, // 是否开启调试模式
// 		'URL_MODEL' => 1, // 如果你的环境不支持PATHINFO 请设置为3
		'SHOW_PAGE_TRACE' => 0, // 显示调试信息
);
// $db = require SITE_PATH.'/conf/db.php';
// $theme = require SITE_PATH.'/conf/theme.php';
// $auth = require SITE_PATH.'/conf/auth.php';
// $search = require SITE_PATH.'/conf/search.php';
// return array_merge ( $aaaaa, $theme, $auth, $search );