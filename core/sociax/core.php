<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.thinksns.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: melec <melec@163.com>
// +----------------------------------------------------------------------
// $Id$

// sociax模式核心定义文件列表
return array (
		THINK_PATH . '/Exception/ThinkException.class.php',
		THINK_PATH . '/Core/Log.class.php',
		THINK_PATH . '/Db/Db.class.php',
		THINK_PATH . '/Db/Driver/DbMysql.class.php',
		CORE_PATH . '/sociax/alias.php',
		CORE_PATH . '/sociax/Session.class.php',
		CORE_PATH . '/sociax/App.class.php',
// 		CORE_PATH . '/sociax/Action.class.php',
		THINK_PATH . '/Core/Action.class.php',
		CORE_PATH . '/sociax/CommonAction.class.php',
		THINK_PATH . '/Core/Model.class.php',
// 		THINK_PATH . '/Core/Model/ViewModel.class.php',
		CORE_PATH . '/Core/View.class.php',
		CORE_PATH . '/sociax/Service.class.php',
		CORE_PATH . '/sociax/Page.class.php',
		CORE_PATH . '/sociax/Cache.class.php',
		CORE_PATH . '/sociax/Widget.class.php',
		ADDON_PATH . '/libs/Cache/CacheFile.class.php' 
);
?>