<?php
import('ViewModel');
class RoleUserViewModel extends ViewModel {
	protected  $viewFields = array(
			
			'Role_user'=>array(),

			'User'=>array('_as'=>'taUser','id','account','nickname','email','create_time','update_time','status','_on'=>'taUser.id=Role_user.user_id AND taUser.status=1'),
			
			'Role'=>array('_as'=>'taRole','_on'=>'taRole.id=Role_user.role_id'),
	);


}