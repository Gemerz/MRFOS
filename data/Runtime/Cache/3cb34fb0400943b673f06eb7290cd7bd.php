<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FRD物资信息系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="GSOA系统,简单的一个CRM开源系统">
        <meta name="author" content="gemer zhang">
        <link href="__ROOT__/static/css/bootstrap.css" rel="stylesheet">
        <link href="__ROOT__/static/css/main.css" rel="stylesheet">
        <link href="__ROOT__/static/css/bootstrap-responsive.css" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="__ROOT__/static/js/html5shiv.js"></script>
        <![endif]--><!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="__ROOT__/static/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="__ROOT__/static/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="__ROOT__/static/ico/apple-touch-icon-72-precomposed.png">
        <link rel="shortcut icon" href="__ROOT__/static/ico/favicon.png">
        <script src="__ROOT__/static/js/jquery.js"></script>
        <script src="__ROOT__/static/js/bootstrap.js"></script>
		<script src="__ROOT__/static/js/bootstrap-AJAXselect.js"></script>
		<script src="__ROOT__/static/js/bootstrap-AJAXedit.js"></script>
        <script src="__ROOT__/static/js/admin/GSOA.js"></script>
		<script src="__ROOT__/static/js/bootstrap-validation.js"></script>
     <script>
        
            $(document).ready(function(){
				$(".nav li").click(function(){
					$(this).addClass('active').siblings().removeClass('active');
				
				});
				
            });
        </script>
    </head>
    <body>
    	<div class="loading modal hide">
    		<div class="modal-header">
					<H3 class="text-center">Loading...</H3>
				</div>
			<div class="progress progress-striped active">
  		<div class="bar" style="width: 100%;"></div>
			</div>
			
    	</div>
		
        <div class="container">
            <div class="masthead">
               <h1 class="muted"><a href="__APP__/">FRD物资信息系统</a></h1>
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <ul class="nav">
                            	 <?php if($auth["role_id"] > 1): ?><li>
                                       <a href="__APP__/goods">零件列表</a>
                                </li>
									        <li>
                                     <a href="#">仓库管理</a>
                                </li>
                                <li>
                                   <a href="#">管理人员</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li>
									<?php else: ?>
								 <li class="dropdown">
                                    <a id="kq" class="dropdown-toggle" data-toggle="dropdown" href="__APP__/goods">库存管理 <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="kq">
                                        <li role="presentation">
                                            <a href="__APP__/goods">零件列表</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="__APP__/goods_cate">零件分类</a>
                                        </li>
                                    </ul>
                                </li>
								        <li>
                                     <a href="__APP__/storage">仓库管理</a>
                                </li>
                                <li>
                                   <a href="__APP__/admin">管理人员</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li>
                                <li>
                                    <a href="#">预留栏目</a>
                                </li><?php endif; ?>
                        
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.navbar -->
            </div>
			  <div class="main_head">
                <?php if(!empty($add_menu)): if($auth["role_id"] > 1): else: ?>
                     	 <a data-url="<?php echo ($add_menu["url"]); ?>" role="button" data-toggle="modal" class="<?php echo ($add_menu["id"]); ?> btn btn-info"><?php echo ($add_menu["title"]); ?></a><?php endif; ?>
                    <div class="modal hide fade" id="<?php echo ($add_menu["id"]); ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h3><?php echo ($add_menu["title"]); ?></h3>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                <?php echo L('close');?>
                            </button>
                            <button class="<?php echo ($add_menu["btn"]); ?> btn btn-primary"type="submit">
                                <?php echo L('save');?>
                            </button>
                        </div>
                    </div>
					      <div class="modal hide fade" id="editing">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h3> <?php echo L('edit');?></h3>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                <?php echo L('close');?>
                            </button>
                            <button class="editingbtn btn btn-primary"type="submit">
                                <?php echo L('save');?>
                            </button>
                        </div>
                    </div><?php endif; ?>
            </div>
<script type="text/javascript">
  $(document).ready(function(){

  	$('#search').on('click',function(){
	 var search_val =$("#search_input").blur().val(),
	 	 type_val =$(".search_type").change().val();

			if(search_val == 0){
				
			alert('搜索内容不为空');
			return false;
		};
	$.post('<?php echo U("goods/Ajax_search");?>',{keyword:search_val,type:type_val},function(data){
		if(data['status']==0){
		$('.table').remove();
		$('#pages').remove();
		$('.mainbody').html('<h2 align="center">OPP!'+data['msg']+'</h2>');
	}else if(data['status']==1){
	$('.table tbody tr').remove();
	$('#pages').remove();
	$('.table tbody').html(data['msg']);
	
	}
		});
			return true;	
	});
		$('.see_img_btn').on('click',function(e){
			e.stopPropagation();
			var id=$(this).attr('data-id');
			$.get('<?php echo U("goods/Ajax_SeeImg");?>',{id:id},function(data){
                        var data = eval("(" + data + ")");
                         $('#see_photo .modal-body').html(data['data']);
					 	 $('#see_photo .item:first-child').addClass('active');
                         $('#see_photo').modal('show');
							
                    }, 'html');
			
		})
	 $(".carousel").carousel();

	
	});
