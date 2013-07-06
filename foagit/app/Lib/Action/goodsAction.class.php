<?php
class goodsAction extends oabaseAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('goods');
		$this->_mod_cate = D('goods_cate');

	}

	public function index(){

	$this->_list($this->_mod,'','add_time','DESC ');
	
		$res = $this->_mod_cate->field('id,name')->select();
		$cate_list = array();
		foreach ($res as $val) {
			$cate_list[$val['id']] = $val['name'];
		}
		$s_arr = M('storage')->field('id,name')->select();
		$storage_arr= array();
		foreach ($s_arr as $val){
			$storage_arr[$val['id']] = $val['name'];
		}
		$this->assign('cate_list', $cate_list);
		$this->assign('storage_arr', $storage_arr);
		$this->display();
		
	}
	public  function add(){
		if (IS_POST) {
			if (false === $data = $this->_mod->create()) {
				$this->error($this->_mod->getError());
			}
			
		 $r =$this->_mod->add($data);
		 if( $r === FALSE){
		 	 
		 }else{
		 	$this->redirect(U('goods/index'));
		 }
		}else{
			$storage_list=M('storage')->select();
			$this->assign('storage_list',$storage_list);
			$this->display();
		}
	}
	public  function edit(){

		if (IS_POST) {
			if (false === $data = $this->_mod->create()) {
				$this->error($this->_mod->getError());
			}
			$goods_id =$data['id'];
		 $r =$this->_mod->where(array('id'=>$goods_id))->save($data);
		 $date_dir = date('ym/d/');
		 if( $r === FALSE){
		 	 
		 }else{
		 	$this->redirect(U('goods/index'));
		 }
		}else{
		 $id = $this->_get('id','intval');
		 $goods = $this->_mod->where(array('id'=>$id))->find();
		 	
		 $spid = $this->_mod_cate->where(array('id'=> $goods['cate_id']))->getField('spid');
		 if( $spid==0 ){
		 	$spid =  $goods['cate_id'];
		 }else{
		 	$spid .=  $goods['cate_id'];
		 }
		 $goods_img = M('goods_img')->where('cate_id='.$id)->select();
		 $goods_img && $this->assign('goods_img',$goods_img);
		 $storage_list=M('storage')->select();
		 $this->assign('storage_list',$storage_list);
		 $this->assign('selected_ids',$spid);
		 $this->assign('goods',$goods);
		 $this->display();
		}

	}
	public function delete(){

		$mod = D($this->_name);
		$pk = $mod->getPk();
		$ids = trim($this->_request($pk), ',');

		$re = M('goods_img')->where('cate_id='.$ids)->select();
		foreach ($re as $val) {
			@unlink('data/upload/img/'.$val['url']);
		}
		$t=M('goods_img')->where('cate_id='.$ids)->delete();
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
		public function delete_img(){

		$id = $this->_get('id', 'intval');
		$re = M('goods_img')->where('id='.$id)->find();
		if($re){

			@unlink('data/upload/img/'.$re['url']);
		$t = M('goods_img')->where('id='.$id)->delete();
		if($t){
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
		}else{
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
		}

		}else{
			IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));

		}

	}
	public function ajax_getchilds() {
		$id = $this->_get('id', 'intval');
			
		$type = $this->_get('type', 'intval', null);
		$map = array('pid'=>$id,'status'=>1);

		$return = $this->_mod_cate->field('id,name')->where($map)->select();
		if ($return) {
			$this->ajaxReturn(1, L('operation_success'), $return);
		} else {
			$this->ajaxReturn(0, L('operation_failure'));
		}
	}
	public function ajax_upload_img() {


		if(!empty($_FILES['qqfile'])){
			$id = $this->_get('id', 'intval', 0);
			$img_list=array();
			$img=$_FILES['qqfile'];
			$date_dir = date('ym/d/');
			$result=$this->_upload($img,'img/'.$date_dir, array(
                    'width' => '800',
                    'height' => '600',
					'suffix'=>'',
			));
			foreach( $result['info'] as $key=>$val ){
				$img_list[] = array(
                        	'cate_id'     => $id,
                            'url'    => $date_dir . $val['savename'],
                            'order'  => $key + 1,
				);
					

			}
			$img_list && M('goods_img')->addAll($img_list);

			$this->ajaxReturn(1, L('operation_success'), $img_list ,true);
		}

	}
	public function Ajax_SeeImg(){
	$id = $this->_get('id', 'intval');
	$arr =array();
	
	$imglist = M('goods_img')->where('cate_id='.$id)->select();
		
		foreach ($imglist as $val){
		array_push($arr,'<div class="item"><img src="/data/upload/img/'.$val['url'].'" /></div>');
	
		}
	$arr_str= implode($arr);
	
	$html ='<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">
	'.$arr_str.'
	</div>
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
	';
	$no_img ='<img src="http://placehold.it/600x250&text=No images" align="center"/>';
	if ($arr){
	$this->ajaxReturn(1, L('operation_success'), $html ,true);
	}else{
	$this->ajaxReturn(0,  L('operation_failure'),$no_img);
	}
	
	
	}
	public function Ajax_search(){

		$keyword=$this->_request('keyword', 'trim');
		$type=$this->_request('type', 'trim');
		switch ($type){
			case 0:
				$_type='MRF';
				break;
			case 1:
				$_type='MRF';
				break;
			case 2:
				$_type='name';
				break;
			case 3:
				$_type='supply';
				break;
		}
		$map[$_type]=array('like','%'.$keyword.'%');
		$ajax_list=$this->_mod->where($map)->select();
		$arr= array();
		$res = $this->_mod_cate->field('id,name')->select();
		$cate_list = array();
		foreach ($res as $val) {
			$cate_list[$val['id']] = $val['name'];
		}
		$s_arr = M('storage')->field('id,name')->select();
		$storage_arr= array();
		foreach ($s_arr as $val){
			$storage_arr[$val['id']] = $val['name'];
		}

		foreach ($ajax_list as $val){
			$name =$cate_list[$val['cate_id']];
			$storage=$storage_arr[$val['storage_id']];
			$arrs = array();
			$arrs = session('admin');
			
			$man ="<a href='".U('goods/edit',array('id'=>$val[id]))."'>".L('edit')."</a>
                 <a data-toggle='AJAXdelete' data-url='".U('goods/delete',array('id'=>$val[id]))."'>".L('del')."</a>";
			$parrton = $arrs['role_id'] > 1 ? " " : $man;
			$return_list['html']="<tr><td> <input type='checkbox' value=".$val[id]."></td>
						     <td>$val[id]</td>		
						     <td>$val[MRF]</td>	
						     <td>$val[name]</td>
						     <td>$val[supply]</td>
						     <td>$name</td>
						     <td>$storage</td>	
						     <td>$val[unit]</td>	
						      <td>$val[price]</td>
						       <td>$val[count]</td>	
						       <td>".substr($val[add_time],0,10)."</td>	
						         <td>$val[request_by]</td>	
						       <td>$parrton</td>		
				</tr>";
			$arr[] = $return_list['html'];

		}
		$return_data =implode('',$arr);

		if($return_data){
			$this->ajaxReturn('1',$return_data);
		}
		else{
			$this->ajaxReturn('0',L('no_search'));
		}



	}
}