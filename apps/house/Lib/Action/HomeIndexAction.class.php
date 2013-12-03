<?php
class HomeIndexAction extends IndexCommonAction {
	public function _before_add() {
		// 得到房子的区域，配置，类型
		$homeConfig = D ( 'HomeConfig' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$homeType = D ( 'HomeType' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$this->assign ( 'homeType', $homeType );
		$this->assign ( 'homeConfig', $homeConfig );
		// $this->assign('memberid',$_SESSION [C('MEMBER_USER_AUTH_KEY')]
		// ['id']);//记录前台用户id
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
	}
	public function delete() {
		// 删除指定记录
		$model = M ( 'Home' );
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
					// $this->success('删除成功！');
					redirect ( __URL__ );
				} else {
					// $this->error('删除失败！');
					redirect ( __URL__ );
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	public function _before_edit() {
		// 得到房子的区域，配置，类型
		$homeConfig = D ( 'HomeConfig' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$homeType = D ( 'HomeType' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$vo = D('Home')->getById($_REQUEST['id']);
		$region = D('HomeRegion')->getById($vo['homeregionid']);
		$oimage = explode(",", $region['oimage']);
		$myoimage = explode(",", $vo['oimage']);
		$myrep = array();
		foreach ($myoimage as $oi){
			$myrep[] = $oi."_check";
		}
		$timage = $region['timage'];
		$this->assign("oimage","");
		$this->assign("timage","");
		$this->assign('vo', $vo);
		$this->assign ( 'homeType', $homeType );
		$this->assign ( 'homeConfig', $homeConfig );
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
	}
	function edit() {
		$model = M ( "Home" );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	public function imageManage() {
		$this->assign ( "id", $_GET ["id"] );
		$this->display ();
	}
	public function uploadImg() {
		$home = D ( "Home" );
		$thumb = $home->where ( 'id=' . $_REQUEST ["id"] )->getField ( 'thumb' );
		$uploads = $this->_upload ();
		if (! empty ( $thumb ))
			$thumb = $thumb . C ( "SEPARATE" );
		$data ["thumb"] = $thumb . $uploads [0] ['savename'];
		$state = "SUCCESS";
		$list = $home->where ( 'id=' . $_REQUEST ["id"] )->save ( $data );
		echo "{'url':'" . C ( "UPLOAD_PATH" ) . $uploads [0] ['savename'] . "','title':'" . $_POST ['pictitle'] . "','state':'" . $state . "'}";
	}
	public function deleteImg() {
		$homeid = $_REQUEST ["id"];
		$imgName = $_REQUEST ["imgName"];
		$home = D ( "Home" );
		$thumb = $home->where ( 'id=' . $_REQUEST ["id"] )->getField ( 'thumb' );
		$data ["id"] = $homeid;
		$thumb_array = explode ( C ( "SEPARATE" ), $thumb );
		$diffarray = array_diff ( $thumb_array, array (
				$imgName 
		) );
		$data ["thumb"] = implode ( C ( "SEPARATE" ), $diffarray );
		$home->save ( $data );
	}
	public function indexImg() {
		$homeid = $_REQUEST ["id"];
		$home = D ( "Home" );
		$thumbs = $home->where ( 'id=' . $_REQUEST ["id"] )->getField ( 'thumb' );
		$thumbs = explode ( C ( "SEPARATE" ), $thumbs );
		foreach ( $thumbs as $key => $thumb ) {
			$thumbstr .= C ( "UPLOAD_PATH" ) . $thumb . C ( "SEPARATE" );
		}
		$thumbstr = substr ( $thumbstr, 0, strlen ( $thumbstr ) - strlen ( C ( "SEPARATE" ) ) );
		echo $thumbstr;
	}
	function _filter(&$map) {
		$map ['memberid'] = $_SESSION [C ( 'MEMBER_USER_AUTH_KEY' )] ['id'];
	}
	function update() {
		// B('FilterString');
		$model = D ( "Home" );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		// 更新数据
		$list = $model->save ();
		if (false !== $list) {
			// 成功提示
			// $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
			// $this->success('编辑成功!');
			redirect ( __URL__ );
		} else {
			// 错误提示
			$this->error ( '编辑失败!' );
		}
	}
	function insert() {
		// B('FilterString');
		$model = D ( "Home" );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		// 保存当前数据对象
		$list = $model->add ();
		if ($list !== false) { // 保存成功
			redirect ( __URL__ );
		} else {
			// 失败提示
			$this->error ( '新增失败!' );
		}
	}
	public function index() {
		// 列表过滤器，生成查询Map对象
		$map = $this->_search ();
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$model = D ( 'Home' );
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	public function sellHouse() {
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
		$this->display ();
	}
	public function insertSellHouse() {
		$sellHouse = D ( 'HomeMember' );
		if (false === $sellHouse->create ()) {
			$this->error ( $sellHouse->getError () );
		}
		// 保存当前数据对象
		$list = $sellHouse->add ();
		if ($list !== false) { // 保存成功
			redirect ( __URL__ );
		} else {
			// 失败提示
			$this->error ( '新增失败!' );
		}
	}
	public function rentHouse() {
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
		$this->display ();
	}
	public function insertRentHouse() {
		$sellHouse = D ( 'HomeMember' );
		if (false === $sellHouse->create ()) {
			$this->error ( $sellHouse->getError () );
		}
		// 保存当前数据对象
		$list = $sellHouse->add ();
		if ($list !== false) { // 保存成功
			redirect ( __URL__ );
		} else {
			// 失败提示
			$this->error ( '新增失败!' );
		}
	}
}
?>