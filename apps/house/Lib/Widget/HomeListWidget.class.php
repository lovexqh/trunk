<?php
class HomeListWidget extends Widget {
	public function render($data) {
		// 根据参数搜素内容列表
		$this->search (&$data);
		foreach ( $data ["homes"] as $key => $home ) {
		}
		return $this->renderFile ( 'HomeList', $data );
	}
	public function edit($data) {
		return $this->renderFile ( 'HomeListEdit', $data );
	}
	private function search($data) {
		$map ['_string'] = '1=1';
		$map ['publish'] = 1;
		$name = $_REQUEST ['name'];
		if (! empty ( $name )) {
			$map ['title'] = array (
					'like',
					'%' . $name . '%' 
			);
		}
		$hometypeid = $_REQUEST ['hometypeid'];
		if (! empty ( $hometypeid )) {
			$map ['hometypeid'] = $hometypeid;
		}
		if ($map ['homesize'] == '+') {
			$map ['homesize'] = array (
					'gt',
					3 
			);
		}
		// if (empty ( $_REQUEST ['hometypeid'] ))
		// $map ['hometypeid'] = $_REQUEST ['hometypeid'];
		$price1 = $_REQUEST ['price1']; // 价格区间
		$price2 = $_REQUEST ['price2']; // 价格区间
		$homeregion = $_REQUEST ['homeregionid2'];
		if (! empty ( $homeregion )) {
			$string = trim ( D ( 'HomeRegion' )->getTypeIds ( array (
					$homeregion 
			) ) );
			$string = substr ( $string, 0, strlen ( $string ) - 1 );
			if (isset ( $string ) && $string != '') { // 判断不为空
				$map ['homeregionid'] = array (
						'in',
						$string 
				);
			}
		}
		if (! empty ( $price1 )) {
			$map ['_string'] .= ' AND price >=' . $price1;
		}
		if (! empty ( $price2 )) {
			$map ['_string'] .= ' AND price <=' . $price2;
		}
		$square1 = $_REQUEST ['square1']; // 面积区间
		$square2 = $_REQUEST ['square2']; // 面积区间
		if (! empty ( $square1 )) {
			$map ['_string'] .= ' AND square >=' . $square1;
		}
		if (! empty ( $square2 )) {
			$map ['_string'] .= ' AND square >=' . $square2;
		}
		
		$count = D ( "Home" )->where ( $map )->count ( 'id' );
		if ($count > 0) {
			$p = new Page ( $count );
			$p->setConfig ( 'theme', ' %upPage% %linkPage% %downPage%' );
			$homes = D ( "Home" )->where ( $map )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
			$data ["page"] = $p->show ();
		}
		require(SITE_PATH.'/addons/libs/Date.class.php');
		foreach ( $homes as $key => $home ) {
			$homes [$key] ["url"] = "?home=" . $home ["id"];
			$thumbs = explode ( C ( 'SEPARATE' ), $homes [$key] ["thumb"] );
			$homes [$key] ["thumb"] = C ( 'UPLOAD_PATH' ) . 's_' . $thumbs [0];
			if ($homes [$key] ["type"] == 3) {
				// 房屋类型是出售
				$price_suf = "万元";
			} else if ($home [$key] ["type"] == 4) {
				// 房屋类型是出租
				$price_suf = "元/月";
			}
			$homes [$key] ["price"] .= $price_suf;
			$date = new Date ();
			$homes [$key] ["difftime"] = $date->timeDiff ( toDate ( $home ["createtime"] ) );
			$user = D ( "User" )->find ( $home ["userid"] );
			$homes [$key] ["user"] = $user ["realname"];
		}
		$data ["homes"] = $homes;
		$data ["count"] = $count;
		return $data;
	}
}

?>