<?php
class adminAction extends oabaseAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('admin');
	}
	public function index(){
		
		$tree = new Tree();
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$result = $this->_mod->select();
		
		$array = array();
		foreach ($result as $arr) {
			$arr['status'] ='<i data-editid="'.$arr['id'].'" data-editype="single" data-editfield="status" data-toggle="AJAXedit" data-editurl="'.U('admin/ajax_edit').'" class="'.($arr['status'] == 0 ? 'icon-remove' : 'icon-ok').'" data-value="'.$arr['status'].'"></i>';
			$arr['mangers'] ='<a class="editing" data-id="'.$arr['id'].'" href="#editing" data-orgurl="'.U('admin/edit').'" data-url="'.U('admin/edit',array('id'=>$arr['id'])).'" data-toggle="modal">'.L('edit').'</a>
							  <a data-toggle="AJAXdelete" data-url="'.U('admin/delete',array('id'=>$arr['id'])).'" >'.L('del').'</a>
							';
			$arr['p_node'] = ($arr['pid'])? ' class="child-node-'.$arr['pid'].'"' : '';
			$array[] = $arr;
		}
		$auth = array();
		$auth =session('admin');
		if($auth['role_id'] >1){
			$str  = "<tr id='node-\$id' \$p_node >
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-toggle='AJAXedit' data-value='\$name' data-editype='word' data-editurl='".U('admin/ajax_edit')."' data-editfield='name' data-editid='\$id'>\$username</span></td>
                <td>\$status</td>
             	<td>\$mangers</td>
                </tr>";
		}else{
		
		}
		
		$str  = "<tr id='node-\$id' \$p_node >
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-toggle='AJAXedit' data-value='\$name' data-editype='word' data-editurl='".U('admin/ajax_edit')."' data-editfield='name' data-editid='\$id'>\$username</span></td>
                <td>\$status</td>
             	<td>\$mangers</td>
                </tr>";

		$tree->init($array);
		$list = $tree->get_tree(0, $str);
		$this->assign('list', $list);
		
		
		$add_menu = array(
            'title' => L('admin_add'),
            'url' => U('admin/add'),
            'id' => 'admin_add',
		  	'width' => '500',
		 	'height'=>'350',
		 	'btn' =>'save',
			'getajax'=>U('admin/ajax_getroles'),

		);
		$this->assign('add_menu', $add_menu);
		$this->display();

	}
	
	
	public function ajax_getroles() {
		$list = M('role')->select();
		$this->ajaxReturn(1, L('operation_success'), $list);
	}

}