<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url(); ?>"/>
	<title>画室登录</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="data\easyui\jquery-3.2.1.js"></script>
	<script type="text/javascript" src="data\easyui\jquery.easyui.min.js"></script>
	<script type="text/javascript" src="data\easyui\locale\easyui-lang-zh_CN.js"></script>
	<link rel="stylesheet" type="text/css" href="data\easyui\themes\default\easyui.css">
	<link rel="stylesheet" type="text/css" href="data\easyui\themes\icon.css">
	<style type="text/css">
	</style>
</head>
<body>
	<div id="login_window">
		<div id="on"><span>系统登录</span></div>
		<div id="logon_form">
			<form id="fom">
				<p>
					<label>USERNAME/用户名</label>
					<input type="text" name="username" id="username">
				</p>
				<p>
					<label style="margin-right:105px;">PASSWORK/密码</label>
					<input type="password" name="admin_pass" id="admin_pass">
				</p>
				<p>
					<a href="javascript:void(0)" name="button_login" id="button_login">登录</a>
				</p>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="data\js\login.js"></script>
	<link rel="stylesheet" type="text/css" href="data\css\login.css">
</body>
</html>