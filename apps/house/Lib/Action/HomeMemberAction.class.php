<?php
class HomeMemberAction extends CommonAction {

	function edit() {
		$model = D("HomeMember");
		$id = $_REQUEST [$model->getPk()];
		$vo = $model->getById($id);
		$region = D("HomeRegion")->getById($vo['regionid']);
		$vo['region']=$region['name'];
		if($vo['type']==1||$vo['type']==3){
			$vo['price']=$vo['price']."万元";
		}else{
			$vo['price']=$vo['price']."元/月";
		}
		$this->assign('vo', $vo);
		$this->display();
	}
	function read() {
		$model = D("HomeMember");
		$id = $_REQUEST [$model->getPk()];
		$vo = $model->getById($id);
		$region = D("HomeRegion")->getById($vo['regionid']);
		$vo['region']=$region['name'];
		if($vo['type']==1||$vo['type']==3){
			$vo['price']=$vo['price']."万元";
		}else{
			$vo['price']=$vo['price']."元/月";
		}
		$this->assign('vo', $vo);
		$this->display();
	}
}
?>