<?php
class oabaseAction extends Action {
	protected $_name = '';
	public function _initialize() {
		$this->_name = $this->getActionName();
		$this->check_priv();
		$this->auth();
		
	}
	public function check_priv(){

		if ( (!isset($_SESSION['admin']) || !$_SESSION['admin']) && !in_array(ACTION_NAME, array('login','verify_code')) ) {
			$this->redirect('index/login');
		}

	}
	public function auth(){
		$role = M('role')->select();
		$this->assign('auth',session('admin'));
	}
	public function index() {
		// $map = $this->_search();
		$mod = D($this->_name);
		//   !empty($mod) && $this->_list($mod, $map);
		
		$this->display();
	}
	public function add() {
		$mod = D($this->_name);
		if (IS_POST) {
			if (false === $data = $mod->create()) {
				IS_AJAX && $this->ajaxReturn(0, $mod->getError());
			}
			if (method_exists($this, '_before_insert')) {
				$data = $this->_before_insert($data);

			}
			if( $mod->add($data)){
				if( method_exists($this, '_after_insert')){
					$id = $mod->getLastInsID();
					$this->_after_insert($id);
				}
				IS_AJAX && $this->ajaxReturn(1,L('operation_success'));
			} else {
				IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			}
		} else {
			if (IS_AJAX) {
				$response = $this->fetch();
				$this->ajaxReturn(1, '', $response);
			} else {
				$this->display();
			}
		}
	}

	public function edit()
	{
		$mod = D($this->_name);
		$pk = $mod->getPk();
		if (IS_POST) {
			if (false === $data = $mod->create()) {
				IS_AJAX && $this->ajaxReturn(0, $mod->getError());
				$this->error($mod->getError());
			}
			if (method_exists($this, '_before_update')) {
				$data = $this->_before_update($data);
			}
			if (false !== $mod->save($data)) {
				if( method_exists($this, '_after_update')){
					$id = $data['id'];
					$this->_after_update($id);
				}
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
			} else {
				IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			}
		} else {
			$id = $this->_get($pk, 'intval');
			$info = $mod->find($id);
			$this->assign('info', $info);
			if (IS_AJAX) {
				$response = $this->fetch();
				$this->ajaxReturn(1, '', $response);
			} else {
				$this->display();
			}
		}
	}
	public function delete()
	{
		$mod = D($this->_name);
		$pk = $mod->getPk();
		$ids = trim($this->_request($pk), ',');
		if ($ids) {
			if (false !== $mod->delete($ids)) {
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			} else {
				IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			}
		} else {
			IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
		}
	}
	public function ajax_edit()
	{
		//AJAX修改数据
		$mod = D($this->_name);
		$pk = $mod->getPk();
		$id = $this->_get($pk, 'intval');
		$field = $this->_get('field', 'trim');
		$val = $this->_get('val', 'trim');
		//允许异步修改的字段列表  放模型里面去 TODO
		$mod->where(array($pk=>$id))->setField($field, $val);
		$this->ajaxReturn(1);
	}

	protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
	{
		//排序
		$mod_pk = $model->getPk();
		if ($this->_request("sort", 'trim')) {
			$sort = $this->_request("sort", 'trim');
		} else if (!empty($sort_by)) {
			$sort = $sort_by;
		} else if ($this->sort) {
			$sort = $this->sort;
		} else {
			$sort = $mod_pk;
		}
		if ($this->_request("order", 'trim')) {
			$order = $this->_request("order", 'trim');
		} else if (!empty($order_by)) {
			$order = $order_by;
		} else if ($this->order) {
			$order = $this->order;
		} else {
			$order = 'DESC';
		}

		//如果需要分页
		if ($pagesize) {
			$count = $model->where($map)->count($mod_pk);
			$pager = new Page($count, $pagesize);
		}
		$select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
		$this->list_relation && $select->relation(true);
		if ($pagesize) {
			$select->limit($pager->firstRow.','.$pager->listRows);
			$page = $pager->show();
			$this->assign("page", $page);
		}
		$list = $select->select();
		$this->assign('list', $list);
	}
	protected function _upload_init($upload) {
		$allow_max = 7000; //读取配置
		$allow_exts = array('jpg', 'gif', 'png', 'jpeg'); //读取配置
		$allow_max && $upload->maxSize = $allow_max * 1024;   //文件大小限制
		$allow_exts && $upload->allowExts = $allow_exts;  //文件类型限制
		$upload->saveRule = 'uniqid';
		return $upload;
	}
	/**
	 * 上传文件
	 */
	protected function _upload($file, $dir = '', $thumb = array(), $save_rule='uniqid') {
		$upload = new UploadFile();
		if ($dir) {
			$upload_path = 'data/upload/' . $dir . '/';
			$upload->savePath = $upload_path;
		}
		if ($thumb) {
			$upload->thumb = true;
			$upload->thumbMaxWidth = $thumb['width'];
			$upload->thumbMaxHeight = $thumb['height'];
			$upload->thumbPrefix = '';
			$upload->thumbSuffix = isset($thumb['suffix']) ? $thumb['suffix'] : '_thumb';
			$upload->thumbExt = isset($thumb['ext']) ? $thumb['ext'] : '';
			$upload->thumbRemoveOrigin = isset($thumb['remove_origin']) ? true : false;
		}
		//自定义上传规则
		$upload = $this->_upload_init($upload);
		if( $save_rule!='uniqid' ){
			$upload->saveRule = $save_rule;
		}

		if ($result = $upload->uploadOne($file)) {
			return array('error'=>0, 'info'=>$result);
		} else {
			return array('error'=>1, 'info'=>$upload->getErrorMsg());
		}
	}

function one_array_values($array, $field)
	{
		$result = array();
		if (is_array($array))
		{
			foreach ($array as $value)
			{
				if (isset($value[$field]))
				{
					$result[] = $value[$field];
				}
			}
		}
		return $result;
	}
	/**
	 * AJAX返回数据标准
	 *
	 * @param int $status
	 * @param string $msg
	 * @param mixed $data
	 * @param string $dialog
	 */
	protected function ajaxReturn($status=1, $msg='', $data='', $success='') {
		parent::ajaxReturn(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'success' => $success,
		));
	}
}