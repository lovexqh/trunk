<?php
// 角色模型
class RoleModel extends Model {
	public $_validate = array(
			array('name','require','名称必须'),
	);

	public $_auto		=	array(
			array('create_time','time',self::MODEL_INSERT,'function'),
			array('update_time','time',self::MODEL_UPDATE,'function'),
	);

	function setRoleApps($roleId,$appIdList)
	{
		if(empty($appIdList)) {
			return true;
		}
		$id = implode(',',$appIdList);
		$where = 'a.id ='.$roleId.' AND b.id in('.$id.')';
		$result = $this->db->execute('INSERT INTO '.$this->tablePrefix.'access (role_id,node_id,pid,level) SELECT a.id, b.id,b.pid,b.level FROM '.$this->tablePrefix.'role a, '.$this->tablePrefix.'node b WHERE '.$where);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}

	function getRoleAppList($roleId)
	{
		$rs = $this->db->query('select b.id,b.title,b.name from '.$this->tablePrefix.'access as a ,'.$this->tablePrefix.'node as b where a.node_id=b.id and  b.pid=0 and a.role_id='.$roleId.' ');
		return $rs;
	}

	function delRoleApp($roleId)
	{
		$table = $this->tablePrefix.'access';
		$result = $this->db->execute('delete from '.$table.' where level=1 and role_id='.$roleId);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}


	function getRoleUserList($roleId)
	{
		$table = $this->tablePrefix.'role_user';
		$rs = $this->db->query('select b.id,b.nickname,b.email from '.$table.' as a ,'.$this->tablePrefix.'user as b where a.user_id=b.id and  a.role_id='.$roleId.' ');
		return $rs;
	}

	function delRoleUser($roleId)
	{
		$table = $this->tablePrefix.'role_user';

		$result = $this->db->execute('delete from '.$table.' where role_id='.$roleId);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}

	function setRoleUser($roleId,$userId) {
		$sql	=	"INSERT INTO ".$this->tablePrefix.'role_user (role_id,user_id) values ('.$roleId.','.$userId.')';
		$result	=	$this->execute($sql);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}

	function setRoleUsers($roleId,$userIdList)
	{
		if(empty($userIdList)) {
			return true;
		}
		if(is_string($userIdList)) {
			$userIdList = explode(',',$userIdList);
		}
		array_walk($userIdList, array($this, 'fieldFormat'));
		$userIdList	 =	 implode(',',$userIdList);
		$where = 'a.id ='.$roleId.' AND b.id in('.$userIdList.')';
		$rs = $this->execute('INSERT INTO '.$this->tablePrefix.'role_user (role_id,user_id) SELECT a.id, b.id FROM '.$this->tablePrefix.'role a, '.$this->tablePrefix.'user b WHERE '.$where);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}
	function setAccess($roleId,$nodeId){
		if(empty($nodeId)) {
			return true;
		}
		$id = implode(',',$nodeId);
		$where = 'a.id ='.$roleId.' AND b.id in('.$id.')';
		$result = $this->db->execute('INSERT INTO '.$this->tablePrefix.'access (role_id,node_id,pid) SELECT a.id, b.id,b.pid FROM '.$this->tablePrefix.'role a, '.$this->tablePrefix.'node b WHERE '.$where);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}
	function getAccess($roleId){
		$rs = $this->db->query('select b.id,b.title,b.name from '.$this->tablePrefix.'access as a ,'.$this->tablePrefix.'node as b where a.node_id=b.id and  b.pid=0 and a.role_id='.$roleId.' ');
		return $rs;
	}
	function delAccess($roleId){
		$table = $this->tablePrefix.'access';
		$result = $this->db->execute('delete from '.$table.' where role_id='.$roleId);
		if($result===false) {
			return false;
		}else {
			return true;
		}
	}
	protected function fieldFormat(&$value)
	{
		if(is_int($value)) {
			$value = intval($value);
		} else if(is_float($value)) {
			$value = floatval($value);
		}else if(is_string($value)) {
			$value = '"'.addslashes($value).'"';
		}
		return $value;
	}

}
?>