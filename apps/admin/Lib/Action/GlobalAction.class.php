<?php
class GlobalAction extends AdministratorAction {
	private function __isValidRequest($field, $array = 'post') {
		$field = is_array ( $field ) ? $field : explode ( ',', $field );
		$array = $array == 'post' ? $_POST : $_GET;
		foreach ( $field as $v ) {
			$v = trim ( $v );
			if (! isset ( $array [$v] ) || $array [$v] == '')
				return false;
		}
		return true;
	}
	
	/**
	 * 系统配置 - 站点配置 *
	 */
	
	// 站点设置
	public function index() {
		$site_opt = model ( 'Xdata' )->lget ( 'siteopt' );
		if (! $site_opt ['site_logo']) {
			$site_opt ['site_logo'] = 'logo.png';
			$this->assign ( 'site_logo', THEME_URL . '/images/' . $site_opt ['site_logo'] );
		}
		$this->assign ( $site_opt );
		$this->display ();
	}
	
	// 设置站点
	public function doSetSiteOpt() {
		if (empty ( $_POST )) {
			$this->error ( '参数错误' );
		}
		
		$_POST ['site_name'] = t ( $_POST ['site_name'] );
		$_POST ['site_header_title'] = t ( $_POST ['site_header_title'] );
		$_POST ['site_header_keywords'] = t ( $_POST ['site_header_keywords'] );
		$_POST ['site_header_description'] = t ( $_POST ['site_header_description'] );
		$_POST ['site_icp'] = t ( $_POST ['site_icp'] );
		
		$res = model ( 'Xdata' )->lput ( 'siteopt', $_POST );
	}
}
