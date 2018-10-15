 	var nav={};
 	nav.switch=function(){
 		var this_url=location.href;
 		$('#navigator li a').each(function(item,index){
 				$(this).removeClass("select_style");
 				var now_url=$(this).attr("href");
 				if(this_url.indexOf(now_url)!=-1){
 					$(this).addClass("select_style");
 				}
 		});
 		$('#teacher_manage').bind('click',function(){
 			location.href='index.php/teacher';
 		})
 		$('#gif').bind('click',function(){
 			location.href='index.php/gif';
 		})
 		$('#money').bind('click',function(){
 			location.href='index.php/finance';
 		})
 		$('#manage_www').bind('click',function(){
 			location.href='index.php/admin';
 		})

 		$('#exit_admin').bind('click',function(){
	        $.messager.confirm('提示', '确定退出吗？', function(r){
	            if(r){
	                location.href="index.php/logout";
	            }
	        });
 		})
	}



	$(function(){
		nav.switch();
	});