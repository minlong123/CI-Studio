<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url(); ?>"/>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<script type="text/javascript" src="data\easyui\jquery-3.2.1.js"></script>
	<script type="text/javascript" src="data\easyui\jquery.easyui.min.js"></script>
	<script type="text/javascript" src="data\easyui\locale\easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="data\js\header.js"></script>
	<link rel="stylesheet" type="text/css" href="data\easyui\themes\default\easyui.css">
	<link rel="stylesheet" type="text/css" href="data\easyui\themes\icon.css">
	<link rel="stylesheet" type="text/css" href="data\css\header.css">
	<style type="text/css">
	</style>
	<script type="text/javascript">
          function closes(){
			$("#Loading").fadeOut(function(){
                $(this).remove();
            });
          }
          var pc;
          $.parser.onComplete = function(){
             if(pc) clearTimeout(pc);
             pc = setTimeout(closes, 1000);
          }
      // $.parser.onComplete是easyui语法解析完毕之后触发的事件,这个事件是十分实用的。比如在加载一个页面时,页面并非立即就展现的,由于parser在dom加载完毕之后才会对整个页面进行解析,当页面组件使用较多的时候,完整的解析组件必然须要耗费较多的时间,这一过程可能就会出现短暂的界面混乱现象。解决的办法就是:利用onComplete事件再结合一个加载遮罩层就攻克了
      // #DDDDDB
	</script>
</head>
<body class="easyui-layout" id="bodyy">
	<div id='Loading' style="position:absolute;z-index:1000;top:0px;left:0px;width:100%;height:100%;background:rgba(255,255,255,1);text-align:center;padding-top:20%;">
		<div style="height:300px;width:700px;margin:100px auto">
			<marquee direction="right" scrolldelay="5" behavior="alternate">
			<h1 style="color:red">
				正在加载中···
			</h1>
			</div>
			</marquee>
		</div>
	</div> 
	<!-- 导航内容开始 -->
	<div region="north" border="false" style="height:50px;border-bottom:1px solid #ccc;overflow:hidden;" id="navigation">
		<ul id="navigator">
			<li><a href="index.php/home" class="home select_style">首页</a></li>
			<li><a href="index.php/course">课程</a></li>
			<li><a href="index.php/student">学员</a></li>
			<li><a href="index.php/integral">积分</a></li>
		</ul>
		<ul id="navigation_Other">
			<li>
				<a href="javascript:void(0)" class="easyui-menubutton" data-options="menu:'#content'" iconCls="icon-more" id="set" style="line-height:50px;">设置</a>
				<div id="content" style="width:50px;">
					<div id="gif">礼物</div>
					<div id="money">财务管理</div>
					<div class="menu-sep"></div>
					<div id="teacher_manage">教师管理</div>
					<div id="manage_www">管理员</div>
				</div>
			</li>
			<li><a href="javascript:void(0)"><?php echo $this->session->userdata('username');?></a></li>
			<li><a href="javascript:void(0)" id="exit_admin">退出</a></li>
		</ul>
	</div>
	<!-- 导航内容结束 -->