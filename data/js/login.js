		var login={};
		login.init=function(){
			var bg_img = Math.floor(Math.random()*20+1);
			$("body").css("background","url(data/images/"+bg_img+".jpg)");

			$('#button_login').bind('click',function(){
				login.validate_logon();
			})

			$('#admin_pass').bind('keyup',function(e){
				if(e.keyCode==13){
					login.validate_logon();
				}
			})
		}
		login.validate_logon=function(){
			var username=$('#username').val();
			var password=$('#admin_pass').val();
			if(username==""){
				$.messager.alert('提示',"请输入用户名",'error',function(r){
					$('#username').focus();
				})
			}else if(password==""){
				$.messager.alert('提示',"请输入密码",'error',function(r){
					$('#admin_pass').focus();
				})
			}else{
				// 在用户名和密码都输入的情况下，向数据库进行验证
				$.post('index.php/login/validate_data',{username:username,password:password},function(result){
					if(result.success){
						window.location.href="index.php/home"
						// 如果帐号和密码成功，则跳转到后台首页
					}else{
						$.messager.alert('提示',"用户名或密码错误",'error',function(r){
							$('#username').focus();
						});
					}
				},'json')
			}
		}
		$(function(){
			login.init();
			
		})