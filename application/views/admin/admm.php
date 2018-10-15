<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<form id="fm">
					<ul class="student_list">
						<li><span>管理员设置</span></li>		
						<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="btn_admin">新增管理员</a></li>
						<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="edit_pw_btn">修改密码</a></li>
					</ul>
				</form>
			</div>
			<div id="edit_ps">
				<form id="fff">
					<p>
						<label for="old_pw">旧密码:</label>
						<input type="password" name="old_pw" id="old_pw" class="easyui-validatebox" required=true>
					</p>
					<p>
						<label for="new_pw">新密码:</label>
						<input type="password" name="new_pw" id="new_pw" class="easyui-validatebox" required=true>
					</p>
					<p>
						<label for="new_pw_validate">新密码验证</label>
						<input type="password" name="new_pw_validate" id="new_pw_validate" class="easyui-validatebox" required=true>
					</p>
				</form>
			</div>
		</div>
		<div region="center" border="false" style="height:715px;width:100%;">
			<div class="easyui-layout" fit=true>
				<div region="west" border="false" style="height:100%;width:40%;border-right:1px solid #ccc">
					<div id="admin_list"></div>
				</div>
				<div region="center" border="false" style="height:100%;width:60%;">
					<form id="fom">
						<p>
							<label for="username">登录帐号:</label>
							<input type="text" name="username" id="username" class="easyui-validatebox" required=true>&nbsp;<span>初始密码：123456，请及时修改初始密码。</span>
						</p>
						<p>
							<label for="myname">姓名:</label>
							<input type="text" name="myname" id="myname" class="easyui-validatebox" required=true>
						</p>
						<p>
							<label for="admin_type">类型:</label>
							<select class="easyui-combobox" id="admin_type" name="admin_type" style="width:153px;">
								<option value="0">普通管理员</option>
								<option value="1">超级管理员</option>
							</select>
						</p>
						<p>
							<label for="myphone">电话:</label>
							<input type="text" name="myphone" id="myphone">
						</p>
						<p>
							<label for="admin_remarks">备注:</label>
							<input type="text" name="admin_remarks" id="admin_remarks">
						</p>
						<p>
							<a href="javascript:void(0)" iconCls="icon-save" class="easyui-linkbutton" id="save_admin">保存</a>
						</p>
					</form>
				</div>
				<div id="edit_password">
					<label></label>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="data\js\admm.js"></script>
	<link rel="stylesheet" type="text/css" href="data\css\admm.css">
