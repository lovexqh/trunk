<?php
class GroupAction extends CommonAction {
	public function _before_add() {
		$vo['pid'] = $_GET ['pid'];
		$this->assign ( "vo",$vo );
	}
	public function index() {
		$treeList = getChildTree ($this->getActionName());
		$this->assign ( 'list', $treeList );
		$this->display ();
	}
	public function showGroupList() {
		$pid = $_REQUEST ['id'];
		$resultList = array ();
		if ($pid == null || $pid == "") {
			$result ["id"] = 0;
			$result ["name"] = '组织机构';
			$result ["isParent"] = true;
			$resultList [] = $result;
		} else {
			$map ["pid"] = $pid;
			$groups = M ( "group" )->where ( $map )->select ();
			foreach ( $groups as $key => $group ) {
				$result = M ( 'group' )->where ( 'pid = ' . $group ['id'] )->count () > 0 ? true : false;
				$groups [$key] ['isParent'] = $result;
			}
			$resultList = $groups;
		}
		$data = json_encode ( $resultList );
		echo $data;
		// $this->ajaxReturn ( $data,"",1);
	}
}
?>