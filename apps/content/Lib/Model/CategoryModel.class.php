<?php 
import('RelationModel');
class CategoryModel extends RelationModel {
	protected $_link = array (
			'Model' => array (
					'mapping_type' => BELONGS_TO,
					'foreign_key'=>'modelid',
					'class_name' => 'Model',
					'mapping_name' => 'model'
			)
	);
	
	protected $_auto		=	array(
			array('status',1,self::MODEL_INSERT,'string'),
			array('createtime','time',self::MODEL_INSERT,'function'),
			array('updatetime','time',self::MODEL_UPDATE,'function'),
	);

}


?>