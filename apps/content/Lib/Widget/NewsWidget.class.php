<?php
class NewsWidget extends Widget {
	public function render($data) {
		 $map["id"] = $data["postid"];
		$category = M ( "category" )->where($map)->select ();
		// $modelid = $category["modelid"];
		// 暂时是文章模型
		$modelid = 1;
		$tname = D ( "model" )->where ( "id=" . $modelid )->find ();
		$postlist = D ( $tname ["tablename"] )->where('catid='.$data["postid"])->limit (5)->select ();
		//
		// $dataarr = array();
		foreach ( $postlist as $key => $val ) {
			$postlist [$key] ["url"] = "?t=content&id=".$val["id"];
			$postlist [$key] ["createtime"] = toDate($val["createtime"],'Y-m-d');
		}
		$data ['postlist'] = $postlist ;
		$data ['more'] = "?t=category";
		return $this->renderFile ( 'News', $data );
	}
	public function edit($data) {
		// $arr["volist"] =
		// D("category")->where("site_id=".$_SESSION['_CURRENT_SITE']["id"])->select();
        $data ["style"] = array (
                "blue" => "蓝色",
                "red" => "红色"
        );
        $map["status"]=1;
        $data ["cate"] =D("Category")->where($map)->select();
		return $this->renderFile ( 'NewsEdit', $data );
	}
}
