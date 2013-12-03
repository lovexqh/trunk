<?php
class NewsDetailWidget extends Widget {
	public function render($data) {
		$data["content"] = D("News")->find($_REQUEST['id'] );
		return $this->renderFile ( 'NewsDetail', $data );
	}
	public function edit($data) {
		return $this->renderFile ( 'NewsDetailEdit', $data );
	}
}
