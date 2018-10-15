	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div class="easyui-layout" fit=true>
			<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;overflow:hidden">
				<ul class="student_list">
					<li><span>教师管理</span></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="teacher_addbutton">新增教师</a></li>
				</ul>
			</div>
			<div region="center" border="false" style="height:715px;width:100%;">
				<div class="easyui-layout" fit=true>
					<div region="west" border="false" style="height:100%;width:50%;border-right:1px solid #ccc">
						<div id="teacher_list"></div>
					</div>
					<div region="center" border="false" style="height:100%;width:50%">
						<div id="teacher_sign"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 新增教师信息 -->
	<div id="add_teacher">
		<form id="fm">
			<div id="dd">
				<label for="teacher_name">姓名</label>
				<input type="text" name="teacher_name" id="teacher_name" class="easyui-validatebox" required=true>
			</div>
			<div id="dd">
				<label for="teacher_age">年龄</label>
				<input type="text" name="teacher_age" id="teacher_age" class="easyui-numberspinner" data-options="min:1,max:50,editable:true">
			</div>
			<div id="dd">
				<label for="teacher_phone">电话</label>
				<input type="text" name="teacher_phone" id="teacher_phone" class="easyui-validatebox" required=true>
			</div>
			<div id="dd">
				<label for="teacher_address">地址</label>
				<input type="text" name="teacher_address" id="teacher_address" class="easyui-validatebox" required=true>
			</div>
			<div id="dd">
				<label for="teacher_entry">入职时间</label>
				<input type="text" name="teacher_entry" id="teacher_entry" class="easyui-datebox">
			</div>
			<div id="dd">
				<label for="teacher_state">状态</label>
				<select id="teacher_state" name="teacher_state" class="easyui-combobox" style="width:152px;">
					<option value="正常" selected="selected">正常</option>
					<option value="离职">离职</option>
				</select>
			</div>
			<div id="dd">
				<label for="teacher_remarks">备注</label>
				<input type="text" name="teacher_remarks" id="teacher_remarks">
			</div>
		</form>
	</div>

	<!-- 修改教师信息 -->
	<div id="edit_teacher">
		<form id="fomm">
			<div id="bb">
				<label for="teacher_name">姓名</label>
				<input type="text" name="teacher_name" id="teacher_name" class="easyui-validatebox" required=true>
			</div>
			<div id="bb">
				<label for="teacher_age">年龄</label>
				<input type="text" name="teacher_age" id="teacher_age" class="easyui-numberspinner" data-options="min:1,max:50,editable:true">
			</div>
			<div id="bb">
				<label for="teacher_phone">电话</label>
				<input type="text" name="teacher_phone" id="teacher_phone" class="easyui-validatebox" required=true>
			</div>
			<div id="bb">
				<label for="teacher_address">地址</label>
				<input type="text" name="teacher_address" id="teacher_address" class="easyui-validatebox" required=true>
			</div>
			<div id="bb">
				<label for="teacher_entry">入职时间</label>
				<input type="text" name="teacher_entry" id="teacher_entry" class="easyui-datebox">
			</div>
			<div id="bb">
				<label for="teacher_state">状态</label>
				<select id="teacher_state" name="teacher_state" class="easyui-combobox" style="width:152px;">
					<option value="正常" selected="selected">正常</option>
					<option value="离职">离职</option>
				</select>
			</div>
			<div id="bb">
				<label for="teacher_remarks">备注</label>
				<input type="text" name="teacher_remarks" id="teacher_remarks">
			</div>
			<input type="hidden" name="tercher_id" id="tercher_id">
		</form>
	</div>
	<link rel="stylesheet" type="text/css" href="data\css\teacher.css">
	<script type="text/javascript" src="data\js\teacher.js"></script>
</body>
</html>