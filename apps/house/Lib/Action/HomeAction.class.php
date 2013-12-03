<?php
class HomeAction extends CommonAction {
	public function _before_index() {
		$homeType = D ( 'HomeType' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$this->assign ( 'homeType', $homeType );
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
		
	}
	public function _before_add() {
		// 得到房子的区域，配置，类型
		$homeConfig = D ( 'HomeConfig' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$homeType = D ( 'HomeType' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$this->assign ( 'homeType', $homeType );
		$this->assign ( 'homeConfig', $homeConfig );
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
		//$jumpUrl = $_REQUEST['jumpUrl'];
	}
	public function edit() {
		// 得到房子的区域，配置，类型
		$homeConfig = D ( 'HomeConfig' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$homeType = D ( 'HomeType' )->field ( 'id,name' )->where ( array (
				'status' => 1 
		) )->select ();
		$vo = D('Home')->getById($_REQUEST['id']);
		$region = D('HomeRegion')->getById($vo['homeregionid']);
		$oimage = explode(",", $region['oimage']);
		$timage = explode(",", $region['timage']);
		$myoimage = explode(",", $vo['oimage']);
		$mytimage = explode(",", $vo['timage']);
		$orep = array();
		$trep = array();
		foreach ($myoimage as $oi){
			$orep[] = $oi."_check";
		}
		foreach ($mytimage as $ti){
			$trep[] = $ti."_check";
		}
		$this->assign("oimage",implode(',', str_replace($myoimage,$orep,$oimage)));
		$this->assign("timage",implode(',', str_replace($mytimage,$trep,$timage)));
		$this->assign('vo', $vo);
		$this->assign ( 'homeType', $homeType );
		$this->assign ( 'homeConfig', $homeConfig );
		$this->assign ( 'homeRegion', getChildTree ( 'HomeRegion' ) );
		$this->display();
	}
	public function imageManage() {
		$this->assign("id",$_GET["id"]);
		$this->display ();
	}
// 	public function indexImg(){
// 		$homeid = $_REQUEST ["id"];
// 		$home = D ("Home") ;
// 		$thumbs = $home->where('id='.$_REQUEST ["id"])->getField('thumb');
// 		$thumbs = explode(C("SEPARATE"), $thumbs);
// 		foreach ($thumbs as $key =>$thumb){
// 			$thumbstr.=C("UPLOAD_PATH").$thumb.C("SEPARATE");
// 		}
// 		$thumbstr = substr($thumbstr,0,strlen($thumbstr)-strlen(C("SEPARATE")));
// 		echo $thumbstr;
// 	}
	function insert() {
		//B('FilterString');
		$home = D("Home");
		$data = $home->create();
		if (false === $data) {
			$this->error($home->getError());
		}
		//保存当前数据对象
		$data["oimage"]=implode(",", $data["oimage"]);
		$data["timage"]=implode(",", $data["timage"]);
		$list = $home->add($data);
		if ($list !== false) { //保存成功
			$this->assign('jumpUrl', Cookie::get('_currentUrl_'));
			$this->success('新增成功!');
		} else {
			//失败提示
			$this->error('新增失败!');
		}
	}
	function _filter(&$map) {
		$map['_string']='1=1';
	if ($_REQUEST ['publish']=="-1") {
			$map ['publish'] = array('neq',-1);
		}
		if ($map ['homesize'] == '+') {
			$map ['homesize'] = array (
					'gt',
					3 
			);
		}
		$price1 = $_REQUEST ['price1']; // 价格区间
		$price2 = $_REQUEST ['price2']; // 价格区间
		$homeregion = $_REQUEST ['homeregionid'];
		if(!empty($homeregion)){
		$string = trim (D("Homeregion")->getTypeIds (array($homeregion)) );
		$string = substr ( $string, 0, strlen ( $string ) - 1 );
		if (isset ( $string ) && $string != '') { // 判断不为空
			$map ['homeregionid'] = array (
					'in',
					$string 
			);
		}}
		if(!empty($price1)){
			$map['_string'] .=' AND price >='.$price1;
		}
		if(!empty($price2)){
			$map['_string'] .=' AND price <='.$price2;
		}
		$square1 = $_REQUEST ['square1']; // 面积区间
		$square2 = $_REQUEST ['square2']; // 面积区间
		if(!empty($square1)){
			$map['_string'] .=' AND square >='.$square1;
		}
		if(!empty($square2)){
			$map['_string'] .=' AND square >='.$square2;
		}
		$this->assign ( 'price1', $price1 );
// 		$map ['price1']=$price1;
		$this->assign ( 'price2', $price2 );
// 		$map ['price2']=$price2;
		$this->assign ( 'square1', $square1 );
// 		$map ['square1']=$square1;
		$this->assign ( 'square2', $square2 );
// 		$map ['square2']=$square2;
		$this->assign ( 'publish', $_REQUEST ['publish'] );
		$this->assign ( 'homesize', $_REQUEST ['homesize'] );
		$this->assign ( 'hometypeid', $_REQUEST ['hometypeid'] );
		$this->assign ( 'homeregionid', $_REQUEST ['homeregionid'] );
// 		$map ['homeregionid2']=$_REQUEST ['homeregionid'];
	}
}
?>