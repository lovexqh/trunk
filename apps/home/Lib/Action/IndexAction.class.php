<?php
class IndexAction extends Action {
	public function index() {
		//找到首页模版，并显示
		$type=empty($_REQUEST["t"])?"Index":$_REQUEST["t"];
		$where['type']=$type;
		$layout = D("Layout")->where($where	)->find();
		$this->assign ( "lid", $layout['id'] );
		$this->display ( "@".$layout["filename"] );
	}
}
