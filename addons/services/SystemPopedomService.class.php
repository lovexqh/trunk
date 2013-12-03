<?php
/**
 * 系统权限服务
 * 
 * @author daniel <desheng.young@gmail.com>
 */
class SystemPopedomService extends Service {
	
	/**
	 * 检查给定用户是否拥有给定节点的权限
	 *
	 * @param int $uid
	 *        	用户ID(默认当前用户)
	 * @param string $node
	 *        	节点, 格式为"APP_NAME/MOD_NAME/ACT_NAME"(默认当前节点)
	 * @param bool $has_admin_popedom
	 *        	当没有设置admin节点权限时的是否默认拥有admin权限 ( true:有权限 false:没有权限 )
	 */
	public function hasPopedom($uid = null, $node = null, $has_admin_popedom = true) {
		global $ts;
		
		$uid = isset ( $uid ) ? intval ( $uid ) : $_SESSION ['mid'];
		
		// 超级管理员拥有所有权限
		if ($uid == $_SESSION ['mid'] && $_SESSION ['userInfo'] ['admin_level'] == '1')
			return true;
		
		$node = isset ( $node ) ? explode ( '/', $node ) : array (
				$ts ['_app'],
				$ts ['_mod'],
				$ts ['_act'] 
		);
		
		$gid = $this->getGidByNode ( $node );
		
		if (empty ( $gid )) {
			return $has_admin_popedom ? true : $app != 'admin';
		} else {
			$userGid = model ( 'UserGroup' )->getUserGroupId ( $uid );
			return count ( array_intersect ( $gid, $userGid ) ) > 0 ? true : false;
		}
	}
	
	/**
	 * 获取某个节点权限的用户组
	 *
	 * @param unknown_type $node
	 *        	节点
	 * @return unknown $gid 用户组ID
	 */
	public function getGidByNode($node) {
		if (($cache = F ( 'Cache_Node' )) === false) {
			$prefix = C ( 'DB_PREFIX' );
			$sql = "select  a.*,b.user_group_id from {$prefix}node a left join {$prefix}user_group_popedom b on  a.node_id = b.node_id";
			$cache = M ( '' )->query ( $sql );
			F ( 'Cache_Node', $cache );
		}
		$gid = array ();
		foreach ( $cache as $v ) {
			if (empty ( $v ['user_group_id'] ))
				continue;
			if ($v ['app_name'] == $node [0]) {
				if ($v ['mod_name'] == '*') {
					$gid [] = $v ['user_group_id'];
					continue;
				}
				if ($v ['mod_name'] == $node [1]) {
					if ($v ['act_name'] == $node [2] || $v ['act_name'] == '*')
						$gid [] = $v ['user_group_id'];
				}
			}
		}
		return $gid;
	}
	
	/**
	 * 清楚节点权限缓存
	 *
	 * @return unknown
	 */
	public function delNodeCache() {
		return F ( 'Cache_Node', null );
	}
	
	// 用于检测用户权限的方法,并保存到Session中
	function saveAccessList($authId = null) {
		if (null === $authId)
			$authId = $_SESSION [C ( 'USER_AUTH_KEY' )];
			// 如果使用普通权限模式，保存当前用户的访问权限列表
			// 对管理员开发所有权限
		if (C ( 'USER_AUTH_TYPE' ) != 2 && ! $_SESSION [C ( 'ADMIN_AUTH_KEY' )]) {
			$_SESSION ['_ACCESS_LIST'] = $this->getAccessList ( $authId );
		}
		return;
	}
	// 用于检测用户所拥有的站点,并保存到Session中
	function saveSiteList($authId = null) {
		if (null === $authId)
			$authId = $_SESSION [C ( 'USER_AUTH_KEY' )];
		$_SESSION ['_SITE_LIST'] = $this->getSiteList ( $authId );
		if (! empty ( $_SESSION ['_SITE_LIST'] )) {
			$_SESSION ['_CURRENT_SITE'] = $_SESSION ['_SITE_LIST'] [0];
		}
		return;
	}
	
	// 取得模块的所属记录访问权限列表 返回有权限的记录ID数组
	function getRecordAccessList($authId = null, $module = '') {
		if (null === $authId)
			$authId = $_SESSION [C ( 'USER_AUTH_KEY' )];
		if (empty ( $module ))
			$module = MODULE_NAME;
			// 获取权限访问列表
		$accessList = $this->getModuleAccessList ( $authId, $module );
		return $accessList;
	}
	
