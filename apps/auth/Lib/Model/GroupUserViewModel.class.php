<?php
import('ViewModel');
class GroupUserViewModel extends ViewModel {
	protected  $viewFields = array(
			
			'Group_user'=>array(),

			'User'=>array('_as'=>'taUser','id'=>'uid','name','nickname','email','create_time','update_time','status','_on'=>'taUser.id=Group_user.user_id'),
			
			'Group'=>array('_as'=>'taGroup','id'=>'gid','_on'=>'taGroup.id=Group_user.group_id'),
	);
	function getUsersByGroup($groupid) {
		return $this->where ( 'taGroup.id=' . $groupid )->select ();
	}
	function getGroupByUser($userid) {
		return $this->where ( 'taUser.id=' . $userid )->find ();
	}

}