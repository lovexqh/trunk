<?php

class NodeAction extends CommonAction {
    // 获取配置类型
    public function _before_add() {
        $this->assign('pid', $_GET["pid"]);
    }
    public function _before_patch() {
        $model = M("Group");
        $list = $model->where('status=1')->select();
        $this->assign('list', $list);
        $node = M("Node");
        $node->getById($_SESSION['currentNodeId']);
        $this->assign('pid', $node->id);
        $this->assign('level', $node->level + 1);
    }

    /**
      +----------------------------------------------------------
     * 默认排序操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     */
    public function sort() {
        $node = M('Node');
        if (!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id'] = array('in', $_GET['sortId']);
            $sortList = $node->where($map)->order('sort asc')->select();
        } else {
            if (!empty($_GET['pid'])) {
                $pid = $_GET['pid'];
            } else {
                $pid = $_SESSION['currentNodeId'];
            }
            if ($node->getById($pid)) {
                $level = $node->level + 1;
            } else {
                $level = 1;
            }
            $this->assign('level', $level);
            $sortList = $node->where('status=1 and pid=' . $pid . ' and level=' . $level)->order('sort asc')->select();
        }
        $this->assign("sortList", $sortList);
        $this->display();
        return;
    }
    public function index(){
    	$childTree = getChildTree($this->getActionName());
    	$this->assign("list",$childTree);
    	$this->display();
    }
}

?>