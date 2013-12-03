<?php
class MenuAction extends CommonAction {
	public function index() {
		$treeList = getChildTree ($this->getActionName());
		$this->assign ( 'list', $treeList );
		$this->display ();
	}
	public function _before_add() {
		$this->assign ( "pid", $_GET ['pid'] );
	}
}
