<link rel="stylesheet" type="text/css" href="data\css\integral.css">
	<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<ul class="student_list">
					<li><span>积分与兑换管理</span></li>
					<li><input type="text" name="search_data" id="search_data"></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton searcc" iconCls="icon-search" id="btn_serach">查询</a></li>
				</ul>
			</div>
		</div>
		<div class="easyui-layout" fit=true>
			<!-- 学员列表开始 -->
			<div region="west" border="false" style="height:100%;width:32%;float:left;border-right:1px solid #ccc">
				<div id="student_list_data"></div>
				<div id="toolbar">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id="now_date">今日</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id="all_student">全部</a>
				</div>
			</div>

			<!-- 弹出的奖励窗口 -->
			<div id="reward_love">
				<form id="fom">
					<p>
						<label for="student_name">姓名</label>
						<input type="text" name="student_name" id="student_name" readonly="readonly">
					</p>
					<p>
						<label for="integral_now">爱心</label>
						<span id="spann"><a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>
							<a href="javascript:void(0);" class="btn_lovee" id="btn_lovv"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>
							<a href="javascript:void(0);" class="btn_lovee" id="btn_lovv"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>
							<a href="javascript:void(0);" class="btn_lovee" id="btn_lovv"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>
							<a href="javascript:void(0);" class="btn_lovee" id="btn_lovv"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>
							<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain=true id="add_newlove"></a>
						</span>
						<input type="hidden" name="integral_now" id="integral_now" class="input_val" value="1">
						<input type="hidden" name="student_id" id="student_id">
						<input type="hidden" name="integral" id="integral">
					</p>
					<p>
						<label for="integral_explain">说明</label>
						<input type="text" name="integral_explain" id="integral_explain">
					</p>
				</form>
			</div>
			<!-- 学员列表结束 -->
			
			<!-- 积分列表显示，记录积分操作 -->
			<div region="center" border="false" style="height:100%;width:68%;float:right;">
				<div id="integral_list_data"></div>
				<!-- 积分兑换礼物和退回页面 -->
				<div id="exchange_gif">
					<div class="easyui-layout" fit=true>
						<div region="north" border="false" style="height:7%;width:100%;border-bottom:1px solid #ccc">
							<div id="other_details">
								<span>姓名：<input type="text" name="student_first" id="student_first" readonly="readonly"></span>
								<span>可用积分：<input type="text" name="student_second" id="student_second" readonly="readonly"></span>
								<input type="hidden" name="student_third" id="student_third">
							</div>
						</div>
						<div region="center" border="false" style="height:93%;width:100%;>
							<div class="easyui-layout" fit=true>
								<div region="west" border="false" style="height:635px;width:52%;float:left">
									<div id="exchange_gif_list"></div>
								</div>
								<div region="center" border="false" style="height:635px;width:48%;float:right;">
									<div id="gif_list"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 积分列表结束 -->
		</div>
	</div>
	<!-- 导航内容结束 -->
	<script type="text/javascript" src="data\js\integral.js"></script>