<?php
class indexAction extends oabaseAction {
	public function _initialize() {
		parent::_initialize();

	}
	public function index(){

		$this->display();

	}
	public function login(){
		IF(IS_POST){
			$username = $this->_post('username', 'trim');
			$password = $this->_post('password', 'trim');
			$verify_code = $this->_post('verify_code', 'trim');
			$admin = M('admin')->where(array('username'=>$username, 'status'=>1))->find();
		
			if(session('verify') != md5($verify_code)){
				$this->ajaxReturn(0,'vc_er');
			}
			if (!$admin) {
				$this->ajaxReturn(0,'usr_em');
			}
			if ($admin['password'] != md5($password)) {

				$this->ajaxReturn(0,'PW_ERROR');
			}
			session('admin', array(
                'id' => $admin['id'],
                'role_id' => $admin['role_id'],
                'username' => $admin['username'],
			));
			$this->ajaxReturn(1,'OK',__ROOT__.'/index/index');

		}else{
			$this->display();
		}
	}

	public function login_out(){

			if(isset($_SESSION['admin'])) {
			unset($_SESSION['admin']);
			
			$this->ajaxReturn(1,'OK',__ROOT__.'/index/index');
		}else {
			$this->ajaxReturn(0,'already');
		}
	}
	public function verify_code() {
			
		Image::buildImageVerify(4,1,'gif','50','24');

	}
	public function  get_storage(){
		
	$frd_storage = M('goods')->where('storage_id=1')->getField('id,name,price');
	$ford_storage = M('goods')->where('storage_id=2')->getField('id,name,price');
	$count =array_sum($this->one_array_values($frd_storage, 'price'));
	$list = array();
	foreach ($frd_storage as $val){
		$val['y']=round($val['price']*100/$count,2);
		unset($val['id']);
		unset($val['price']);
		$list[]=$val;
		
	}
	$list1 = array();
		foreach ($ford_storage as $val){
		$val['y']=round($val['price']*100/$count,2);
		unset($val['id']);
		unset($val['price']);
		$list1[]=$val;
		
	}

	$this->ajaxReturn(1,$list,$list1,"OK");
	
	}
}