<?php
class LayoutAction extends CommonAction {
	/**
	 * 可视化编辑
	 */
	public function editLayout() {
		$lwhere ['id'] = $_GET ["id"];
		$layout = D ( "Layout" )->where ( $lwhere )->find ();
		$bwhere ['lid'] = $_GET ["id"];
		$blocks = D("Block")->where($bwhere)->select();
		$this->assign ( "lid", $_GET ["id"] );
		$this->assign ( "blocks", json_encode($blocks));
		$this->assign ( "modify", "1" );
		$this->display ( "@" . $layout ["filename"] );
	}
	
	/**
	 * 在可视化编辑布局中添加widget
	 */
	public function addWidget() {
		$widget ["param"] = json_decode( $_REQUEST ["param"],true);
		$widget ["param"]  = serialize($widget ["param"]);
		if(empty($_REQUEST['id'])){
			$widget ["bid"] = $_REQUEST ["bid"];
			$widget ["name"] = $_REQUEST ["name"];
			$widget ["sort"] =D ( "Widget" )->where('bid='.$widget ["bid"])->max("sort")+1;
// 			$widget ["sort"] +=1;
			$widget['id'] = D ( "Widget" )->data ( $widget )->add ();
		} else {
			$wid = $_REQUEST['id'];
			D ( "Widget" )->where('id='.$_REQUEST['id'])->data ( $widget )->save ();
			$widget = D ( "Widget" )->find($wid);
		}
		$content = Widget::renderOne ( $widget ,false);
		echo $this->view->templateContentReplace($content);;
		// $this->redirect ( "/Layout/edit/id/" . $data ["layoutid"] );
	}
	/**
	 * 修改widget，返回编辑页面
	 */
	public function toEditWidget() {
		$wc ["id"] = $_REQUEST ["id"];
		$widget = M ( "Widget" )->where ( $wc )->find ();
		$content = Widget::toedit ( $widget );
		echo $content;
	}
	/**
	 * 返回widget列表
	 */
	public function listWidget() {
		$allWidgets = Widget::getWidgets ();
		exit ( json_encode ( array_keys ( $allWidgets ) ) );
	}
	/**
	 * 添加widget，返回编辑页面
	 */
	public function toAddWidget() {
		$widget ['name'] = $_REQUEST ["wname"];
		$content .= Widget::toedit ( $widget );
		$content .= "<input type='hidden' id='position' value='" . $_REQUEST ["position"] . "'>";
		$content .= "<input type='hidden' id='wname' value='" . $_REQUEST ["wname"] . "'>";
		echo $content;
	}
	/**
	 * 删除当前布局微件
	 */
	public function delWidget() {
		$wc ["id"] = $_REQUEST ["id"];
		M ( "Widget" )->where ( $wc )->delete ();
		exit ( json_encode () );
	}
	/**
	 * 生成缩略图
	 */
	public function getThumBnail() {
		import ( "@.common.Thumbnail" );
		$layoutid = $_REQUEST ["layoutid"];
		$siteLayout = M ( "Site_layout" )->where ( "id=" . $layoutid )->find ();
		$site = M ( "Site" )->where ( "id=" . $siteLayout ["siteid"] )->find ();
		$domain = $site ["domain"];
		$url = $domain . "/tacms/index.php?=/Index/";
		$fileName = "";
		Thumbnail::snapshot ( $url, $layoutid . ".jpg" );
	}
}
?>