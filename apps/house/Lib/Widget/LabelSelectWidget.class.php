<?php 
class LabelSelectWidget extends Widget{
	/* (non-PHPdoc)
	 * @see Widget::render()
	 */
	public function render($data) {
		// TODO Auto-generated method stub
//		$widgetId = $data["id"];
//		$widget = M("Widget")->find($widgetId);
//		$param = $widget["param"];
//// 		$home = json_decode($param);
//		//进行价格
//		$contentlist = M('Homeregion')->where('state = 1')->select();
//		$regions =array();//重新组装区域数组
//		$regions[0]['title']="不限";
//		$regions[0]['value']= 0;
//		$regions[0]['isDefault']=true;
//		for($i=0;$i<count($contentlist);$i++){
//			$regions[$i+1]['title']=$contentlist[$i]['name'];
//			$regions[$i+1]['value']=$contentlist[$i]['id'];
//			$regions[$i+1]['isDefault']=false;
//
//		}
//		$regions = json_encode($regions);
//		$obj = array();
//		$obj['data']=$regions;
//		$obj['param'] = $param;
		$data['labels'] = array();
		$regionKey=0;
		$typeKey = 1;
		$priceKey =2;
		
		$data['labels'][$regionKey]["label"] = "[区域]";
		$data['labels'][$regionKey]["key"] = "area";
		$data['labels'][$regionKey]['values'] = array();
		$value['title'] = "不限";
		$value['value'] = -1;
		$value['isDefault'] = true;
		$data['labels'][$regionKey]['values'][] = $value;
		$homeregion = D("HomeRegion")->select();
		foreach ($homeregion as $hg){
			$value['title'] = $hg["name"];
			$value['value'] = $hg["id"];
			$value['isDefault'] = false;
			$data['labels'][$regionKey]['values'][] = $value;
		}
		
		
		$data['labels'][$typeKey]["label"] = "[房型]";
		$data['labels'][$typeKey]["key"] = "type";
		$data['labels'][$typeKey]['values'] = array();
		$value['title'] = "不限";
		$value['value'] = -1;
		$value['isDefault'] = true;
		$data['labels'][$typeKey]['values'][] = $value;
		$hometype = D("HomeType")->select();
		foreach ($hometype as $ht){
			$value['title'] = $ht["name"];
			$value['value'] = $ht["id"];
			$value['isDefault'] = false;
			$data['labels'][$typeKey]['values'][] = $value;
		}
		
		$data['labels'][$priceKey]["label"] = "[价格]";
		$data['labels'][$priceKey]["key"] = "price";
		$data['labels'][$priceKey]['values'] = array();
		$value['title'] = "不限";
		$value['value'] = -1;
		$value['isDefault'] = true;
		$data['labels'][$priceKey]['values'][] = $value;

		$value['title'] = "0-1000";
		$value['value'] = 0;
		$value['isDefault'] = false;
		$data['labels'][$priceKey]['values'][] = $value;
		
		$value['title'] = "1000-3000";
		$value['value'] = 1000;
		$value['isDefault'] = false;
		$data['labels'][$priceKey]['values'][] = $value;
		
		$value['title'] = "3000-5000";
		$value['value'] = 3000;
		$value['isDefault'] = false;
		$data['labels'][$priceKey]['values'][] = $value;
		
		$value['title'] = "5000以上";
		$value['value'] = 5000;
		$value['isDefault'] = false;
		$data['labels'][$priceKey]['values'][] = $value;
		
		$data['labels'] = $data['labels'];
		$data['search'] = "?homeList";
		$content =  $this->renderFile('LabelSelect',$data);
		return $content;
	}

	public function edit($data){
		if(!empty($data)){
			$content =  $this->renderFile('LabelSelectEdit',$data);
		}else{
			$content =  $this->renderFile('LabelSelectEdit',array("param"=>"''"));
		}
		return $content;
	}
	
	
} 

?>