	// 检查当前操作是否需要认证
	function checkAccess() {
		// 如果项目要求认证，并且当前模块需要认证，则进行权限认证
		if (C ( 'USER_AUTH_ON' )) {
			$_module = array ();
			$_action = array ();
			if ("" != C ( 'REQUIRE_AUTH_MODULE' )) {
				// 需要认证的模块
				$_module ['yes'] = explode ( ',', strtoupper ( C ( 'REQUIRE_AUTH_MODULE' ) ) );
			} else {
				// 无需认证的模块
				$_module ['no'] = explode ( ',', strtoupper ( C ( 'NOT_AUTH_MODULE' ) ) );
			}
			// 检查当前模块是否需要认证
			if ((! empty ( $_module ['no'] ) && ! in_array ( strtoupper ( MODULE_NAME ), $_module ['no'] )) || (! empty ( $_module ['yes'] ) && in_array ( strtoupper ( MODULE_NAME ), $_module ['yes'] ))) {
				if ("" != C ( 'REQUIRE_AUTH_ACTION' )) {
					// 需要认证的操作
					$_action ['yes'] = explode ( ',', strtoupper ( C ( 'REQUIRE_AUTH_ACTION' ) ) );
				} else {
					// 无需认证的操作
					$_action ['no'] = explode ( ',', strtoupper ( C ( 'NOT_AUTH_ACTION' ) ) );
				}
				// 检查当前操作是否需要认证
				if ((! empty ( $_action ['no'] ) && ! in_array ( strtoupper ( ACTION_NAME ), $_action ['no'] )) || (! empty ( $_action ['yes'] ) && in_array ( strtoupper ( ACTION_NAME ), $_action ['yes'] ))) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		return false;
	}
	
	// 登录检查
	public function checkLogin() {
		// 检查当前操作是否需要认证
		if ($this->checkAccess ()) {
			// 检查认证识别号
			if (! $_SESSION [C ( 'USER_AUTH_KEY' )]) {
				if (C ( 'GUEST_AUTH_ON' )) {
					// 开启游客授权访问
					if (! isset ( $_SESSION ['_ACCESS_LIST'] ))
						// 保存游客权限
						$this->saveAccessList ( C ( 'GUEST_AUTH_ID' ) );
				} else {
					// 禁止游客访问跳转到认证网关
					redirect ( PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
				}
			}
		}
		return true;
	}
	
	// 权限认证的过滤器方法
	public function AccessDecision($appName = GROUP_NAME) {
		// 检查是否需要认证
		if ($this->checkAccess ()) {
			// 存在认证识别号，则进行进一步的访问决策
			$accessGuid = md5 ( $appName . MODULE_NAME . ACTION_NAME );
			if (empty ( $_SESSION [C ( 'ADMIN_AUTH_KEY' )] )) {
				if (C ( 'USER_AUTH_TYPE' ) == 2) {
					// 加强验证和即时验证模式 更加安全 后台权限修改可以即时生效
					// 通过数据库进行访问检查
					$accessList = $this->getAccessList ( $_SESSION [C ( 'USER_AUTH_KEY' )] );
				} else {
					// 如果是管理员或者当前操作已经认证过，无需再次认证
					if ($_SESSION [$accessGuid]) {
						return true;
					}
					// 登录验证模式，比较登录后保存的权限访问列表
					$accessList = $_SESSION ['_ACCESS_LIST'];
				}
				// 判断是否为组件化模式，如果是，验证其全模块名
				$module = defined ( 'P_MODULE_NAME' ) ? P_MODULE_NAME : MODULE_NAME;
				if (! isset ( $accessList [strtoupper ( $appName )] [strtoupper ( $module )] [strtoupper ( ACTION_NAME )] )) {
					$_SESSION [$accessGuid] = false;
					return false;
				} else {
					$_SESSION [$accessGuid] = true;
				}
			} else {
				// 管理员无需认证
				return true;
			}
		}
		
		return true;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 取得当前认证号的所有权限列表
	 * +----------------------------------------------------------
	 *
	 * @param integer $authId
	 *        	用户ID
	 *        	+----------------------------------------------------------
	 * @access public
	 *         +----------------------------------------------------------
	 */
	public function getSiteList($authId) {
		// Db方式权限数据
		$db = Db::getInstance ();
		$table = array (
				'group' => C ( 'RBAC_GROUP_TABLE' ),
				'group_user' => C ( 'RBAC_GROUP_USER_TABLE' ),
				'site' => C ( 'RBAC_SITE_TABLE' ) 
		);
		$sql = "select distinct(site.id), site.domain from " . $table ['group'] . " as groups," . $table ['site'] . " as site," . $table ['group_user'] . " as group_user " . "where group_user.user_id='{$authId}' and group_user.group_id=groups.id and site.id = groups.site_id and groups.status=1 and site.status=1";
		
		$siteList = $db->query ( $sql );
		foreach ( $siteList as $site ) {
			if (C ( 'ADMIN_SITE_KEY' ) == $site ['domain']) {
				$sql = "select distinct(site.id),site.domain from " . $table ['site'] . " as site " . "where site.status=1";
				$_SESSION [C ( 'ADMIN_SITE_KEY' )] = true;
				return $db->query ( $sql );
			}
		}
		return $siteList;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 取得当前认证号的menu
	 * +----------------------------------------------------------
	 *
	 * @param integer $authId
	 *        	用户ID
	 *        	+----------------------------------------------------------
	 * @access public
	 *         +----------------------------------------------------------
	 */
	public function getMenu($pid = 0) {
		if (empty ( $_SESSION [C ( 'ADMIN_AUTH_KEY' )] )) {
			$userwhere = "  AND user_id=" . $_SESSION [C ( 'USER_AUTH_KEY' )];
			// $menu = D ( "AccessView" )->having ( 'pid='.$pid.' AND name !=
			// "PUBLIC" AND site_id=' . $_SESSION ['_CURRENT_SITE'] [id] .
			// $userwhere )->order("sort")->select ();
			$menu = D ( "Access", "auth" )->getUserMenu ( $_SESSION [C ( 'USER_AUTH_KEY' )], $pid );
		} else {
			$menu = D ( "Node", "auth" )->where ( 'pid=' . $pid . ' AND name != "PUBLIC" AND status=1 AND ismenu=1' )->order ( "sort" )->select ();
		}
		if ($pid !== 0) {
			// 该节点是moudle节点，取得父节点信息，用以生成完整url信息
			$pnode = D ( "Node", "auth" )->where ( 'id=' . $pid )->find ();
			foreach ( $menu as $key=>$node ) {
				$menu[$key]["url"]=U($pnode["name"].'/'.$node["name"].'');
			}
		}
		
		return $menu;
	}
	// 读取模块所属的记录访问权限
	public function getModuleAccessList($authId, $module) {
		// Db方式
		$db = Db::getInstance ();
		$table = array (
				'role' => C ( 'RBAC_ROLE_TABLE' ),
				'user' => C ( 'RBAC_USER_TABLE' ),
				'access' => C ( 'RBAC_ACCESS_TABLE' ) 
		);
		$sql = "select access.node_id from " . $table ['role'] . " as role," . $table ['user'] . " as user," . $table ['access'] . " as access " . "where user.user_id='{$authId}' and user.role_id=role.id and access.role_id=role.id and role.status=1 and  access.module='{$module}' and access.status=1";
		$rs = $db->query ( $sql );
		$access = array ();
		foreach ( $rs as $node ) {
			$access [] = $node ['node_id'];
		}
		return $access;
	}
	/**
	 * +----------------------------------------------------------
	 * 取得当前认证号的所有权限列表
	 * +----------------------------------------------------------
	 *
	 * @param integer $authId
	 *        	用户ID
	 *        	+----------------------------------------------------------
	 * @access public
	 *         +----------------------------------------------------------
	 */
	public function getAccessList($authId) {
		// Db方式权限数据
		// $siteid = $_SESSION ['_CURRENT_SITE'] ['id'];
		$userid = $_SESSION [C ( 'USER_AUTH_KEY' )];
		$userAccess = D ( "Access", "auth" )->getUserAccess ( $userid );
		$group = D ( "GroupUserView", "auth" )->getGroupByUser ( $authId );
		$groupAccess = D ( "Access", "auth" )->getGroupAccess ( $group ["gid"] );
		$nodeList = array ();
		foreach ( $userAccess as $us ) {
			if (! in_array ( $us, $groupAccess ))
				$nodeList [] = $us;
		}
		$nodeList += $groupAccess;
		// $access = array ();
		$globalPublicAction = array ();
		// 先取出globalpublicaction
		foreach ( $nodeList as $gk => $gnode ) {
			// 如果是公共分组
			if ("PUBLIC" == strtoupper ( $gnode ['name'] ) && $gnode ['pid'] == 0) {
				unset ( $nodeList [$gk] );
				foreach ( $nodeList as $pk => $pnode ) {
					if ($pnode ['pid'] == $gnode ['id']) {
						$globalPublicAction [$pnode ['name']] = $pnode ['id'];
						unset ( $nodeList [$pk] );
					}
				}
			}
		}
		// $i=0;
		foreach ( $nodeList as $gk => $gnode ) {
			if ($gnode ['pid'] == 0) {
				unset ( $nodeList [$gk] );
				foreach ( $nodeList as $mk => $mnode ) {
					if ($mnode ['pid'] == $gnode ['id']) {
						unset ( $nodeList [$mk] );
						$action = array ();
						foreach ( $nodeList as $ak => $anode ) {
							if ($anode ['pid'] == $mnode ['id']) {
								unset ( $nodeList [$ak] );
								$action [$anode ['name']] = $anode ['id'];
							}
						}
						$action += $globalPublicAction;
						$access [strtoupper ( $gnode ['name'] )] [strtoupper ( $mnode ['name'] )] = array_change_key_case ( $action, CASE_UPPER );
						;
					}
				}
			}
		}
		return $access;
	}
	public function run() {
	}
	public function _start() {
	}
	public function _stop() {
	}
	public function _install() {
	}
	public function _uninstall() {
	}
}