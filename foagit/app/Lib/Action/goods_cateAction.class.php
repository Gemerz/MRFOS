<?php
class goods_cateAction extends oabaseAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('goods_cate');
	}
	public function index(){
		
		$tree = new Tree();
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$result = $this->_mod->select();
		
		$array = array();
		foreach ($result as $arr) {
			$arr['status'] ='<i data-editid="'.$arr['id'].'" data-editype="single" data-editfield="status" data-toggle="AJAXedit" data-editurl="'.U('goods_cate/ajax_edit').'" class="'.($arr['status'] == 0 ? 'icon-remove' : 'icon-ok').'" data-value="'.$arr['status'].'"></i>';
			$arr['mangers'] ='<a class="editing" data-id="'.$arr['id'].'" href="#editing" data-orgurl="'.U('goods_cate/edit').'" data-url="'.U('goods_cate/edit',array('id'=>$arr['id'])).'" data-toggle="modal">'.L('edit').'</a>
							  <a data-toggle="AJAXdelete" data-url="'.U('goods_cate/delete',array('id'=>$arr['id'])).'" >'.L('del').'</a>
							';
			$arr['p_node'] = ($arr['pid'])? ' class="child-node-'.$arr['pid'].'"' : '';
			$array[] = $arr;
		}
		$str  = "<tr id='node-\$id' \$p_node >
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-toggle='AJAXedit' data-value='\$name' data-editype='word' data-editurl='".U('goods_cate/ajax_edit')."' data-editfield='name' data-editid='\$id'>\$name</span></td>
                <td>\$status</td>
             	<td>\$mangers</td>
                </tr>";

		$tree->init($array);
		$list = $tree->get_tree(0, $str);
		$this->assign('list', $list);
		
	
		$add_menu = array(
            'title' => L('goods_cate_add'),
            'url' => U('goods_cate/add'),
            'id' => 'good_cate_add',
		  	'width' => '500',
		 	'height'=>'350',
		 	'btn' =>'goods_save',
			'getajax'=>U('goods_cate/ajax_getchilds'),

		);
		$this->assign('add_menu', $add_menu);
		$this->display();

	}
	public function _before_add() {
		$pid = $this->_get('pid', 'intval', 0);
		if ($pid) {
			$spid = $this->_mod->where(array('id'=>$pid))->getField('spid');
			$spid = $spid ? $spid.$pid : $pid;
			$this->assign('spid', $spid);
		}
	}

	protected function _before_insert($data = '') {
		//检测分类是否存在
		if($this->_mod->name_exists($data['name'],$data['pid'])){
			$this->ajaxReturn(0, L('item_cate_already_exists'));
		}

		$data['spid'] = $this->_mod->get_spid($data['pid']);
		return $data;
	}
	protected function _before_update($data = '') {
		if ($this->_mod->name_exists($data['name'], $data['id'])) {
			$this->ajaxReturn(0, L('item_cate_already_exists'));
		}
		$item_cate = $this->_mod->field('img,pid')->where(array('id'=>$data['id']))->find();

		if ($data['pid'] != $item_cate['pid']) {
			$wp_spid_arr = $this->_mod->get_child_ids($data['id'], true);
			if (in_array($data['pid'], $wp_spid_arr)) {
				$this->ajaxReturn(0, L('cannot_move_to_child'));
			}
			$data['spid'] = $this->_mod->get_spid($data['pid']);
		}
		return $data;
	}
	public function ajax_getchilds() {
		$id = $this->_get('id', 'intval');
			
		$type = $this->_get('type', 'intval', null);
		$map = array('pid'=>$id);
		if (!is_null($type)) {
			$map['type'] = $type;
		}
		$return = $this->_mod->field('id,name')->where($map)->select();
		if ($return) {
			$this->ajaxReturn(1, L('operation_success'), $return);
		} else {
			$this->ajaxReturn(0, L('operation_failure'));
		}
	}

}