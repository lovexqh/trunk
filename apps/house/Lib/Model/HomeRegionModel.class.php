<?php
// 配置类型模型
class HomeRegionModel extends Model {
	protected $_validate = array (
			array (
					'name',
					'require',
					'名称必须' 
			) 
	);
	protected $_auto = array (
			array (
					'status',
					1,
					self::MODEL_INSERT,
					'string' 
			),
			array (
					'createtime',
					'time',
					self::MODEL_INSERT,
					'function' 
			),
			array (
					'updatetime',
					'time',
					self::MODEL_UPDATE,
					'function' 
			) 
	);
	protected $_link = array (
			'HomeRegion' => array (
					'mapping_type' => BELONGS_TO,
					'foreign_key' => 'pid',
					'class_name' => 'HomeRegion',
					'mapping_name' => 'home_region' 
			) 
	);
	public function getTypeIds($ids) { // 返回所有子节点
	                                   // if($ids.)
		$result = '';
		foreach ( $ids as $id ) {
			$result .= $id . ',';
			// $sql = "select id from __TABLE__ where status=1 AND pid =". $val;
			// $data = $this->query($sql);
			// dump($data);
			$regions = D ( 'HomeRegion' )->field ( 'id' )->where ( array (
					'status' => 1,
					'pid' => $id,
			) )->select ();
			$temp = array ();
			foreach ( $regions as $region ) {
				$temp [] = $region ["id"];
			}
			if (! empty ( $temp )) {
				$result .= $this->getTypeIds ( $temp );
			}
		}
		return $result;
	}
}
?>