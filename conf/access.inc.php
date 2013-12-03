<?php
/*
 * 说明：游客访问的黑/白名单，不需要开放的，可以注释掉、或删除
 * 规则：设置的key由APP_NAME/MODULE_NAME/ACTION_NAME组成，只要设置在当前数组中，游客就可以访问
 * 例如：设置成‘blog/Index/news’ => true, 用户就可以访问最新博客页面，否则必须先登录到系统才能访问
 */
return array (
		"access" => array (
				// 核心模块
				'home/Public/*' => true, // 公共模块注册、登录等,不可删除
				'admin/*/*' => true, // 管理后台的权限由它自己控制,不可删除
				'home/Index/index' => true, // 默认首页
				'home/Space/*' => true, // 个人空间
				'api/*/*' => true, // Api接口
				'wap/*/*' => true, // Wap版
				'w3g/*/*' => true, // 3G版
				'phptest/*/*' => true, // 测试专用,可以删除
				'home/Square/*' => true, // 微博广场的权限由管理后台控制
				'home/User/topics' => true, // 话题列表
				
				'home/Widget/renderWidget' => true, // 未登录时渲染插件
				'home/Widget/addonsRequest' => true, // 未登录时下调用钩子相关操作
				'home/Widget/weiboShow' => true, // 小工具：微博秀
				'home/Widget/share' => true, // 小工具：站外分享
				'home/Widget/webpageComment' => true, // 小工具：微博评论框
				                                      
				// 博客配置
				'blog/Index/news' => true, // 最新博客
				'blog/Index/show' => true, // 博客内容
				'blog/Index/personal' => true, // 个人博客
				                               
				// 相册配置
				'photo/Index/photo' => true, // 照片展示
				'photo/Index/album' => true, // 相册展示
				'photo/Index/photos' => true, // 所有照片
				                              
				// 群组配置
				'group/Index/index' => true, // 群组首页
				'group/Index/newIndex' => true, // 群组首页
				'group/Index/search' => true, // 分类列表
				'group/Group/index' => true  // 单群首页
		
		),
		'USER_AUTH_ON' => true,
		'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
		'USER_AUTH_KEY' => 'user', // 用户认证SESSION标记
		'SITE_AUTH_KEY' => 'site', //
		
		'ADMIN_AUTH_KEY' => 'administrator', // 上帝
		'ADMIN_SITE_KEY' => 'www.dotcomnuke.com', // 上帝使用的域名
		
		'USER_AUTH_MODEL' => 'User', // 默认验证数据表模型
		'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式
		
		'USER_AUTH_GATEWAY' => '__APP__/Admin/Public/login', // 默认认证网关
		'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
		'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
		'NOT_AUTH_ACTION' => 'login,logout,register,useredit,userupdate', // 默认无需认证操作
		'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
		'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
		'GUEST_AUTH_ID' => 0, // 游客的用户ID
		                                 
		// 会员权限认证配置
		'MEMBER_AUTH_GATEWAY' => __APP__, // 默认认证网关
		'MEMBER_USER_AUTH_KEY' => 'member', // 前台用户认证SESSION标记
		                                          
		// 与权限相关的表
		'RBAC_SITE_TABLE' => 'tacms_site',
		'RBAC_ROLE_TABLE' => 'tacms_role',
		'RBAC_USER_TABLE' => 'tacms_role_user',
		'RBAC_GROUP_USER_TABLE' => 'tacms_group_user',
		'RBAC_GROUP_TABLE' => 'tacms_group',
		'RBAC_ACCESS_TABLE' => 'tacms_access',
		'RBAC_NODE_TABLE' => 'tacms_node' 
);