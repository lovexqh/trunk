<?php
// 角色模块
class RoleAction extends CommonAction {
	function _filter(&$map){
		$map['name'] = array('like',"%".$_POST['name']."%");
	}
	public function access(){
// 		getChildTree($modelName,$nodeId=0,$cur_level=1,$treeList,$nodeList)
		$id = $_REQUEST["id"];
		$roleAccess = D ( "Access" )->getRoleAccess($id);
		if(! $_SESSION [C ( 'ADMIN_AUTH_KEY' )]){
		$userid = $_SESSION [C ( 'USER_AUTH_KEY' )];
		$userAccess = D ( "Access" )->getUserAccess($userid);
		$group = D("GroupUserView")->getGroupByUser($userid);
		$groupAccess = D ( "Access" )->getGroupAccess($group["gid"]);
		$nodeList = array();
		foreach ($userAccess as $us){
			if(!in_array($us, $groupAccess))$nodeList[]=$us;
		}
		$nodeList += $groupAccess;
		}else{
			$nodeList = D("Node")->field("id,name,title,status,sort,pid")->select();
		}
		foreach ($nodeList as $key =>$node){
			if(in_array($node, $roleAccess)){
				$nodeList[$key]["check"]=1;
			}else{
				$nodeList[$key]["check"]=0;
			}
		}
		
		$childTree = getChildTree("node",0,1,"",$nodeList);
		$this->assign("roleId",$id);
		$this->assign("list",$childTree);
		$this->display();
	}
	public function setAccess(){
		$id     = $_POST['nodeId'];
		$roleId	=	$_POST['roleId'];
		$role    =   D("Role");
		$role->delAccess($roleId);
		$result = $role->setAccess($roleId,$id);
		if($result===false) {
			$this->error('操作授权失败！');
		}else {
			$this->success('操作授权成功！');
		}
	}
	public function listUser(){
		$map["taRole.id"]=$_GET["id"];
		$user = D("RoleUserView")->where($map)->select();
		$this->assign("list",$user);
		$this->display();
	}
	public function deleteUser(){
		$map['user_id']  = array('in',$_REQUEST['id']);
		$result = D(Role_user)->where($map)->delete();
		if($result===false) {
			$this->error('操作失败！');
		}else {
			$this->success('操作成功！');
		}
	}
}
?>