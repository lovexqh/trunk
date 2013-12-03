<?php
// 后台用户模块
class UserAction extends CommonAction {
	function _filter(&$map) {
		$map ['id'] = array (
				'egt',
				2 
		);
		$map ['account'] = array (
				'like',
				"%" . $_POST ['account'] . "%" 
		);
	}
	public function _before_add() {
		$map ["status"] = 1;
		$roles = D ( "Role" )->where ($map)->select ();
		$this->assign ( "roles", $roles );
		$this->assign ( "gid", $_GET ["gid"] );
	}
	public function _before_edit() {
		$map ["status"] = 1;
		$roles = D ( "Role" )->where ($map)->select ();
		$rmap["user_id"]=$_REQUEST["id"];
		$roleuser = D("Role_user")->where($rmap)->select();
		$this->assign("roleuser",$roleuser);
		$this->assign ( "roles", $roles );
	}
	
	public function _before_foreverdelete(){
		//删除相关用户组
		//删除相关角色
	}
	public function insert() {
		$user = D ( "User" );
		$roleUser=D("Role_user");
		if (false === $user->create ()) {
			$this->error ( $user->getError () );
		}
		if (! empty ( $_FILES ) && ! empty ( $_FILES ['avatar'] ['name'] )) {
			// 如果有文件上传 上传附件
			$files = $this->_upload ();
			$user ->avatar = $files[0]['savename'];
			// $this->forward();
		}
		$user->startTrans ();
		// 保存当前数据对象
		$userid = $user->add ();
		
		//保存权限
		$roleIds = $_REQUEST["roleIds"];
		foreach ($roleIds as $roleId){
			$role_user["user_id"] = $userid;
			$role_user["role_id"] = $roleId;
			$roleUser->add($role_user);
		}
		
		$group_user ["group_id"] = $_REQUEST ["gid"];
		$group_user ["user_id"] = $userid;
		$Group_userId = D ( "Group_user" )->add ( $group_user );
		if ($Group_userId !== false || $userid !== false) { // 保存成功
			$user->commit ();
			redirect (__APP__.Cookie::get('_currentUrl_'));
// 			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
// 			$this->success ( '新增成功!' );
		} else {
			// 失败提示
			$user->rollback ();
// 			$this->error ( '新增失败!' );
		}
	}
	
	public function update(){
		$User = D("User");
		$roleUser=D("Role_user");
		if (false === $User->create()) {
			$this->error($User->getError());
		}
		if (! empty ( $_FILES ) && ! empty ( $_FILES ['avatar'] ['name'] )) {
			// 如果有文件上传 上传附件
			$files = $this->_upload ();
			$User->avatar = $files[0]['savename'];
			// $this->forward();
		}
		
		// 更新数据
		$list = $User->save();
		
		//更新权限
		$userid = $_REQUEST["id"];
		$map["user_id"] = $userid;
		$roleUser->where($map)->delete();
		$roleIds = $_REQUEST["roleIds"];
		foreach ($roleIds as $roleId){
			$role_user["user_id"] = $userid;
			$role_user["role_id"] = $roleId;
			$roleUser->add($role_user);
		}
		if (false !== $list) {
			//成功提示
			redirect (__APP__.Cookie::get('_currentUrl_'));
		} else {
			//错误提示
			redirect (__APP__.Cookie::get('_currentUrl_'));
		}
	}
	public function index() {
		$user = D ( "GroupUserView" )->select ();
		$this->assign ( "list", $user );
		$this->display ();
	}
	
	// 检查帐号
	public function checkAccount() {
		if (! preg_match ( '/^[a-z]\w{4,}$/i', $_POST ['account'] )) {
			$this->error ( '用户名必须是字母，且5位以上！' );
		}
		$User = M ( "User" );
		// 检测用户名是否冲突
		$name = $_REQUEST ['account'];
		$result = $User->getByAccount ( $name );
		if ($result) {
			$this->error ( '该用户名已经存在！' );
		} else {
			$this->success ( '该用户名可以使用！' );
		}
	}
	// 重置密码
	public function resetPwd() {
		$id = $_POST ['id'];
		$password = $_POST ['password'];
		if ('' == trim ( $password )) {
			$this->error ( '密码不能为空！' );
		}
		$User = M ( 'User' );
		$User->password = md5 ( $password );
		$User->id = $id;
		$result = $User->save ();
		if (false !== $result) {
			$this->success ( "密码修改为$password" );
		} else {
			$this->error ( '重置密码失败！' );
		}
	}
	public function listRole() {
		$userId = $_GET ['id'];
		$list = D ( "RoleUserView" )->select ();
		$roles = D ( "Role" )->select ();
		$this->assign ( "list", $list );
		$this->display ();
	}
	public function user() {
// 		$map ["taGroup.site_id"] = $_SESSION ["_CURRENT_SITE"] ["id"];
		$this->assign ( 'gid', $_GET ["gid"] );
		$user = D ( "GroupUserView" )->getUsersByGroup( $_GET ["gid"]);
		$this->assign ( "list", $user );
		Cookie::set ( '_currentUrl_', "/Auth/User/user/gid/" . $_GET ['gid'] );
		$this->display ();
	}
}
?>