</script>
<div class="goods_bar">
    <form class="form-search pull-right">
        <div class="input-append">
        	<select class="search_type" style="width:110px;" >
			<option value="0">-选择搜索-</option>
			<option value="1">MRF</option>
			<option value="2"> <?php echo L('goods_title');?></option>
			<option value="3"> <?php echo L('supply');?></option>
				
			</select>
          <input type="text" class="span2" id="search_input">
        
            <div class="btn-group">
                
               
            </div>
			  
        <button id="search" class="btn dropdown-toggle" data-toggle="dropdown">
                    搜索
                </button></div>
		 <input type="text" class="span2 hide" id="search_type" >
    </form>
	
	   <?php if($auth["role_id"] > 1): ?><a  class="btn btn-info"></a>
		<?php else: ?>
	    <a href="<?php echo U('goods/add');?>" class="btn btn-info"><?php echo L("goods_add");?></a><?php endif; ?>
   
</div>
<hr>
<div class="mainbody">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>
                </th>
                <th>
                    ID
                </th>
				  <th>
                   MRF
                </th>
                <th>
                    <?php echo L('goods_title');?>
                </th>
				  <th>
                    <?php echo L('supply');?>
                </th>
				
                <th>
                    <?php echo L('goods_cate');?>
                </th>
                <th>
                    <?php echo L('storge');?>
                </th>
				   <th>
                    <?php echo L('goods_unit');?>
                </th>
				   <th>
                    <?php echo L('goods_price');?>
                </th>
                <th>
                    <?php echo L('goods_count');?>
                </th>
                <th>
                    <?php echo L('in_time');?>
                </th>
                 <th>
                    <?php echo L('request_by');?>
                </th>
                <th>
                    <?php echo L('mangers');?>
                </th>
            </tr>
        </thead>
        <tbody>
        
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input type="checkbox" value="<?php echo ($val["id"]); ?>">
                    </td>
                    <td>
                        <?php echo ($val["id"]); ?>
                    </td>
					  <td>
                        <?php echo ($val["MRF"]); ?>
                    </td>
                    <td>
                    	
                        <?php echo ($val["name"]); ?>
                    </td>
					    <td>
                        <?php echo ($val["supply"]); ?>
                    </td>
                    <td>
                        <?php echo ($cate_list[$val['cate_id']]); ?>
                    </td>
                    <td>
                        <?php echo ($storage_arr[$val['storage_id']]); ?>
                    </td>
					 <td>
                        <?php echo ($val["unit"]); ?>
                    </td>
                    <td>
                        <?php echo ($val["price"]); ?>
                    </td>
					  <td>
                        <?php echo ($val["count"]); ?>
                    </td>
                    <td>
                        <?php echo (substr($val["add_time"],0,10)); ?>
                    </td>
                     <td>
                        <?php echo ($val["request_by"]); ?>
                    </td>
                    <td>
                    	 <?php if($auth["role_id"] > 1): else: ?>
						<a class="see_img_btn" href="#" role="button" data-toggle="modal" data-id="<?php echo ($val["id"]); ?>"><?php echo L('see_photo');?></a>
                        <a href="<?php echo U('goods/edit',array('id'=>$val['id']));?>"><?php echo L('edit');?></a>
                        <a data-toggle="AJAXdelete" data-url="<?php echo U('goods/delete',array('id'=>$val['id']));?>"><?php echo L('del');?></a><?php endif; ?>
                        
                    </td>
					
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div id="pages">
        <?php echo ($page); ?>
    </div>
	      <div class="modal hide fade" id="see_photo">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h3>查看相片</h3>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                                <?php echo L('close');?>
                            </button>
                         
                        </div>
                    </div>
</div>
<hr>   <div class="footer">
        <p>&copy; GSOA 2013.Make By gemerz. &nbsp;&nbsp;|&nbsp;&nbsp;Hi,&nbsp;<?php echo ($auth["username"]); ?>&nbsp;<a class="login_out"><?php echo L("login_out");?></a></p>
      </div>

    </div> <!-- /container -->

 <script type="text/javascript">
 $(document).ready(function(){
 	$('.login_out').click(function(){
	$.get("<?php echo U('index/login_out');?>",function(data) {

	if(data['msg']=="OK"){
			window.location.href=data['data'];
		}

});

 	});


 });
 </script>

  </body>
</html>