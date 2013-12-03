<?php
class CommonAction extends Action {
	protected	$site;
	public function __construct() {
		$this->initSite ();
		parent::__construct ();
	}
	public function index() {
		// 列表过滤器，生成查询Map对象
		$map = $this->_search ();
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name = $this->getActionName ();
		$model = D ( $name );
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 取得操作成功后要返回的URL地址
	 * 默认返回当前模块的默认操作
	 * 可以在action控制器中重载
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 * @throws ThinkExecption
	 *         +----------------------------------------------------------
	 */
	function getReturnUrl() {
		return __URL__ . '?' . C ( 'VAR_MODULE' ) . '=' . MODULE_NAME . '&' . C ( 'VAR_ACTION' ) . '=' . C ( 'DEFAULT_ACTION' );
	}
	
	/**
	 * +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * +----------------------------------------------------------
	 *
	 * @access protected
	 *         +----------------------------------------------------------
	 * @param string $name
	 *        	数据对象名称
	 *        	+----------------------------------------------------------
	 * @return HashMap
	 *         +----------------------------------------------------------
	 * @throws ThinkExecption
	 *         +----------------------------------------------------------
	 */
	protected function _search($name = '') {
		// 生成查询条件
		if (empty ( $name )) {
			$name = $this->getActionName ();
		}
		$name = $this->getActionName ();
		$model = D ( $name );
		$map = array ();
		foreach ( $model->getDbFields () as $key => $val ) {
			if (isset ( $_REQUEST [$val] ) && $_REQUEST [$val] != '') {
				$map [$val] = $_REQUEST [$val];
			}
		}
		return $map;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * +----------------------------------------------------------
	 *
	 * @access protected
	 *         +----------------------------------------------------------
	 * @param Model $model
	 *        	数据对象
	 * @param HashMap $map
	 *        	过滤条件
	 * @param string $sortBy
	 *        	排序
	 * @param boolean $asc
	 *        	是否正序
	 *        	+----------------------------------------------------------
	 * @return void +----------------------------------------------------------
	 * @throws ThinkExecption
	 *         +----------------------------------------------------------
	 */
	protected function _list($model, $map, $sortBy = '', $asc = false) {
		// 排序字段 默认为主键名
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		} else {
			$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
		}
		// 排序方式默认按照倒序排列
		// 接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		// 取得满足条件的记录数
		$count = $model->where ( $map )->count ( 'id' );
		if ($count > 0) {
			import ( "@.ORG.Page" );
			// 创建分页对象
			if (! empty ( $_REQUEST ['listRows'] )) {
				$listRows = $_REQUEST ['listRows'];
			} else {
				$listRows = '';
			}
			$p = new Page ( $count, $listRows, 1 );
			// 分页查询数据
			
			$voList = $model->where ( $map )->order ( "`" . $order . "` " . $sort )->limit ( $p->firstRow . ',' . $p->listRows )->findAll ();
			// echo $model->getlastsql();
			// 分页跳转的时候保证查询条件
			foreach ( $map as $key => $val ) {
				if (! is_array ( $val )) {
					$p->parameter .= "$key=" . urlencode ( $val ) . "&";
				} else {
					$p->parameter .= "$key=" . urlencode ( $val [1] ) . "&";
				}
			}
			// 分页显示
			$page = $p->show ();
			// 列表排序显示
			$sortImg = $sort; // 排序图标
			$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; // 排序提示
			$sort = $sort == 'desc' ? 1 : 0; // 排序方式
			                                 // 模板赋值显示
			$this->assign ( 'list', $voList );
			$this->assign ( 'sort', $sort );
			$this->assign ( 'order', $order );
			$this->assign ( 'sortImg', $sortImg );
			$this->assign ( 'sortType', $sortAlt );
			$this->assign ( "page", $page );
		}
		return;
	}
	function insert() {
		$name = $this->getActionName ();
		$model = D ( $name );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		// 保存当前数据对象
		$list = $model->add ();
		if ($list !== false) { // 保存成功
			$this->assign ( 'jumpUrl', __URL__ );
			$this->success ( '新增成功!' );
		} else {
			// 失败提示
			$this->error ( '新增失败!' );
		}
	}
	public function add() {
		$this->display ( "edit" );
	}
	function read() {
		$this->edit ();
	}
	function edit() {
		$name = $this->getActionName ();
		$model = M ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	function update() {
		// B('FilterString');
		$name = $this->getActionName ();
		$model = D ( $name );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		if (empty ( $_REQUEST [$model->getPk ()] )) {
			// 保存当前数据对象
			$list = $model->add ();
		} else {
			// 更新数据
			$list = $model->save ();
		}
		if (false !== $list) {
			// 成功提示
			$this->assign ( 'jumpUrl', __URL__ );
			$this->success ( '编辑成功!' );
		} else {
			// 错误提示
			$this->error ( '编辑失败!' );
		}
	}
	function saveOrUpdate() {
		// B('FilterString');
		$name = $this->getActionName ();
		$model = D ( $name );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		if (!empty ( $_REQUEST [$model->getPk ()] )) {
			// 更新数据
			$list = $model->save ();
		} else {
			// 保存当前数据对象
			$list = $model->add ();
		}
		if (false !== $list) {
			// 成功提示
			$this->assign ( 'jumpUrl', __URL__ );
			$this->success ( '编辑成功!' );
		} else {
			// 错误提示
			$this->error ( '编辑失败!' );
		}
	}
	/**
	 * +----------------------------------------------------------
	 * 默认删除操作
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 * @throws ThinkExecption
	 *         +----------------------------------------------------------
	 */
	public function delete() {
		// 删除指定记录
		$name = $this->getActionName ();
		$model = M ( $name );
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array (
						$pk => array (
								'in',
								explode ( ',', $id ) 
						) 
				);
				$list = $model->where ( $condition )->setField ( 'status', - 1 );
				if ($list !== false) {
					$this->success ( '删除成功！' );
				} else {
					$this->error ( '删除失败！' );
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	public function foreverdelete() {
		// 删除指定记录
		$name = $this->getActionName ();
		$model = D ( $name );
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array (
						$pk => array (
								'in',
								explode ( ',', $id ) 
						) 
				);
				if (false !== $model->where ( $condition )->delete ()) {
					// echo $model->getlastsql();
					$this->success ( '删除成功！' );
				} else {
					$this->error ( '删除失败！' );
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
		// $this->forward();
	}
	public function clear() {
		// 删除指定记录
		$name = $this->getActionName ();
		$model = D ( $name );
		if (! empty ( $model )) {
			if (false !== $model->where ( 'status=1' )->delete ()) {
				$this->assign ( "jumpUrl", $this->getReturnUrl () );
				$this->success ( L ( '_DELETE_SUCCESS_' ) );
			} else {
				$this->error ( L ( '_DELETE_FAIL_' ) );
			}
		}
		$this->forward ();
	}
	
	/**
	 * +----------------------------------------------------------
	 * 默认禁用操作
	 *
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 * @throws FcsException
	 *         +----------------------------------------------------------
	 */
	public function forbid() {
		$name = $this->getActionName ();
		$model = D ( $name );
		$pk = $model->getPk ();
		$id = $_REQUEST [$pk];
		$condition = array (
				$pk => array (
						'in',
						$id 
				) 
		);
		$list = $model->forbid ( $condition );
		if ($list !== false) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态禁用成功' );
		} else {
			$this->error ( '状态禁用失败！' );
		}
	}
	public function checkPass() {
		$name = $this->getActionName ();
		$model = D ( $name );
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array (
				$pk => array (
						'in',
						$id 
				) 
		);
		if (false !== $model->checkPass ( $condition )) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态批准成功！' );
		} else {
			$this->error ( '状态批准失败！' );
		}
	}
	public function recycle() {
		$name = $this->getActionName ();
		$model = D ( $name );
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array (
				$pk => array (
						'in',
						$id 
				) 
		);
		if (false !== $model->recycle ( $condition )) {
			
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态还原成功！' );
		} else {
			$this->error ( '状态还原失败！' );
		}
	}
	public function recycleBin() {
		$map = $this->_search ();
		$map ['status'] = - 1;
		$name = $this->getActionName ();
		$model = D ( $name );
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
	}
	
	/**
	 * +----------------------------------------------------------
	 * 默认恢复操作
	 *
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string
	 *         +----------------------------------------------------------
	 * @throws FcsException
	 *         +----------------------------------------------------------
	 */
	function resume() {
		// 恢复指定记录
		$name = $this->getActionName ();
		$model = D ( $name );
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array (
				$pk => array (
						'in',
						$id 
				) 
		);
		if (false !== $model->resume ( $condition )) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态恢复成功！' );
		} else {
			$this->error ( '状态恢复失败！' );
		}
	}
	function saveSort() {
		$seqNoList = $_POST ['seqNoList'];
		if (! empty ( $seqNoList )) {
			// 更新数据对象
			$name = $this->getActionName ();
			$model = D ( $name );
			$col = explode ( ',', $seqNoList );
			// 启动事务
			$model->startTrans ();
			foreach ( $col as $val ) {
				$val = explode ( ':', $val );
				$model->id = $val [0];
				$model->sort = $val [1];
				$result = $model->save ();
				if (! $result) {
					break;
				}
			}
			// 提交事务
			$model->commit ();
			if ($result !== false) {
				// 采用普通方式跳转刷新页面
				$this->success ( '更新成功' );
			} else {
				$this->error ( $model->getError () );
			}
		}
	}
	
	// 文件上传
	protected function _upload() {
		require_cache ( SITE_PATH . "/addons/libs/UploadFile.class.php" );
		require_cache ( SITE_PATH . "/addons/libs/Image.class.php" );
		// 导入上传类
		$upload = new UploadFile ();
		// 设置上传文件大小
		$upload->maxSize = 3292200;
		// 设置上传文件类型
		$upload->allowExts = explode ( ',', 'jpg,gif,png,jpeg' );
		// 设置附件上传目录
		$upload->savePath = 'Tpl/Uploads/';
		// 设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		// 设置引用图片类库包路径
		$upload->imageClassPath = 'ORG.Util.Image';
		// 设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = 'm_,s_'; // 生产2张缩略图
		                                // 设置缩略图最大宽度
		$upload->thumbMaxWidth = '900,142';
		// 设置缩略图最大高度
		$upload->thumbMaxHeight = '500,105';
		// 设置上传文件规则
		$upload->saveRule = uniqid;
		// 删除原图
		$upload->thumbRemoveOrigin = true;
		if (! $upload->upload ()) {
			// 捕获上传异常
			$this->error ( $upload->getErrorMsg () );
		} else {
			// 取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo ();
			
			// 给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
			return $uploadList;
		}
	}
	public function uploadImg() {
		$uploads = $this->_upload ();
		// if(!empty($thumb))$thumb = $thumb.C("SEPARATE");
		// $data["thumb"] = $thumb.$uploads [0] ['savename'];
		$state = "SUCCESS";
		// $list = $home->where('id='.$_REQUEST ["id"])->save ($data);
		echo "{'url':'" . $uploads [0] ['savename'] . "','title':'" . $_POST ['pictitle'] . "','state':'" . $state . "'}";
	}
	protected function initSite() {
		$this->site = $GLOBALS ['ts'] ['site'];
	}   /**
     +----------------------------------------------------------
     * 操作错误跳转的快捷方法
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $message 错误信息
     * @param Boolean $ajax 是否为Ajax方式
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    protected function error($message,$ajax=false)
    {
        $this->_dispatch_jump($message,0,$ajax);
    }

    /**
     +----------------------------------------------------------
     * 操作成功跳转的快捷方法
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $message 提示信息
     * @param Boolean $ajax 是否为Ajax方式
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    protected function success($message,$ajax=false)
    {
        $this->_dispatch_jump($message,1,$ajax);
    }
	
	/**
	 * +----------------------------------------------------------
	 * 默认跳转操作 支持错误导向和正确跳转
	 * 调用模板显示 默认为public目录下面的success页面
	 * 提示页面为可配置 支持模板标签
	 * +----------------------------------------------------------
	 * 
	 * @param string $message
	 *        	提示信息
	 * @param Boolean $status
	 *        	状态
	 * @param Boolean $ajax
	 *        	是否为Ajax方式
	 *        	+----------------------------------------------------------
	 * @access private
	 *         +----------------------------------------------------------
	 * @return void +----------------------------------------------------------
	 */
	private function _dispatch_jump($message, $status = 1, $ajax = false) {
		
		// 判断是否为AJAX返回
		if ($ajax || $this->isAjax ())
			$this->ajaxReturn ( '', $message, $status );
			// 提示标题
		$this->assign ( 'msgTitle', $status ? L ( '_OPERATION_SUCCESS_' ) : L ( '_OPERATION_FAIL_' ) );
		// 如果设置了关闭窗口，则提示完毕后自动关闭窗口
		if ($this->view->get('closeWin'))
			$this->assign ( 'jumpUrl', 'javascript:window.close();' );
		$this->assign ( 'status', $status ); // 状态
		$this->assign ( 'message', $message ); // 提示信息
		                                   // 保证输出不受静态缓存影响
		C ( 'HTML_CACHE_ON', false );
		if ($status) { // 发送成功信息
		              // 成功操作后默认停留1秒
			if (! $this->view->get ( 'waitSecond' ))
				$this->assign ( 'waitSecond', "1" );
				// 默认操作成功自动返回操作前页面
			if (! $this->view->get ( 'jumpUrl' ))
				$this->assign ( "jumpUrl", $_SERVER ["HTTP_REFERER"] );
				// sociax:2010-1-21
				// $this->display(C('TMPL_ACTION_SUCCESS'));
			$this->display ( THEME_PATH . '&success' );
		} else {
			// 发生错误时候默认停留3秒
			if (! $this->view->get ( 'waitSecond' ))
				$this->assign ( 'waitSecond', "5" );
				// 默认发生错误的话自动返回上页
			if (! $this->view->get ( 'jumpUrl' ))
				$this->assign ( 'jumpUrl', "javascript:history.back(-1);" );
				// sociax:2010-1-21
				// $this->display(C('TMPL_ACTION_ERROR'));
			
			$this->display ( THEME_PATH . '&success' );
		}
		if (C ( 'LOG_RECORD' ))
			Log::save ();
			// 中止执行 避免出错后继续执行
		exit ();
	}
}

?>