<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>登陆中心-FRD物资信息系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Le styles -->
        <link href="__ROOT__/static/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }
            
            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
                -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
                box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            }
            
            .form-signin .form-signin-heading, .form-signin .checkbox {
                margin-bottom: 10px;
            }
            
            .form-signin input[type =
            "text"], .form-signin input[type = "password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }
			.login_alert{display:none;}
        </style>
        <link href="__ROOT__/static/css/bootstrap-responsive.css" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="__ROOT__/static/js/html5shiv.js"></script>
        <![endif]--><!-- Fav and touch icons -->
     
        <link rel="shortcut icon" href="__ROOT__/static/ico/favicon.png">
    </head>
    <body>
        <div class="container">
            <form class="form-signin" action="<?php echo U('index/login');?>" method="post" id="myform">
                <h2 class="form-signin-heading text-center">FRD物资信息系统</h2>
                <input type="text" class="input-block-level" placeholder="<?php echo L('login_username');?>" name="username" id="username">
				<input type="password" class="input-block-level" placeholder="<?php echo L('login_password');?>" name="password" id="password">
				<label>验证码：<input class="text vifity" type="text" name="verify_code" id="verify_code" style="width:80px;height:12px;margin:2px 10px 0 0;" /><img title="<?php echo (L("refresh_verify_code")); ?>" class="verify_img" src="<?php echo U('index/verify_code', array('t'=>time()));?>" />
               </label>
		
                <button class="btn btn-large btn-primary"style="margin:20px 0;" type="submit" id="login">
                    登陆
                </button>
				<label class="alert login_alert">
					<p class="pw_error">密码错误</p>
					<p class="pw_usr_em">用户不存在</p>
					<p class="pw_usr_er">用户或密码错误</p>
					<p class="vc_er">验证码错误</p>
					
				</label>
            </form>
			<div class="modal hide fade login_modal">
 
 			 <div class="modal-body">
   				 <p>One fine body…</p>
  				</div>
  
			</div>
        </div>
  
        <script src="__ROOT__/static/js/jquery.js"></script>
		<script src="__ROOT__/static/js/bootstrap-modal.js"></script>
		 
<script>
$(function(){
    if(self != top){
        top.location = self.location;
    }
    $(".verify_img").click(function(){
		
        var timenow = new Date().getTime();
        $(this).attr("src","<?php echo U('index/verify_code');?>&t="+timenow)
    });
	$('#login').click(function(e){
	 e.preventDefault();
	var $usr =$('#username').val(),
	$pw = $('#password').val(),
	$vc = $('#verify_code').val();	
	$.post("<?php echo U('index/login');?>",{username:$usr,password:$pw,verify_code:$vc},function(data) {
		
	if(data['msg'] =='usr_em' && data['status']== 0){
		$('.login_alert').css({display:'block'}).children('.pw_usr_em').css({display:'block'}).siblings().css({display:'none'});
		
		}else if(data['msg'] =='PW_ERROR'){
		
		$('.login_alert').css({display:'block'}).children('.pw_error').css({display:'block'}).siblings().css({display:'none'});
		
		} else if (data['msg']=="vc_er"){
			$('.login_alert').css({display:'block'}).children('.vc_er').css({display:'block'}).siblings().css({display:'none'});
			console.log('fff');
			
		}else if(data['msg']=="OK"){
			window.location.href=data['data'];
		}
		});	
		setTimeout(function(){
			$('.login_alert').css({display:'none'});
		},2500);
		
	});

		
});
</script>
    </body>
</html>