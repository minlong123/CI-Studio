	<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<ul class="student_list">
					<li><span>课程管理</span></li>
					<li><input type="text" name="search_data" id="search_data"></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton searcc" iconCls="icon-search" id="btn_serach">查询</a></li>
				</ul>
			</div>
		</div>
		<div class="easyui-layout" fit=true>
			<!-- 学员列表设置开始 -->
			<div region="west" border="false" style="height:100%;width:30%;border-right:1px solid #ccc">
				<div id="student_list_data"></div>
			</div>
			<!-- 添加学员课时dialog设置内容开始 -->
			<div id="add_student_hour">
				<form id="course_submit">
					<p>
						<label for="student_name">学员:</label>
						<input type="text" name="student_name" id="student_name" readonly="readonly">
						<input type="hidden" name="student_id" id="student_id">
						<input type="hidden" name="student_rest" id="student_rest">
						<input type="hidden" name="integral" id="integral">
					</p>
					<p>
						<label for="course_data">日期:</label>
						<input type="text" name="course_data" id="course_data" readonly="readonly">
					</p>
					<p>
						<label for="timeslot">时间段:</label>
						<select id="timeslot" name="timeslot" class="easyui-combobox" style="height:46px;width: 166px;display:block;">
							<option value="上午">上午</option>
							<option value="下午">下午</option>
							<option value="全天">全天</option>
						</select>
					</p>
					<p>
						<label for="address">地点:</label>
						<input type="text" name="address" id="address" value="室内">
					</p>
					<p>
						<label for="course_content">课程内容:</label>
						<input type="text" name="course_content" id="course_content">
					</p>
				</form>
			</div>
			<!-- 添加学员课时dialog设置内容结束 -->

			<!-- 学员列表设置结束 -->


			<!-- 课时列表设置开始 -->
			<div region="center" border="false" style="width:70%;height:100%;border-right:1px solid #ccc">
				<div id="course_hour"></div>
			</div>
			<div id="edit_course_hour">
				<form id="course_edit">
					<p>
						<label for="student_name">学员:</label>
						<input type="text" name="student_name" id="student_name" readonly="readonly">
						<input type="hidden" name="id" id="id">
					</p>
					<p>
						<label for="course_data">日期:</label>
						<input type="text" name="course_data" id="course_data" class="edit_date">
					</p>
					<p>
						<label for="timeslot">时间段:</label>
						<select id="timeslot" name="timeslot" class="easyui-combobox" style="height:46px;width: 166px;display:block;">
							<option value="上午">上午</option>
							<option value="下午">下午</option>
							<option value="全天">全天</option>
						</select>
					</p>
					<p>
						<label for="address">地点:</label>
						<input type="text" name="address" id="address">
					</p>
					<p>
						<label for="course_content">课程内容:</label>
						<input type="text" name="course_content" id="course_content">
					</p>
				</form>
			</div>
			<!-- 课时列表设置结束-->
		</div>
	</div>
<link rel="stylesheet" type="text/css" href="data\css\course.css">
<script type="text/javascript" src="data\js\course.js"></script>
