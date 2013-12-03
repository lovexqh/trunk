
<?php
class CategoryAction extends CommonAction {
	public function _before_add() {
		$vo["pid"] = $_REQUEST['pid'];
		$this->assign('vo',$vo);
		$this->_before_edit();
	}
	
	public function _before_edit() {
		$modelList = M ( 'model' )->select ();
		$this->assign ( "modelList", $modelList );
		// 遍历树形栏目结构
		$this->assign ( 'categoryList', getChildTree ( $this->getActionName () ) );
	}
	/*
	 * 得到栏目列表
	 */
	public function getCategoryTree(){
		$siteid = $_REQUEST['layoutid'];
		$this->doManageCategory($siteid);
		echo json_encode($this->temp);
		
	}
	
	public $temp = array (); // 栏目有序列表
	public $tempIndex = array (); // 数据库中无序栏目列表
	public function doManageCategory($siteid) {
		$list = D ( 'category' )->where('siteid = '.$siteid)->order('listorder+0 asc')->select (); // 从数据库读取全部数据

		foreach ( $list as $key => $value ) {
			$size = count ( explode ( '-', $value ['arrpid'] ) );
			$flag = "&nbsp;&nbsp;&nbsp;";
			for($i = 1; $i < $size; $i ++) {

				$flag = "&nbsp;&nbsp;&nbsp;&nbsp;" . $flag;
					
			}
			$list [$key] ['listorder'] = ( int ) $value ['listorder'];
			$list [$key] ['catname'] = $flag . '|--' . $value ['catname'];
			array_push($this->tempIndex, $list [$key]);
		}

		$this->doOrderCategory ( 0 );
		// return $list;
	}
	/**
	 * 判断是否有根节点
	 */
	public function doCheckHaveSon($flag) {
		$result = true;
		foreach($this->tempIndex as $key => $value ) {
			if ($this->tempIndex[$key] ['pid'] == $flag) {
				$result = false;
				break;
			}
		}
		return $result;
	}
	public function doOrderCategory($flag) {
		foreach ( $this->tempIndex as $key => $value ) {
			if ($this->tempIndex [$key] ['pid'] == $flag) {
				array_push ( $this->temp, $this->tempIndex [$key] ); // 添加父节点
				// 				array_
				if (!$this->doCheckHaveSon ( $this->tempIndex [$key] ['catid'] )) { // 判断是否是根节点
					$this->doOrderCategory ( $this->tempIndex [$key] ['catid']  );
				}
					
			}
		}

	}

	public function index() {

		$this->assign ( 'categoryList', getChildTree($this->getActionName()) );
		$this->display ();
	}

	public function showCategoryListAjax() {
		$catid = $_REQUEST ['id'];
		$resultList = array ();
		if ($catid == null || $catid == "") {
			$result->id = 0;
			$result->name = '首页';
			$result->isParent = true;
			$resultList [] = $result;
		} else {
			$temp = array ();
			$where['pid'] =$catid;
			$resultList = D("Category")->relation(true)->where($where)->select();
			foreach ( $resultList as $key => $value ) {
				$subcat = M ( 'Category' )->where ( 'pid = ' . $value ['id'] )->count () > 0 ? true : false;
				$resultList [$key] ['isParent'] = $subcat;
			}
		}
		$data = json_encode ( $resultList );
		echo $data;

	}
	public function updateOrder() {
		$order = $_REQUEST ['sort'];
		$id = $_REQUEST ['id'];
		$data = M ( 'category' );
		$condition ['sort'] = $order;
		$condition ['id'] = $id;
		$data->save ( $condition );
	}
	public function findModelFiledId (){
		$catid =$_REQUEST['catid'];
		$category = D('Category')->relation(true)->find($catid);
		$modelFileds = M('ModelField')->where(array('modelid'=>$category['model']['id'],'siteid'=>$category['siteid']))->select();
		echo json_encode($modelFileds);
	}
}
?>