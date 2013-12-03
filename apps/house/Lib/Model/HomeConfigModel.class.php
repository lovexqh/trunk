<?php
// 配置类型模型
class HomeConfigModel extends Model {
	protected $_validate = array(
		array('name','require','名称必须'),
		);

	protected $_auto		=	array(
        array('status',1,self::MODEL_INSERT,'string'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('updatetime','time',self::MODEL_UPDATE,'function'),
		);
}
?>