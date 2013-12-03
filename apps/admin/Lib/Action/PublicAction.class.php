<?php
class PublicAction extends CommonAction {
	public function code() {
		if (md5 ( strtoupper ( $_POST ['verify'] ) ) == $_SESSION ['verify']) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function adminlogin() {
		if (service ( 'Passport' )->isLoggedAdmin ()) {
			redirect ( U ( 'admin/Index/index' ) );
		}
		$this->display ();
	}
	public function isVerifyAvailableLogin($verify = null) {
		$return_type = empty ( $verify ) ? 'ajax' : 'return';
		$verify = empty ( $verify ) ? $_POST ['verify'] : $verify;
		// 验证码不可用
		if (empty ( $_POST ['verify'] ) && empty ( $verify )) {
			echo 'no';
		} else {
			// 验证码可用
			if (md5 ( strtoupper ( $verify ) ) == $_SESSION ['verify']) {
				echo 'success';
			} else {
				echo 'false';
			}
		}
	}
	public function doAdminLogin() {
		if (empty ( $_POST ['password'] )) {
			$this->error ( L ( 'password_notnull' ) );
		}
		
		$is_logged = service ( 'Passport' )->loginAdmin ( $_POST ['account'], $_POST ['password'] );
		
		// 提示消息不显示头部
		$this->assign ( 'isAdmin', '1' );
		
		if ($is_logged) {
			$this->assign ( 'jumpUrl', U ( 'admin/Index/index' ) );
			$this->success ( L ( 'login_success' ) );
		} else {
			$this->assign ( 'jumpUrl', U ( 'home/Public/adminlogin' ) );
			$this->error ( service ( 'Passport' )->getLastError () );
		}
	}
	public function logout() {
		service ( 'Passport' )->logoutLocal ();
		$this->assign ( 'jumpUrl', U ( 'admin/Public/adminlogin' ) );
		$this->assign ( 'waitSecond', 1 );
		$this->success ( L ( 'exit_success' ));
	}
}