<?php
class HomeHistoryAction extends CommonAction {
	public function _before_add() {
		$id = $_SESSION [C ( 'USER_AUTH_KEY' )];
		$data = M ( 'User' )->where ( array (
				'id' => $id
		) )->getField ( 'realname' );
		$vo['username'] = $data;
		$vo['userid'] = $id;
		$vo['homeid'] = $_REQUEST ['homeid'] ;
		$this->assign ( "vo", $vo );
	}
	public function _before_edit() {
	}
	function _filter(&$map) {
		$map ['homeid'] = $_REQUEST ['homeid'];
		$this->assign ( "homeid", $_REQUEST ['homeid'] );
	}
}
?>