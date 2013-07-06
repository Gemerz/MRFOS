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
<script src="__ROOT__/static/js/bootstrap-datepicker.js">
</script>
<script src="__ROOT__/static/js/fineuploader/fineupoad.min.js">
</script>
<link href="__ROOT__/static/js/fineuploader/fineuploader.css" rel="stylesheet">
<link href="__ROOT__/static/css/datepicker.css" rel="stylesheet">
<script>
    $(document).ready(function(){
        $('.AJAXselect').AJAXselect({
            url: "<?php echo U('goods/ajax_getchilds');?>"
        });
        $('.storage_sel').change(function(){
            var t = $(this).val();
            $('#storage_id').val(t);
        });
        $('#datepick').datepicker();
        $('#form').validation();
        var uploader = $('.uploadimg').fineUploader({

            request: {
                endpoint: "<?php echo U('goods/ajax_upload_img',array('id'=>$goods['id']));?>",
            },
            autoUpload: false,
            multiple: true,
            text: {
                uploadButton: '<i class="icon-plus icon-white"></i> 选择文件'
            }
        }).on('complete', function(event, id, fileName, responseJSON){
            if (responseJSON.success) {
                var img = responseJSON['data'][0]['url'];
                $('.imgzone').append('<div class="goods_img thumbnails pull-left" style="margin:5px;"><img class="thumbnail" src="data/timthumb.php?src=data/upload/img/' + img + '&w=150&h=105&zc=1&q=100"/></div>');
                
            }
        });
        $('.imgbtn').click(function(){
            uploader.fineUploader('uploadStoredFiles');
        });
        	$('#unit').blur(function(){
		var unit=$('#unit').val(),
			count=$('#count').blur().val();
			count = count ? count : 0;
			$('#price').val(unit*count);

		
	});
            $('.goods_img').hover(function(){
                $('.img_del').show();

            },function(){
                $('.img_del').hide();

            });
            $('.pop').popover();
    });
