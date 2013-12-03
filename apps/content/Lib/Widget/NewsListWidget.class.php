<?php
class NewsListWidget extends Widget {
	public function render($data) {
		$cat = M ( "Category" )->find ( $_REQUEST["category"] );
		$model ["tablename"] = "News";
		$count = M ( $model ["tablename"] )->where ()->count ();
		$p = new Page ( $count, 10 );
		$page = $p->show ();
		$contentList = M ( $model ["tablename"] )->where ()->order ( 'createtime desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		foreach ($contentList as $key => $content){
			$contentList[$key]["url"] = "?t=content&id=".$content["id"];
		}
		$data["page"] = $page;
		$data["contentList"] = $contentList;
		return $this->renderFile ( 'NewsList', $data );
	}
	public function edit($data) {
		return $this->renderFile ( 'NewsListEdit', $data );
	}
}
