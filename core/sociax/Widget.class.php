<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 * +------------------------------------------------------------------------------
 * ThinkPHP Widget类 抽象类
 * +------------------------------------------------------------------------------
 *
 * @category Think
 * @package Think
 * @subpackage Util
 * @author liu21st <liu21st@gmail.com>
 * @version $Id$
 *         
 *         
 *         
 *         
 *         
 *         
 *         
 *         
 *          +------------------------------------------------------------------------------
 */
abstract class Widget extends Think {
	// 使用的模板引擎 每个Widget可以单独配置不受系统影响
	protected $template =  '';
	private static $allWidgets = array ();
	/**
	 * +----------------------------------------------------------
	 * 渲染输出 render方法是Widget唯一的接口
	 * 使用字符串返回 不能有任何输出
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param mixed $data
	 *        	要渲染的数据
	 *        	+----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 */
	static public function getWidgets()
	{
		return self::$allWidgets;
	}
	abstract public function render($data);
	
	/**
	 * +----------------------------------------------------------
	 * 渲染模板输出 供render方法内部调用
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param string $templateFile
	 *        	模板文件
	 * @param mixed $var
	 *        	模板变量
	 * @param string $charset
	 *        	模板编码
	 *        	+----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 */
	protected function renderFile($templateFile = '', $var = '', $charset = 'utf-8') {
		$var ['ts'] = $GLOBALS ['ts'];
		ob_start ();
		ob_implicit_flush ( 0 );
		$name = substr ( get_class ( $this ), 0, - 6 );
		$filename = empty ( $templateFile ) ? $name : $templateFile;
		$templateFile = self::$allWidgets [$name] ["path"].'/'.$name. '/' . $filename . C ( 'TMPL_TEMPLATE_SUFFIX' );
		$var['uri'] = self::$allWidgets [$name]['uri'];
		if (! file_exists_case ( $templateFile ))
			throw_exception ( L ( '_TEMPLATE_NOT_EXIST_' ) . '[' . $templateFile . ']' );
		$template = $this->template ? $this->template : strtolower ( C ( 'TMPL_ENGINE_TYPE' ) ? C ( 'TMPL_ENGINE_TYPE' ) : 'php' );
		if ('php' == $template) {
			// 使用PHP模板
			if (! empty ( $var ))
				extract ( $var, EXTR_OVERWRITE );
				// 直接载入PHP模板
			include $templateFile;
		} else {
			$className = 'Template' . ucwords ( $template );
			require_cache ( THINK_PATH . '/Util/Template/' . $className . '.class.php' );
			$tpl = new $className ();
			$tpl->fetch ( $templateFile, $var, $charset );
		}
		$content = ob_get_clean ();
		//编辑widget时需要添加修改标识；
		if(APP_NAME=="theme"){
			$content = "<div id=".$var['id']." class='witem'>".$content."</div>";
		}
		return $content;
	}
	final static public function loadAllWidgets() {
		self::$allWidgets = F ( 'allwidgets' );
		if (false === self::$allWidgets) {
			self::resetCache ();
		}
	}
	final static private function resetCache() {
		$apps = model ( 'App' )->getAllApp ( 'app_name' );
		$apps = getSubByKey ( $apps, 'app_name' );
		$apps = array_merge ( $apps, C ( 'DEFAULT_APPS' ) );
		
		// array("name"=>"path");
		require_once SITE_PATH . '/addons/libs/Io/Dir.class.php';
		require_once SITE_PATH . '/addons/libs/String.class.php';
		foreach ( $apps as $app ) {
			if (is_dir ( SITE_PATH . '/apps/' . $app . '/Lib/Widget' )) {
				$dirs = new Dir ( SITE_PATH . '/apps/' . $app . '/Lib/Widget' );
				$dirs = $dirs->toArray ();
				foreach ( $dirs as $dir ) {
					if (String::endsWith ( $dir ['filename'], '.class.php' )) {
						$widgetName = substr ( $dir ['filename'], 0, - 16 );
						self::$allWidgets [$widgetName]['filename']= $dir ['filename'];
						self::$allWidgets [$widgetName]['pathname']= $dir ['pathname'];
						self::$allWidgets [$widgetName]['path']= $dir ['path'];
						self::$allWidgets [$widgetName]['uri']= SITE_URL. '/apps/' . $app . '/Lib/Widget/'.$widgetName;
					}
				}
			}
		}
		F ( 'allwidgets', self::$allWidgets );
	}
	final static public function renderAll($widgets) {
		foreach ( $widgets as $widget ) {
			self::renderOne($widget);
		}
	}
	final static public function toedit($widget) {
		
			$class = $widget ["name"] . "Widget";
			require_cache ( self::$allWidgets [$widget ["name"]]['pathname'] );
			if (! class_exists ( $class ))
				throw_exception ( L ( '_CLASS_NOT_EXIST_' ) . ':' . $class );
			$_widget = Think::instance ( $class );
			$data = unserialize($widget ["param"] );
			$data['id'] = $widget ["id"] ;
			$content = $_widget->edit ( $data);
			echo $content;
	}
	final  static  public function renderOne($widget,$output=true){
		$class = $widget ["name"] . "Widget";
		require_cache ( self::$allWidgets [$widget ["name"]]['pathname'] );
		if (! class_exists ( $class ))
			throw_exception ( L ( '_CLASS_NOT_EXIST_' ) . ':' . $class );
		$_widget = Think::instance ( $class );
		$data = unserialize($widget ["param"] );
		$data['id'] = $widget ["id"] ;
		$content = $_widget->render ($data);
		if($output){
			echo $content;
		}else{
			return $content;
		}
	}
}
?>