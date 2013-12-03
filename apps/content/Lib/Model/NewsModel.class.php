<?php 

class NewsModel extends Model {
	protected $_auto		=	array(
			array('status',1,self::MODEL_INSERT,'string'),
			array('createtime','time',self::MODEL_INSERT,'function'),
			array('updatetime','time',self::MODEL_UPDATE,'function'),
	);

}


?>