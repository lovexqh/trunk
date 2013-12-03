<?php
class MemberAction extends CommonAction {
	public function register() {
		$model = D('Member');
		$data = $model->create();
		if (false === $data) {
			$this->error($model->getError());
		}
		//保存当前数据对象
		$list = $model->add();
		$obj['id']=$list;
		$obj['name']=$data['name'];
		$obj['password']=$data['password'];
		
		if ($list !== false) { //保存成功
			$_SESSION [C('MEMBER_USER_AUTH_KEY')]=$obj;
			redirect(__APP__.'/Home/HomeIndex');
		} else {
			//失败提示
				redirect(__APP__);
		}
	}
	public function useredit(){
		$model = M('Member');
		$id =$_SESSION [C('MEMBER_USER_AUTH_KEY')]['id'];
		$vo = $model->getById($id);
		$this->assign('vo', $vo);
		$this->display('Home:HomeIndex:useredit');
// 		$this->assign("jumpUrl",__APP__.'/Home/HomeIndex');;
	}
	//前台修改密码
	public function userupdate(){
		$model = M('Member');
		$old =$_SESSION [C('MEMBER_USER_AUTH_KEY')]['password'];
		$oldpwd = $_REQUEST['oldpwd'];
		$password = $_REQUEST['password'];
		if($old ==$oldpwd){
		if (false === $model->create()) {
			$this->error($model->getError());
		}
		// 更新数据
		$list = $model->save();
		if (false !== $list) {
			//成功提示
			$this->assign("jumpUrl",__APP__);
				$this->success( "修改成功，请用新密码登陆！");
			unset ( $_SESSION ["member"] );
// 			$this->success('编辑成功!');
		} else {
			//错误提示
			$this->error('编辑失败!');
		}
		
		}else{
			$this->error( "旧密码输入错误！");
		}
	$this->edit();
	}
	public function login() {
		if (empty ( $_POST ['name'] )) {
			$this->error ( '帐号错误！' );
		} elseif (empty ( $_POST ['password'] )) {
			$this->error ( '密码必须！' );
		}
		$map ["name"] = $_POST ["name"];
		$map ["password"] = $_POST ["password"];
		$map ["status"] = 1;
		$member = M ( "Member" )->where ( $map )->find ();
		if (empty ( $member )) {
// 			$this->assign("errormessage",'');
			$this->error ( "用户名，密码错误！" );
		} else {
			$_SESSION [C('MEMBER_USER_AUTH_KEY')] = $member;
// 			$this->assign("jumpUrl",__APP__.'/Home/HomeIndex');
			redirect(__APP__.'/Home/HomeIndex');
// 			$this->success ( "登录成功！");
		}
	}
	public function logout() {
// 		$this->assign("jumpUrl",__APP__);
		if (isset ( $_SESSION [C('MEMBER_USER_AUTH_KEY')] )) {
			unset ( $_SESSION [C('MEMBER_USER_AUTH_KEY')] );
			redirect(__APP__);
		} else {
			$this->error( '已经登出！');
		}
	}
}
?>

