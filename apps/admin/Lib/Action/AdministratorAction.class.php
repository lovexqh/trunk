<?php
class AdministratorAction extends CommonAction {
	
	public function _initialize()
	{
		// $this->success(); 和 $this->error();通过isAdmin变量决定是否加载头部
		// // 用户权限检查
		// 检查用户是否登录管理后台, 有效期为$_SESSION的有效期
		if (! service ( 'Passport' )->isLoggedAdmin ())
		redirect( U('admin/Public/adminlogin') );
		
		if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
			if (!service('SystemPopedom')->AccessDecision()) {
				$this->assign('jumpUrl', U('admin/Public/adminlogin'));
// 				//检查认证识别号

// 				if (!$_SESSION [C('USER_AUTH_KEY')]) {
// 					//跳转到认证网关
// 					redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
// 				}
// 				// 没有权限 抛出错误
// 				if (C('RBAC_ERROR_PAGE')) {
// 					// 定义权限错误页面
// 					redirect(C('RBAC_ERROR_PAGE'));
// 				} else {
// 					if (C('GUEST_AUTH_ON')) {
// 						$this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
// 					}
// 					// 提示错误信息
// 					$this->error(L('_VALID_ACCESS_'));
// 				}
			}
		}

// 		// 如果是应用的后台，检查用户是否具有节点权限
// 		if (APP_NAME != 'admin' && ! service('SystemPopedom')->hasPopedom($this->mid, 'admin/Apps/*', false)) {
// 			$this->assign('jumpUrl', U('home/Public/adminlogin'));
// 			$this->error('您无权限查看');
// 		}
	}
	
	protected function _getSearchMap($fields)
	{
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		if (!empty($_POST)) {
			$_SESSION['admin_search_attach'] = serialize($_POST);
		} else if (isset($_GET[C('VAR_PAGE')])) {
			$_POST = unserialize($_SESSION['admin_search_attach']);
		} else {
			unset($_SESSION['admin_search_attach']);
		}
		
		// 组装查询条件
		$map = array();
		foreach ($fields as $k => $v) {
			foreach ($v as $field) {
				if (isset($_POST[$field]) && $_POST[$field] != '') {
					if($k == 'in')
						$map[$field] = array($k, explode(',', $_POST[$field]));
					else
						$map[$field] = array($k, $_POST[$field]);					
				}
			}
		}
		
		return $map;
	}
}