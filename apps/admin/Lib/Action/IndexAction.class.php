<?php
class IndexAction extends AdministratorAction {
	// 后台框架页
	public function index() {
		// $this->assign('channel', $this->_getChannel());
		// $this->assign('menu', $this->_getMenu());
		$menu = X ( 'SystemPopedom' )->getMenu ();
		$this->assign ( 'menu', json_encode ( $menu ) );
		$this->display ();
	}
	public function getMenu() {
		$menu = X ( 'SystemPopedom' )->getMenu ( $_REQUEST ['id'] );
		echo json_encode ( $menu );
	}
}
