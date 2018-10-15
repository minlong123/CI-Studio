<link rel="stylesheet" type="text/css" href="data\css\finance.css">
	<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<form id="fm">
					<ul class="student_list">
						<li><span>财务管理</span></li>
						<li>
							<input type="text" name="search_data" id="search_data" class="easyui-datebox" data-options="editable:false" style="height:35px;">&nbsp;至&nbsp;
							<input type="text" name="search_end" id="search_end" class="easyui-datebox" style="height:35px;" data-options="editable:false"></li>
		
						<li><a href="javascript:void(0)" class="easyui-linkbutton searcc" iconCls="icon-search" id="btn_serach">查询</a></li>
							
						<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="add_finance_btn">入账/出账</a></li>
					</ul>
				</form>
				<div id="record_money">
					<form id="fom">
						<p>
							<label for="finance_money">金额</label>
							<input type="text" name="finance_money" id="finance_money" class="easyui-validatebox" required=true>
						</p>
						<p>
							<label for="finance_type">类型</label>
							<select class="easyui-combobox" name="finance_type" id="finance_type" style="width:155px;">
								<option value="收入" selected="selected">收入</option>
								<option value="支出">支出</option>
							</select>
						</p>
						<p>
							<label for="finance_date">日期</label>
							<input type="text" name="finance_date" id="finance_date" class="easyui-datebox" data-options="editable:false">
						</p>
						<p>
							<label for="finance_details">明细</label>
							<input type="text" name="finance_details" id="finance_details" class="easyui-validatebox" required=true>
						</p>
					</form>
				</div>
				<div id="edit_record">
					<form id="fmm">
						<p>
							<label for="finance_money">金额</label>
							<input type="text" name="finance_money" id="finance_money" class="easyui-validatebox" required=true>
						</p>
						<p>
							<label for="finance_type">类型</label>
							<select class="easyui-combobox" name="finance_type" id="finance_type" style="width:155px;">
								<option value="收入" selected="selected">收入</option>
								<option value="支出">支出</option>
							</select>
						</p>
						<p>
							<label for="finance_date">日期</label>
							<input type="text" name="finance_date" id="finance_date" class="easyui-datebox" data-options="editable:false">
						</p>
						<p>
							<label for="finance_details">明细</label>
							<input type="text" name="finance_details" id="finance_details" class="easyui-validatebox" required=true>
							<input type="hidden" name="id" id="id">
						</p>
					</form>
				</div>
			</div>
		</div>
		<div class="easyui-layout" fit=true>
			<!-- 账户明细列表设置开始 -->
			<div region="west" border="false" style="height:715px;width:50%;border-right:1px solid #ccc">
				<div id="finance_list"></div>
				<div id="toolbar">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain=true id="this_month">本月</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain=true id="last_month">上月</a>
				</div>
			</div>
			<!-- 账户明细列表设置结束 -->

			<!-- 账户图表内容设置开始-->
			<div region="center" border="false" style="height:auto;width:50%;">
				<div class="easyui-layout" style="height:715px;width:100%">

					<div region="north" border="false" style="height:50%;width:100%;border:1px solid #ccc" id="year_sum">全年收支汇总，饼状图</div>

					<div region="center" border="false" style="width:100%;height:auto" id="month_money_details">今年每月的收支明细，柱状图</div>

				</div>
			</div>
			<!-- 账户图表内容设置结束 -->
		</div>
	</div>
<!-- 搜索栏内容结束 -->
	<script type="text/javascript" src="data\js\finance.js"></script>
	<script type="text/javascript" src="data\js\echarts.js"></script>
	<script type="text/javascript" src="data\js\fecharts.js"></script>