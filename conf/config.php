<?php
if (! defined ( 'THINK_PATH' ))
	exit ();

$config = array(

/* 项目设定 */
		'APP_DEBUG' => true, // 是否开启调试模式
		'URL_MODEL' => 1, // 如果你的环境不支持PATHINFO 请设置为3
		'SHOW_PAGE_TRACE' => 1, // 显示调试信息
		
		'SHOW_RUN_TIME' => true, // 运行时间显示
		'SHOW_ADV_TIME' => true, // 显示详细的运行时间
		'SHOW_DB_TIMES' => true, // 显示数据库查询和写入次数
		'SHOW_CACHE_TIMES' => true, // 显示缓存操作次数
		'SHOW_USE_MEM' => true, // 显示内存开销
		
		'VAR_PAGE' => "pagenum",
		'PAGE_LISTROWS' => 10,
		
		'UPLOAD_PATH' => "/Tpl/Uploads/",
		'SEPARATE' => ",",
		'URL_ROUTER_ON' => false,
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
		) 
);

$db = require 'conf/db.php';
$auth = require 'conf/auth.php';
$search = require 'conf/search.php';
return array_merge ( $config, $db, $auth, $search );
?>