<link rel="stylesheet" type="text/css" href="data\css\student.css">
	<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<ul class="student_list">
					<li><span>学员管理</span></li>

					<li><input type="text" name="search_data" id="search_data"></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton searcc" iconCls="icon-search">查询</a></li>
					
					<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="add_students">增加学员</a></li>
					<li><a href="javascript:void(0)" iconCls="icon-search" class="easyui-linkbutton" id="Statistics">统计数据</a></li>
				</ul>
			</div>
		</div>

		<!-- 增加学员弹出框设置 -->
		<div id="addst" class="easyui-dialog" style="height:328px;width:800px;">
			<form id="fm">
				<p style="border-top:0px solid">
					<label for="student_name">姓名</label>
					<input type="text" id="student_name" name="student_name" class="easyui-validatebox" required=true style="height:40px;">
					<label for="student_initials">首字母</label>
					<input type="text" name="student_initials" id="student_initials" class="easyui-validatebox" required=true style="height:40px;">
					<label for="student_age">年龄</label>
					<input type="text" name="student_age" id="student_age" class="easyui-numberspinner" required="required" data-options="min:3,max:10" style="height:40px;width:181px;">
				</p>
				<p>
					<label for="student_birthday">生日</label>
					<input type="text" name="student_birthday" class="easyui-datebox" id="student_birthday" data-options="editable:false" style="height:40px;">
					<label for="parento">家长1</label>
					<input type="text" name="parento" id="parento" class="easyui-validatebox" required=true style="height:40px;">
					<label for="phoneo">电话1</label>
					<input type="text" name="phoneo" id="phoneo" class="easyui-validatebox" required=true style="height:40px;">
				</p>
				<p>
					<label for="sex">性别</label>
					<select id="sex" style="width:165px;height:40px;" name="sex" class="easyui-combobox">
						<option value="男">男</option>
						<option value="女">女</option>
					</select>
					<label for="parentt">家长2</label>
					<input type="text" name="parentt" id="parentt" style="height:40px;">
					<label for="phonet">电话2</label>
					<input type="text" name="phonet" id="phonet" style="height:40px;">
				</p>
				<p>
					<label for="address">家庭住址</label>
					<input type="text" name="address" id="address" class="easyui-validatebox" required=true style="width:165px;height:40px;">
					<label for="classType">班级类型</label>
					<select id="classType" name="classType" class="easyui-combobox" style="width:165px;height:40px;">
						<option value="默认班级">默认班级</option>
					</select>
					<label for="school">学校</label>
					<input type="text" name="school" id="school" style="height:40px;">
				</p>
				<p>
					<label for="student_data">报名日期</label>
					<input type="text" name="student_data" id="student_data" class="easyui-datebox" data-options="editable:false" style="width:165px;height:40px;">
					<label for="student_rest">剩余课时</label>
					<input type="text" name="student_rest" id="student_rest" class="easyui-numberspinner" data-options="min:0,max:200,editable:true" style="height:40px;">
					<label for="integral">积分</label>
					<input type="text" name="integral" id="integral" class="easyui-numberspinner" data-options="min:0,max:1000,editable:true,value:0,height:40" style="width:181px;">
				</p>
				<p>
					<label for="state">状态</label>
					<select id="state" name="state" class="easyui-combobox" style="width:165px;height:40px;">
						<option value="正常">正常</option>
						<option value="停课">停课</option>
					</select>
					<label for="remarks">备注</label>
					<input type="text" name="remarks" id="remarks" style="height:40px;">
				</p>
			</form>
		</div>
		<!-- 增加学员内容设置结束 -->


		<!-- 修改学员内容设置开始 -->
		<div id="edit_student" class="easyui-dialog" style="height:328px;width:800px;">
			<form id="edit_fm">
				<p style="border-top:0px solid">
					<label for="student_name">姓名</label>
					<input type="text" id="student_name" name="student_name" class="easyui-validatebox" required=true style="height:40px;">
					<label for="student_initials">首字母</label>
					<input type="text" name="student_initials" id="student_initials" class="easyui-validatebox" required=true style="height:40px;">
					<label for="student_age">年龄</label>
					<input type="text" name="student_age" id="student_age" class="easyui-numberspinner" required="required" data-options="min:3,max:10" style="height:40px;width:181px;">
				</p>
				<p>
					<label for="student_birthday">生日</label>
					<input type="text" name="student_birthday" class="easyui-datebox" id="student_birthday" data-options="editable:false" style="height:40px;">
					<label for="parento">家长1</label>
					<input type="text" name="parento" id="parento" class="easyui-validatebox" required=true style="height:40px;">
					<label for="phoneo">电话1</label>
					<input type="text" name="phoneo" id="phoneo" class="easyui-validatebox" required=true style="height:40px;">
				</p>
				<p>
					<label for="sex">性别</label>
					<select id="sex" style="width:165px;height:40px;" name="sex" class="easyui-combobox">
						<option value="男">男</option>
						<option value="女">女</option>
					</select>
					<label for="parentt">家长2</label>
					<input type="text" name="parentt" id="parentt" style="height:40px;">
					<label for="phonet">电话2</label>
					<input type="text" name="phonet" id="phonet" style="height:40px;">
				</p>
				<p>
					<label for="address">家庭住址</label>
					<input type="text" name="address" id="address" class="easyui-validatebox" required=true style="width:165px;height:40px;">
					<label for="classType">班级类型</label>
					<select id="classType" name="classType" class="easyui-combobox" style="width:165px;height:40px;">
						<option value="默认班级">默认班级</option>
					</select>
					<label for="school">学校</label>
					<input type="text" name="school" id="school" style="height:40px;">
				</p>
				<p>
					<label for="student_data">报名日期</label>
					<input type="text" name="student_data" id="student_data" class="easyui-datebox" data-options="editable:false" style="width:165px;height:40px;">
					<label for="student_rest">剩余课时</label>
					<input type="text" name="student_rest" id="student_rest" class="easyui-numberspinner" data-options="min:0,max:200,editable:true" style="height:40px;">
					<label for="integral">积分</label>
					<input type="text" name="integral" id="integral" class="easyui-numberspinner" data-options="min:0,max:1000,editable:true,value:0,height:40" style="width:181px;">
				</p>
				<p>
					<label for="state">状态</label>
					<select id="state" name="state" class="easyui-combobox" style="width:165px;height:40px;">
						<option value="正常">正常</option>
						<option value="停课">停课</option>
					</select>
					<label for="remarks">备注</label>
					<input type="text" name="remarks" id="remarks" style="height:40px;">
					<input type="hidden" name="student_id" id="student_id">
				</p>
			</form>
		</div>
		<!-- 修改学员内容设置结束 -->
		<!-- 新报名弹出框内容设置 -->
		<div id="new_student">
			<form id="fomm">
				<p>
					<label for="student_name">姓名</label>
					<input type="text" name="student_name" id="student_name">
				</p>
				<p>
					<label for="renew_date">续费日期</label>
					<input type="text" name="renew_date" id="renew_date" class="easyui-datebox" style="height:40px;">
				</p>
				<p>
					<label for="add_classhour">新增课时数</label>
					<input type="text" name="add_classhour" id="add_classhour" class="easyui-numberspinner" data-options="min:1,max:500,editable:true" style="height:40px;">
				</p>
				<p>
					<label for="remarks">备注</label>
					<input type="text" name="remarks" id="remarks" style="height:40px;">
				</p>
				<input type="hidden" name="student_id" id="student_id">
			</form>
		</div>
		<!-- 新报名弹出框内容结束 -->
		<!-- 搜索栏内容结束-->
		<!-- center内容开始 -->
		<div class="easyui-layout" fit=true style="background:#fafafa">
			<!-- 学员列表信息表内容开始 -->
			<div region="west" border="false" style="width:55%;height:100%;border-right:1px solid #ccc">
				<div class="easyui-datagrid" id="studata" style="width:100%;height:713px" ></div>
			</div>
			<div region="east" border="false" style="width:44.5%;height:100%;border:1px solid #ccc;float:right">
				<div class="easyui-layout" fit=true>
					<div region="north" border="false" style="height:380px;width:100%;border-bottom:1px solid #ccc">
						<!-- 学员详情内容开始 -->
						<div class="easyui-panel" id="student_details" style="height:100%;width:100%;" title="学员详情" iconCls="icon-man">
							<table border="0" cellspacing="0" cellpadding="0" style="height:100%;width:100%;padding:10px;" id="tab">
								<tr>
									<th>学生姓名:</th><th><input type="text" name="student_name" id="student_name" readonly="readonly"></th><th>首字母:</th><th><input type="text" name="student_initials" id="student_initials" readonly="readonly"></th>
								</tr>
								<tr>
									<th>年龄:</th><th><input type="text" name="student_age" readonly="readonly"></th><th>报名日期:</th><th><input type="text" name="student_data" readonly="readonly"></th>
								</tr>
								<tr>
									<th>生日:</th><th><input type="text" name="student_birthday" readonly="readonly"></th><th>剩余课时:</th><th><input type="text" name="student_rest" readonly="readonly"></th>
								</tr>
								<tr>
									<th>家长1:</th><th><input type="text" name="parento" readonly="readonly"></th><th>电话1:</th><th><input type="text" name="phoneo" readonly="readonly"></th>
								</tr>
								<tr>
									<th>家长2:</th><th><input type="text" name="parentt" readonly="readonly"></th><th>电话2:</th><th><input type="text" name="phonet" readonly="readonly"></th>
								</tr>
								<tr>
									<th>状态:</th><th><input type="text" name="state" readonly="readonly"></th><th>积分:</th><th><input type="text" name="integral" readonly="readonly"></th>
								</tr>
								<tr>
									<th>家庭住址:</th><th><input type="text" name="address" readonly="readonly"></th><th>班级类型:</th><th><input type="text" name="classType" readonly="readonly"></th>
								</tr>
								<tr>
									<th>学校:</th><th><input type="text" name="school" readonly="readonly"></th><th>性别:</th><th><input type="text" name="sex" readonly="readonly"></th>
								</tr>
								<tr>
									<th>备注:</th><th colspan="3"><input type="text" name="remarks" id="remarks" style="width:425px;" readonly="readonly"></th>
								</tr>
							</table>
						</div>
						<!-- 学员详情内容结束 -->
					</div>
					<div region="center" border="false">
						<div id="renew_details" style="height:333px;width:100%;"></div>
					</div>
				</div>
			</div>
			<!-- 学员列表信息表内容结束 -->
		</div>
		<div id="charts">
			<div style="height:300px;width:100%;border-bottom:1px solid #ccc" id="top">
				<div id="ratio" style="height:300px;width:40%;border-right:1px solid #ccc;float:left"></div><!--  男女比例 -->
				<div id="ratio_two" style="height:300px;width:59%;float:right"></div>
			</div>
			<div style="height:350px;width:100%;" id="ratio_three">
			</div>
		</div>
		<!-- center内容结束 -->
	</div>
<script type="text/javascript" src="data\js\echarts.js"></script>
<script type="text/javascript" src="data\js\echarts_data.js"></script>
<script type="text/javascript" src="data\js\student.js"></script>
