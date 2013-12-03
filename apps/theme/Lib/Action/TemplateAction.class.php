<?php
class TemplateAction extends CommonAction {
public function index(){
// 	echo SITE_PATH . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "themes". DIRECTORY_SEPARATOR . 'theme.conf.php';
// 	dump(include SITE_PATH . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "themes". DIRECTORY_SEPARATOR . 'theme.conf.php');
	$this->display();
}
	public function delete() {
	}
	public function edit() {
		$this->display();
	}
	public function addwg() {
		$this->display();
	}

}
?>