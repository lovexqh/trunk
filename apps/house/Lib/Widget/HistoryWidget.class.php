<?php
class HistoryWidget extends Widget {
	public function render($data) {
		$home_history = stripcslashes($_COOKIE ["home_history"]);
		// 判断是否存在
		$data["homes"] = unserialize($home_history);
		$content =  $this->renderFile('History',$data);
		echo $content;
	}
	public function edit($data){
		return $this->renderFile('HistoryEdit',$arr);
	}
}
