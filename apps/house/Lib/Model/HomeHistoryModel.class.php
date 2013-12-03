<?php
// 房屋查看历史
class HomeHistoryModel extends Model {
	protected $_validate = array(
		array('remark','require','备注必须'),
		);

	protected $_auto		=	array(
        array('status',1,self::MODEL_INSERT,'string'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('updatetime','time',self::MODEL_UPDATE,'function'),
		);
}
?>