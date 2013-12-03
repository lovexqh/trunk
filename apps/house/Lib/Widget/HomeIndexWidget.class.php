<?php
class HomeIndexWidget extends Widget {
	public function render($data) {
        $map["status"] = 1;
        $map["publish"] = 1;
		$homes = M ( "Home" )->where ($map)->limit(8)->select ();
		$dataarr = array ();

		foreach ( $homes as $key => $home ) {
			if (! empty ( $home ["thumb"] )) {
				$thumbs = explode(C("SEPARATE"), $home ["thumb"]);
				$dataarr [$key] ["thumb"] =C("UPLOAD_PATH")."s_".$thumbs[0];
			}
			$dataarr [$key] ["url"] = "?t=home&id=".$home['id'];
			if($home["type"]==3){
				//房屋类型是出售
				$price_suf="万元";
			}else if($home["type"]==4){
				//房屋类型是出租
				$price_suf="元/月";
			}
            $dataarr [$key] ["price"] = $home ["price"].$price_suf;
            $rmap["id"]=$home ["homeregionid"];
            $rmap["status"]=1;
			$dataarr [$key] ["homeregion"] = D("HomeRegion")->where($rmap)->getField("name");
			$dataarr [$key] ["hometype"] = $home ["homesize"]."室".$home["parlour"]."卫".$home["toilet"]."厅";
		}
		$data ['postlist'] =  $dataarr;
		$data['more']="?t=homeList";
		return $this->renderFile ( 'HomeIndex', $data );
	}
	public function edit($data) {
		$data ["type"] = array (
				"homeregionid" => "区域",
				"createtime" => "发布时间" 
		);
		$data ["count"] = array (
				"2",
				"4",
				"6",
				"8" 
		);
		$data ["style"] = array (
				"blue" => "蓝色",
				"red" => "红色" 
		);
		return $this->renderFile ( 'HomeIndexEdit', $data );
	}
}
