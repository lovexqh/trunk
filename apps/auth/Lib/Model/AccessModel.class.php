<?php
// 布局模型
class AccessModel extends Model {

	function getUserAccess($userid) {
		$table["access"]=$this->tablePrefix."access".$this->tableSuffix;
		$table["role_user"]=$this->tablePrefix."role_user".$this->tableSuffix;
		$table["node"]=$this->tablePrefix."node".$this->tableSuffix;
		$sql ="SELECT " .$table["node"].".id ,".$table["node"].".name,".$table["node"].".title,".$table["node"].".status,".$table["node"].".sort,".$table["node"].".pid";
		$sql .=" FROM ".$table["node"];
		$sql .=" INNER JOIN ".$table["access"]." ON ".$table["access"].".node_id = ".$table["node"].".id";
		$sql .=" INNER JOIN ".$table["role_user"]." ON ".$table["role_user"].".role_id = ".$table["access"].".role_id";
		$sql .=" AND ".$table["role_user"].".user_id =".$userid;
		$sql .=" ORDER BY sort,pid,id";
		$node = $this->query($sql);
// 		$node = $this->join($table["role_user"]." on user_id=".$userid)->join ( $table["access"]." on id=node_id")->select ();
		return $node;
	}
	function getGroupAccess($groupid) {
		$table["access"]=$this->tablePrefix."access".$this->tableSuffix;
		$table["role_group"]=$this->tablePrefix."role_group".$this->tableSuffix;
		$table["node"]=$this->tablePrefix."node".$this->tableSuffix;
		$sql ="SELECT " .$table["node"].".id ,".$table["node"].".name,".$table["node"].".title,".$table["node"].".status,".$table["node"].".sort,".$table["node"].".pid";
		$sql .=" FROM ".$table["node"];
		$sql .=" INNER JOIN ".$table["access"]." ON ".$table["access"].".node_id = ".$table["node"].".id";
		$sql .=" INNER JOIN ".$table["role_group"]." ON ".$table["role_group"].".role_id = ".$table["access"].".role_id";
		$sql .=" AND ".$table["role_group"].".group_id =".$groupid;
		$sql .=" ORDER BY sort,pid,id";
		$node = $this->query($sql);
		// 		$node = $this->join($table["role_user"]." on user_id=".$userid)->join ( $table["access"]." on id=node_id")->select ();
		return $node;
	}
	function getRoleAccess($roleid) {
		$table["access"]=$this->tablePrefix."access".$this->tableSuffix;
		$table["node"]=$this->tablePrefix."node".$this->tableSuffix;
		$sql ="SELECT " .$table["node"].".id ,".$table["node"].".name,".$table["node"].".title,".$table["node"].".status,".$table["node"].".sort,".$table["node"].".pid";
		$sql .=" FROM ".$table["node"];
		$sql .=" INNER JOIN ".$table["access"]." ON ".$table["access"].".node_id = ".$table["node"].".id";
		$sql .=" AND ".$table["access"].".role_id =".$roleid;
		$sql .=" ORDER BY sort,pid,id";
		$node = $this->query($sql);
		// 		$node = $this->join($table["role_user"]." on user_id=".$userid)->join ( $table["access"]." on id=node_id")->select ();
		return $node;
	}
	function getUserMenu($userid,$pid=0){
		$table["access"]=$this->tablePrefix."access".$this->tableSuffix;
		$table["role_user"]=$this->tablePrefix."role_user".$this->tableSuffix;
		$table["node"]=$this->tablePrefix."node".$this->tableSuffix;
		$sql ="SELECT " .$table["node"].".id ,".$table["node"].".name,".$table["node"].".title,".$table["node"].".status,".$table["node"].".sort,".$table["node"].".pid";
		$sql .=" FROM ".$table["node"];
		$sql .=" INNER JOIN ".$table["access"]." ON ".$table["access"].".node_id = ".$table["node"].".id";
		$sql .=" INNER JOIN ".$table["role_user"]." ON ".$table["role_user"].".role_id = ".$table["access"].".role_id";
		$sql .=" AND ".$table["role_user"].".user_id =".$userid;
		$sql .=" WHERE ".$table["node"].".pid =".$pid." AND ".$table["node"].".ismenu =1 AND ".$table["node"].".status =1";
		$sql .=" ORDER BY sort,pid,id";
		$node = $this->query($sql);
		// 		$node = $this->join($table["role_user"]." on user_id=".$userid)->join ( $table["access"]." on id=node_id")->select ();
		return $node;
	}
}
?>