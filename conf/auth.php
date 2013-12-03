<?php
return array(
		
		'USER_AUTH_ON'              =>true,
        'USER_AUTH_TYPE'	    =>2,		// 默认认证类型 1 登录认证 2 实时认证
        'USER_AUTH_KEY'             =>'user',	// 用户认证SESSION标记
		'SITE_AUTH_KEY'             =>'site',	// 
		
        'ADMIN_AUTH_KEY'	    =>'administrator',//上帝
        'ADMIN_SITE_KEY'           =>'www.dotcomnuke.com', //上帝使用的域名
        
        'USER_AUTH_MODEL'           =>'User',	// 默认验证数据表模型
        'AUTH_PWD_ENCODER'          =>'md5',	// 用户认证密码加密方式
        
        'USER_AUTH_GATEWAY'         =>'__APP__/Admin/Public/login',// 默认认证网关
        'NOT_AUTH_MODULE'           =>'Public',	// 默认无需认证模块
        'REQUIRE_AUTH_MODULE'       =>'',		// 默认需要认证模块
        'NOT_AUTH_ACTION'           =>'login,logout,register,useredit,userupdate',		// 默认无需认证操作
        'REQUIRE_AUTH_ACTION'       =>'',		// 默认需要认证操作
        'GUEST_AUTH_ON'             =>false,    // 是否开启游客授权访问
        'GUEST_AUTH_ID'             =>0,        // 游客的用户ID

		//会员权限认证配置
		'MEMBER_AUTH_GATEWAY'         =>__APP__,// 默认认证网关
		'MEMBER_USER_AUTH_KEY'        =>'member',	// 前台用户认证SESSION标记
        
        //与权限相关的表
		'RBAC_SITE_TABLE'           =>'tacms_site',
        'RBAC_ROLE_TABLE'           =>'tacms_role',
        'RBAC_USER_TABLE'           =>'tacms_role_user',
		'RBAC_GROUP_USER_TABLE'     =>'tacms_group_user',
		'RBAC_GROUP_TABLE'          =>'tacms_group',
        'RBAC_ACCESS_TABLE'         =>'tacms_access',
        'RBAC_NODE_TABLE'           =>'tacms_node',


);
?>