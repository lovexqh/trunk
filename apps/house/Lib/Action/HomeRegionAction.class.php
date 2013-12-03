<?php
class HomeRegionAction extends CommonAction {
	public function index() {
		$this->assign ( 'list', getChildTree ( $this->getActionName () ) );
		Cookie::set ( '_currentUrl_', __SELF__ );
		$this->display ();
	}
	public function _before_add() {
		$vo ["pid"] = $_REQUEST ['pid'];
		$this->assign ( 'vo', $vo );
		$this->_before_edit ();
	}
	public function _before_edit() {
		$this->assign ( 'hrList', getChildTree ( $this->getActionName () ) );
	}
	public function getHomeRegion() {
		$id = $_REQUEST ["id"];
		$vo = D ( "HomeRegion" )->getById ( $id );
		exit ( json_encode ( $vo ) );
	}
}
?>