</script>
<hr>
<div class="mainbody span12">
    <div class="row">
        <div class="add_menu span5">
            <form class="form form-horizontal" action="<?php echo U('goods/edit');?>" method="post" id="form" enctype="multipart/form-data">
                <fieldset>
                    <legend>
                        <?php echo L('goods_edit');?>
                    </legend>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('supply');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="supply" name="supply" check-type="required" required-message="名字不能为空！"value="<?php echo ($goods["supply"]); ?>">
                        </div>
                    </div>
					       <div class="control-group">
                        <label class="control-label">
                            MRF
                        </label>
                        <div class="controls">
                            <input type="text" id="MRF" name="MRF" check-type="required" required-message="名字不能为空！"value="<?php echo ($goods["MRF"]); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_cate');?> :
                        </label>
                        <div class="controls">
                            <select class="AJAXselect" data-toggle="AJAXselect" data-pid="0" data-selected="<?php echo ($selected_ids); ?>">
                            </select>
                            <input type="hidden" name="cate_id" id="cate_id" value="<?php echo ($goods["cate_id"]); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('storage_cate');?> :
                        </label>
                        <div class="controls">
                            <select class="storage_sel" style="width:110px;">
                                <option value='0'><?php echo L('pls_select');?></option>
                                <?php if(is_array($storage_list)): $i = 0; $__LIST__ = $storage_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"
                                        <?php if($val["id"] == $goods['storage_id']): ?>selected="selected"<?php endif; ?>><?php echo ($val["name"]); ?>
                                    </option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <input type="hidden" name="storage_id" id="storage_id" value="<?php echo ($goods["storage_id"]); ?>"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_title');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="name" name="name" check-type="required" required-message="名字不能为空！" value="<?php echo ($goods["name"]); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('img_upload');?> :
                        </label>
                        <div class="controls">
                            <div class="uploadimg pull-left">
                            </div>
                            <span class="btn imgbtn pull-left" style="margin:1px 0 0 10px;">上传</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('title_en');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="ename" name="ename" check-type="required" required-message="名字不能为空！" value="<?php echo ($goods["ename"]); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_code');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="code" name="code" check-type="required" required-message="名字不能为空！" value="<?php echo ($goods["code"]); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_place');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="place" name="place" check-type="required" required-message="名字不能为空！" value="<?php echo ($goods["place"]); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_size');?> :
                        </label>
                        <div class="controls">
                            <input type="text" id="size" name="size" check-type="required" required-message="名字不能为空！" value="<?php echo ($goods["size"]); ?>">
                        </div>
                    </div>
              	   <div class="control-group">
        <label class="control-label"><?php echo L('goods_count');?> :</label>
        <div class="controls">
            <input type="text" id="count" name="count" check-type="required" required-message="名字不能为空！"value="<?php echo ($goods["count"]); ?>" onkeyup="value=value.replace(/[^\d]/g,'')">
        </div>
    </div>
	  <div class="control-group">
        <label class="control-label"><?php echo L('goods_unit');?> :</label>
        <div class="controls">
            <input type="text" id="unit" name="unit" check-type="required" required-message="名字不能为空！"value="<?php echo ($goods["unit"]); ?>" onkeyup="value=value.replace(/[^\d.]/g,'')"  >
        
		</div>
    </div>
	   <div class="control-group">
        <label class="control-label"><?php echo L('goods_price');?> :</label>
        <div class="controls ">
            <input type="text" id="price" name="price" check-type="required" required-message="名字不能为空！"value="<?php echo ($goods["price"]); ?>"onkeyup="value=value.replace(/[^\d.]/g,'')"  >
       
	    </div>
    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('goods_add_time');?> :
                        </label>
                        <div class="controls">
                            <div class="input-append date" id="datepick" data-date="" data-date-format="yyyy-mm-dd">
                                <input name="add_time" id="add_time" class="span2" size="16" type="text" value="<?php echo (substr($goods["add_time"],0,10)); ?>"><span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>
                    </div>
                        <div class="control-group">
        <label class="control-label"><?php echo L('request_by');?> :</label>
        <div class="controls">
            <input type="text" id="request_by" name="request_by" value="<?php echo ($goods["request_by"]); ?>"check-type="required" required-message="名字不能为空！"  >
        
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo L('remark');?> :</label>
        <div class="controls">
            <input type="text" id="remark" name="remark" value="<?php echo ($goods["remark"]); ?>">
        
        </div>
    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <?php echo L('status');?> :
                        </label>
                        <div class="controls">
                            <?php if($goods['status'] == 0): ?><label class="radio inline">
                                    <input type="radio" name="status" id="status" value="0" checked='checked'><?php echo L('un-status');?>
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="status" id="status" value="1"><?php echo L('statused');?>
                                </label><?php else: ?>
                                <label class="radio inline">
                                    <input type="radio" name="status" id="status" value="0"><?php echo L('un-status');?>
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="status" id="status" value="1" checked='checked'><?php echo L('statused');?>
                                </label><?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn pull-right">
                        <?php echo L('save');?>
                    </button>
                </fieldset>
                <input type="hidden" value="<?php echo ($goods["id"]); ?>" name="id">
            </form>
        </div>
        <div class="imgzone span4">
            <legend>
                <?php echo L('goods_img');?>
            </legend>
            <?php if(is_array($goods_img)): $i = 0; $__LIST__ = $goods_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="goods_img thumbnails pull-left" style="margin:5px;">
                    <img class="pop thumbnail" src="data/timthumb.php?src=data/upload/img/<?php echo ($val["url"]); ?>&w=150&h=105&zc=1&q=100" data-content="<img src='data/timthumb.php?src=data/upload/img/<?php echo ($val["url"]); ?>&w=800&h=600&zc=1&q=100'>" data-html="true" rel="popover" data-placement="top" data-trigger="hover"/>
                     <a class="img_del" data-toggle="AJAXdelete" data-url="<?php echo U('goods/delete_img',array('id'=>$val['id']));?>"><?php echo L('del');?></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div><hr>   <div class="footer">
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