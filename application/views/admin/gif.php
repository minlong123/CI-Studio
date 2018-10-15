<!-- 搜索栏内容开始 -->
	<div region="center" border="false" style="height:765px;width:100%;border-bottom:1px solid #ccc;">
		<div region="north" border="false" style="height:50px;width:100%;float:left;border-bottom:1px solid #ccc;">
			<div id="ss">
				<ul class="student_list">
					<li><span>礼物管理</span></li>
					<li><input type="text" name="search_data" id="search_data"></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton searcc" iconCls="icon-search" id="btn_serach">查询</a></li>
					<li><a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="add_gif_btn">增加礼物</a></li>
				</ul>
			</div>

			<!-- 添加礼物内容开始 -->
			<div id="add_gif" style="padding-left:5px;">
				<form id="fm">
					<p>
						<label for="gif_name">礼物名称</label>
						<input type="text" name="gif_name" class="easyui-validatebox" required="required" id="gif_name" name="gif_name">	
					</p>
					<p>
						<label for="gif_sum">数量</label>
						<input type="text" name="gif_sum" id="gif_sum" class="easyui-numberspinner" data-options="min:1,max:10000,value:1,editable:true">	
					</p>
					<p>
						<label for="gif_price">单价</label>
						<input type="text" name="gif_price" id="gif_price" class="easyui-validatebox" required="required">
					</p>
					<p>
						<label for="gif_exchange_integral">所需积分</label>
						<input type="text" name="gif_exchange_integral" id="gif_exchange_integral" class="easyui-numberspinner" data-options="min:1,max:1000,value:1,editable:true">
					</p>
				</form>
			</div>
			<!-- 添加礼物内容结束 -->

		</div>
		<div region="center" border="false" style="height:713px;width:100%;">
			<div class="easyui-layout" fit="true">
				<!-- 礼物列表内容设置开始 -->
				<div region="west" border="false" style="height:100%;width:40%;border-right:1px solid #ccc">
					<div id="gif_list"></div>
				</div>
				<div id="all_gif" style="padding:5px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" id="all_giff" >全部礼物</a>
				</div>
				<!-- 礼物列表设置结束 -->
				<!-- 修改礼物信息 开始-->
				<div id="edit_gif_data">
					<form id="fo">
						<p>
							<label for="gif_name">礼物名称</label>
							<input type="text" name="gif_name" class="easyui-validatebox" required="required" id="gif_name" name="gif_name">	
						</p>
						<p>
							<label for="gif_sum">数量</label>
							<input type="text" name="gif_sum" id="gif_sum" class="easyui-numberspinner" data-options="min:1,max:10000,value:1,editable:true">	
						</p>
						<p>
							<label for="gif_price">单价</label>
							<input type="text" name="gif_price" id="gif_price" class="easyui-validatebox" required="required">
						</p>
						<p>
							<label for="gif_exchange_integral">所需积分</label>
							<input type="text" name="gif_exchange_integral" id="gif_exchange_integral" class="easyui-numberspinner" data-options="min:1,max:1000,value:1,editable:true">
							<input type="hidden" name="id" id="id">
						</p>
					</form>
				</div>
				<!-- 修改礼物结束 -->

				<!-- 兑换礼物设置开始 -->
				<div region="center" border="false" style="height:100%;width:60%;">
					<div id="gif_exchange"></div>
				</div>
				<!-- 兑换礼物设置结束 -->
			</div>
		</div>
	</div>
	<script type="text/javascript" src="data\js\gif.js"></script>
	<link rel="stylesheet" type="text/css" href="data\css\gif.css">
