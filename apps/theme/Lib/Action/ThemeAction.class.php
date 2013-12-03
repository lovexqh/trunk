<?php
class ThemeAction extends CommonAction {
	public function index() {
		$themes = array ();
		$_theme = model ( 'Xdata' )->get ( 'siteopt:site_theme' );
		$parentPath = SITE_PATH . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "themes";
		$dir = dir ( $parentPath );
		while ( false !== $entry = $dir->read () ) {
			if ($entry != '.' && $entry != '..' && $entry != ".svn") {
				$theme = $this->extheme ( $parentPath . DIRECTORY_SEPARATOR . $entry );
				$theme ['default'] = 0;
				$theme['thumb']=WEB_PUBLIC_PATH."/themes/".$entry."/thumb.jpg";
				if ($theme ['name'] == $_theme) {
					$theme ['default'] = 1;
				}
				$themes[] = $theme;
			}
		}
		$this->assign("list",$themes);
		$this->display();
		// echo "111".__THEME__;
	}
	private function extheme($path) {
		$theme = include $path . DIRECTORY_SEPARATOR . 'theme.conf.php';
		return $theme;
	}
	/**
	 * 导入主题
	 */
	public function import() {
		// 导入布局文件(包括布局，css，js)
	}
	/**
	 * 应用系统管理员创建的主题
	 */
	public function apply() {
		// 在主题里插入数据
		$theme = $_REQUEST ["tname"];
		model ( 'Xdata' )->save ( 'siteopt:site_theme', $theme );
		$this->redirect("theme/Theme/index") ;
	}
	/**
	 * 查看该主题下的布局
	 */
	public function listLayout() {
		// $layout = $this->getChildTree("site_layout");
		// $where['status'] = 1;
		$where ['themeid'] = $_GET ['themeid'];
		$where ['layoutStatus'] = 1;
		$where ['themeStatus'] = 1;
		$layout = D ( "LayoutView" )->where ( $where )->select ();
		$this->assign ( "list", $layout );
		$this->display ();
	}
	/**
	 * 可视化编辑布局
	 */
	public function editLayout() {
		$layoutid = $_GET ["id"];
		$where ['id'] = $layoutid;
		$layout = D ( "LayoutView" )->where ( $where )->find ();
		$this->assign ( "layoutid", $layoutid );
		$this->assign ( "modify", "1" );
		$this->display ( $layout ["themePath"] . "@Index::" . $layout ["filename"] );
	}
	/**
	 * Í
	 * 编辑主题
	 */
	public function edit() {
		$themeId = $_REQUEST ["id"];
		$this->redirect ( "/Layout/index", array (
				"themeId" => $themeId 
		) );
	}
	/**
	 * 发布主题（是其他用户可见）
	 * 需要系统主题管理的权限
	 */
	public function publish() {
	}
/**
 * 导出主题
 */

/**
 * 选择/改变主题
 */
}
?>