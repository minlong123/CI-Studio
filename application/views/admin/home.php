
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div class="easyui-layout" fit=true>
			<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;overflow:hidden">
				<ul class="student_list">
					<li><span>学员查询</span></li>
					<li><input type="text" name="search_data" id="search_data" placeholder="输入学生姓名或姓名首字母自动查询显示"/></li>
				</ul>
			</div>
			<div region="west" border="false" style="height:715px;width:65%;border:1px solid #ccc;">
					<div class="easyui-accordion" fit=true>
						<div title="基本状况" iconCls="icon-search">
							<div id="head_panel" style="border-bottom:1px solid #ccc;">
								<table border="0" cellspacing="0" cellpadding="0" id="tabb" style="height:100%;width:100%">
									<tr>
										<th id="today_date"></th>
										<th style="color:#ccc">今日上课人数</th>
										<th style="color:#ccc">课时不足人数</th>
									</tr>
									<tr>
										<th id="today_week"></th>
										<th><a href="javascript:void(0)" style="color:green;text-decoration:none;" id="course_num" onclick="home.get_course_student();">0</a></th>

										<th><a href="javascript:void(0)" style="color:green;text-decoration:none;" id="no_rest" onclick="home.get_norest_studentdata();">0</a></th>
									</tr>
								</table>
							</div>
							<div id="foot_dg"></div>
							<div id="foot_norest"></div>
							<!-- 学员课程录入内容设置开始 -->
							<div id="course_add">
								<form id="course_submit">
									<p>
										<label for="student_name">学员:</label>
										<input type="text" name="student_name" id="student_name" readonly="readonly">
										<input type="hidden" name="uid" id="uid">
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
										<input type="text" name="address" id="address">
									</p>
									<p>
										<label for="course_content">课程内容:</label>
										<input type="text" name="course_content" id="course_content">
									</p>
								</form>
							</div>
							<!-- 学员课程录入内容设置结束 -->
						</div>

						<!-- 按日期查询内容设置开始 -->
						<div title="按日期查询" iconCls="icon-search">
							<div style="height:55%;width:100%;float:left;border-bottom:1px solid #ccc">
								<div id="now_date" style="width:35%;height:100%;float:left;border-right:1px solid #ccc"></div>
								<div id="now_student_date" style="width:65%;height:100%;float:right;"></div>
							</div>
							<div id="date_student_details" style="width:100%;height:44%;float:left;">
								<table border="0" cellspacing="0" cellpadding="0" style="height:43%;width:100%;padding:10px;" id="tabbb">
									<tr>
										<th align="center">学生姓名:</th><th><input type="text" name="student_name" id="student_name" readonly="readonly"></th><th align="center">首字母:</th><th><input type="text" name="student_initials" id="student_initials" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">年龄:</th><th><input type="text" name="student_age" readonly="readonly"></th><th align="center">报名日期:</th><th><input type="text" name="student_data" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">生日:</th><th><input type="text" name="student_birthday" readonly="readonly"></th><th align="center">剩余课时:</th><th><input type="text" name="student_rest" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">家长1:</th><th><input type="text" name="parento" readonly="readonly"></th><th align="center">电话1:</th><th><input type="text" name="phoneo" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">家长2:</th><th><input type="text" name="parentt" readonly="readonly"></th><th align="center">电话2:</th><th><input type="text" name="phonet" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">状态:</th><th><input type="text" name="state" readonly="readonly"></th><th align="center">积分:</th><th><input type="text" name="integral" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">家庭住址:</th><th><input type="text" name="address" readonly="readonly"></th><th align="center">班级类型:</th><th><input type="text" name="classType" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">学校:</th><th><input type="text" name="school" readonly="readonly"></th><th align="center">性别:</th><th><input type="text" name="sex" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">上一节课时间:</th><th><input type="text" id="course_data" name="course_data" readonly="readonly"></th><th align="center">上一节课内容:</th><th><input type="text" id="course_content" name="course_content" readonly="readonly"></th>
									</tr>
									<tr>
										<th align="center">备注:</th><th colspan="3"><input type="text" name="remarks" id="remarks" readonly="readonly" style="width:642px;"></th>
									</tr>
								</table>
							</div>
							<!-- 按日期查询内容设置结束 -->
						</div>
					</div>
			</div>
			<div region="center" style="width:34%;height:715px;border:1px solid #ccc;">
				<div id="student_details_data" style="border:1px solid #ccc">
					<!-- 学员详情内容开始 -->
					<div region="north" border='false' style="height:50%;width:100%;border-bottom:1px solid #ccc">
						<div class="easyui-panel" id="student_details" fit=true>
							<table border="0" cellspacing="0" cellpadding="0" style="height:100%;width:100%;padding:10px;" id="tab">
								<tr>
									<th align="center">学生姓名:</th><th><input type="text" name="student_name" id="student_name" readonly="readonly"></th><th align="center">首字母:</th><th><input type="text" name="student_initials" id="student_initials" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">年龄:</th><th><input type="text" name="student_age" readonly="readonly"></th><th align="center">报名日期:</th><th><input type="text" name="student_data" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">生日:</th><th><input type="text" name="student_birthday" readonly="readonly"></th><th align="center">剩余课时:</th><th><input type="text" name="student_rest" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">家长1:</th><th><input type="text" name="parento" readonly="readonly"></th><th align="center">电话1:</th><th><input type="text" name="phoneo" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">家长2:</th><th><input type="text" name="parentt" readonly="readonly"></th><th align="center">电话2:</th><th><input type="text" name="phonet" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">状态:</th><th><input type="text" name="state" readonly="readonly"></th><th align="center">积分:</th><th><input type="text" name="integral" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">家庭住址:</th><th><input type="text" name="address" readonly="readonly"></th><th align="center">班级类型:</th><th><input type="text" name="classType" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">学校:</th><th><input type="text" name="school" readonly="readonly"></th><th align="center">性别:</th><th><input type="text" name="sex" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">上一节课时间:</th><th><input type="text" id="course_data" name="course_data" readonly="readonly"></th><th align="center">上一节课内容:</th><th><input type="text" id="course_content" name="course_content" readonly="readonly"></th>
								</tr>
								<tr>
									<th align="center">备注:</th><th colspan="3"><input type="text" name="remarks" id="remarks" readonly="readonly" style="width:335px;"></th>
								</tr>
							</table>
						</div>
					</div>
					<!-- 学员详情内容结束 -->

					<!-- 学员课时列表内容开始 -->
					<div region="west" border="false" style="height:50%;width:100%;">
						<div id="class_hour_details"></div>
					</div>
					<!-- 学员课时列表内容结束-->
				</div>
				<!-- 右边内容开始 -->
				<div class="easyui-accordion" fit=true id="sign_accordion">
					<!-- 学员签到内容开始 -->
					<div title="学员签到" iconCls="icon-ok" style="height:100%;width:100%;">
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="start_button" style="height:60px;width:150px;margin:200px 0 0 150px;">开始签到</a>
						<div id="student_search_data">
							<p>
								<input type="text" name="student_search_name" id="student_search_name" placeholder="输入首字母">
							</p>
							<p class="search_index name_a">A:</p>
							<p class="search_index name_b">B:</p>
							<p class="search_index name_c">C:</P>
							<p class="search_index name_d">D:</P>
							<p class="search_index name_e">E:</P>
							<p class="search_index name_f">F:</P>
							<p class="search_index name_g">G:</P>
							<p class="search_index name_h">H:</P>
							<p class="search_index name_j">J:</P>
							<p class="search_index name_k">K:</P>
							<p class="search_index name_l">L:</P>
							<p class="search_index name_m">M:</P>
							<p class="search_index name_n">N:</P>
							<p class="search_index name_o">O:</P>
							<p class="search_index name_p">P:</P>
							<p class="search_index name_q">Q:</P>
							<p class="search_index name_r">R:</P>
							<p class="search_index name_s">S:</P>
							<p class="search_index name_t">T:</P>
							<p class="search_index name_w">W:</P>
							<p class="search_index name_x">X:</P>
							<p class="search_index name_y">Y:</P>
							<p class="search_index name_z">Z:</P>		
						</div>
						<div id="student_search_submit">
							<p id="student_index">以下学员签到:</p>
							<div>
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" id="submit_sign">提交签到</a><span style="color:orange;margin-left:10px;">(中午1点之前签到为上午，1点之后签到为下午)</span>
							</div>
						</div>	
					</div>
					<!-- 学员内容设置结束 -->

					<!-- 教师内容设置开始 -->
					<div title="教师签到" iconCls="icon-ok" style="height:100%;width:100%;">
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok"  style="height:60px;width:150px;margin:200px 0 0 150px;" id="teacher_stater">开始签到</a>
						<div id="start_teacher">
							<p id="p_teacher">所有教师：</p>
						</div>
						<div id="teacher_search_submit">
							<p id="p_teacherr">以下教师签到:</p>
							<div>
								<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" id="submit_teacher">提交签到</a><span style="color:orange;margin-left:10px;">(中午1点之前签到为上午，1点之后签到为下午)</span>
							</div>
						</div>
					</div>
				<!-- 教师内容设置结束 -->
				</div>
				<!-- 右边内容结束 -->
			</div>
		</div>
	</div>

<!-- 学员查询下拉datagrid表设置开始 -->
<div id="student_border">
	<div id="student_dg"></div>
</div>
<!-- 学员查询下拉datagrid表设置结束 -->
<link rel="stylesheet" type="text/css" href="data\css\homepage.css">
<script type="text/javascript" src="data\js\homepage.js"></script>