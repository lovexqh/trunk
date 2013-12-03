<?php
import('ViewModel');
class LayoutViewModel extends ViewModel {
	protected  $viewFields = array(

// 			'Site_layout'=>array('id'),

			'Layout'=>array('id','name','thumb','type','filename','status'=>'layoutStatus','pid'),

			'Theme'=>array('id'=>'themeid','path'=>'themePath','status'=>'themeStatus', '_on'=>'Theme.id=Layout.themeid'),

// 			'Site'=>array('id'=>'siteid','domain','status'=>'siteStatus', '_on'=>'Theme.site_id=Site.id'),

	);


}