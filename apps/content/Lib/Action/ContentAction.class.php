<?php
class ContentAction extends CommonAction {
	public function add() {
		$this->edit();
	}
	public function edit(){
		$type = $_REQUEST ['type'];
		$catid = $_REQUEST ['catid'];
		
		$modelid = $_REQUEST ['modelid'];
		$model = D ( "model" )->field ( 'tablename' )->find ( $modelid );
		$vo = D ( $model ['tablename'] )->getById ( $_GET ['id']);
		
		$this->assign ( "vo", $vo );
		$this->assign ( 'type', $type );
		$this->assign ( 'catid', $catid );
		$this->display ("edit");
	}
	//frame页面
	public function content(){
		$type = $_REQUEST ['type'];
		$catid = $_REQUEST ['catid'];
		$modelid = $_REQUEST ['modelid'];
		$model = D("model")->field('tablename')->find($modelid);
		$this->assign ( 'type', $type );
		$this->assign ( 'catid', $catid );
		$map['status'] = 1;
		$map['catid'] = $_REQUEST ['catid'];
		$model = D($model['tablename']);
		$this->_list ( $model, $map );
		$this->display ();
	}

	public function saveOrUpdate(){
		$type = $_REQUEST ['type'];
		$catid = $_REQUEST ['catid'];
		$data = D ( "News" );
		$data->create ();
		if (! empty ( $_FILES ) && ! empty ( $_FILES ['thumb'] ['name'] )) {
			// 如果有文件上传 上传附件
			$data ->thumb = $this->_upload ();
			// $this->forward();
		}
		if(empty($_REQUEST['id'])){
			$data->add ();
		}else{
			$data->save ();
		}
		
		if ($type===1) {
			$this->redirect ("content/Content/singlePage/",array("catid"=>$catid,"type"=>$type));
		} else {
			$this->redirect ("content/Content/content/",array("catid"=>$catid,"type"=>$type));
		}
		
		
	}
	public function delete() {
		$type = $_REQUEST ['type'];
		$modelid = $_REQUEST ['modelid'];
		$model = D("model")->field('tablename')->find($modelid);
		$data = D( $model ['tablename'] );
		$id = $_REQUEST ['id'];
		$catid = $_REQUEST ['catid'];
		$result = $data->where ( 'id=' . $id )->delete ();
		$this->redirect ("content/Content/content/",array("catid"=>$catid,"type"=>$type));
	}

	public function index() {
	
		$this->display ();
	}
	public function weclome(){
		$this->display ();
	}
	/**
	 * 单页栏目页
	 */
	public function singlePage() {
		$id = $_REQUEST ['id'];
		$type = $_REQUEST ['type'];
		if ($id != null && $id != "") {
			$data = D ( 'single_page' )->where ( 'catid=' . $id )->find ();
			$this->assign ( 'vo', $data );
			$this->assign ( 'content', "Admin:Content:singlePage" );
		}
		$this->assign ( 'catid', $id );
		$this->assign ( 'type', $type );
		$this->display ();
	}

}
?>