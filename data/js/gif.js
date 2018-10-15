var gif={};
		gif.init=function(){
			$('#gif_list').datagrid({
				url:'index.php/gif/get_all_gif',
				height:'100%',
				width:'100%',
				title:'礼物列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				toolbar:'#all_gif',
				onSelect:function(index,row){
					gif.open_exchange(index,row);
				},
				columns:[[
					{field:'gif_name',title:'礼物名称',width:100,align:'center'},
					{field:'gif_sum',title:'礼物数量',width:80,align:'center'},
					{field:'gif_rest',title:'剩余数量',width:80,align:'center'},
					{field:'gif_exchange_integral',title:'所需兑换积分',width:80,align:'center'},
					{field:'action',title:'操作',width:100,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" class="easyui-linkbutton" onclick="gif.edit_details('+index+');">'+"修改"+'</a>'+"&nbsp"+'<a href="javascript:void(0)" class="easyui-linkbutton" onclick="gif.destroy_gif_data('+index+');">'+"删除"+'</a></span>';
					}},
				]]
			})


			$('#gif_exchange').datagrid({
				height:'100%',
				width:'100%',
				title:'兑换列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'exchange_name',title:'礼物名称',width:150,align:'center'},
					{field:'exchange_person',title:'兑换人',width:100,align:'center'},
					{field:'exchange_date',title:'兑换日期',width:100,align:'center'},
					{field:'exchange_integral',title:'所用积分',width:100,align:'center'},

				]]
			})

			// 增加礼物弹出框
			$('#add_gif').dialog({
				height:250,
				width:300,
				title:'增加礼物',
				iconCls:'icon-add',
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'save_gif',
					handler:function(){
						gif.save_add_gif();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#add_gif').dialog('close');
					}
				}]
			})

			// 修改礼物弹出框
			$('#edit_gif_data').dialog({
				height:250,
				width:300,
				title:'修改礼物',
				iconCls:'icon-edit',
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'edit_gif',
					handler:function(){
						gif.edit_add_gif();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#add_gif').dialog('close');
					}
				}]
			})



			$('#add_gif_btn').bind('click',function(){
				$('#add_gif').dialog('open');
			})


			// 搜索内容
			$('#btn_serach').bind('click',function(){
				var content=$('#search_data').val();
				if(content!=""){
					gif.search_only_data();
				}else{
					$.messager.confirm('Confirm','请添加内容后查询哦',function(r){
						if(r==true){
							$('#search_data').focus();
						}
					})
				}				
			});
			$('#search_data').bind('keyup',function(e){
				if(e.keyCode==13){
					gif.search_only_data();	
				}
			});

			// 显示全部礼物
			$('#all_giff').bind('click',function(){
				$('#gif_list').datagrid('reload');
			})
		}
		// 向数据库找内容
		gif.search_only_data=function(){
			var content=$('#search_data').val();
	  		$.post('index.php/gif/get_search_data',{name:content},function(result){
				$('#gif_list').datagrid('loadData',result);
			},'json')
		}



		// 当点击修改后触发的事件
		gif.edit_details=function(index){
			var rows=$('#gif_list').datagrid('getRows');
			$('#edit_gif_data').dialog('open');
			$('#fo').form('load',rows[index]);

		}

		// 当选中礼物列表一行的时候发生的事件
		gif.open_exchange=function(index,row){
			var gif_id=row['id'];
			$('#gif_exchange').datagrid({
				url:'index.php/gif/get_exchange_details',
				queryParams:{id:gif_id},
			})
		}


		// 点击增加礼物后的保存按钮发生的事件
		gif.save_add_gif=function(){
			$('#save_gif').linkbutton('disable');
			var content=$('#fm').serializeArray();
			var _validate=true;
			var labels="gif_name,gif_price";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						gif.showmsg(item['name']);
						return false;
					}
				}
			})
			if(_validate){
				$.post('index.php/gif/update_new_gif',content,function(result){
					$('#save_gif').linkbutton('enable');
					if(result.success){
						$('#add_gif').dialog('close');
						$('#gif_list').datagrid('reload');
						$('#fm').form('reset');
						$.messager.show({
							title:'提示',
							msg:'成功添加',
						})
					}else{
						$.messager.show({
							title:'提示',
							msg:result.msg
						})
					}
				},'json')
			}
		}

		// 点击修改礼物后的保存按钮发生的事件
		gif.edit_add_gif=function(){
			$('#edit_gif').linkbutton('disable');
			var content=$('#fo').serializeArray();
			var _validate=true;
			var labels="gif_name,gif_price";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						gif.showmsg(item['name']);
						return false;
					}
				}
			})
			if(_validate){
				$.post('index.php/gif/save_edit_gif',content,function(result){
					$('#edit_gif').linkbutton('enable');
					if(result.success){
						$('#edit_gif_data').dialog('close');
						$('#gif_list').datagrid('reload');
						$('#fm').form('reset');
						$.messager.show({
							title:'提示',
							msg:'修改成功',
						})
					}else{
						$.messager.show({
							title:'提示',
							msg:result.msg
						})
					}
				},'json')
			}
		}


		// 删除礼物
		gif.destroy_gif_data=function(index){
			var row=$('#gif_list').datagrid('getRows');
			var id=row[index]['id'];
			var gif_name=row[index]['gif_name'];
			$.messager.confirm('Confirm','真的确认删除'+gif_name+'吗？',function(r){
				if(r==true){
					$.post('index.php/gif/delete_gif',{id:id},function(result){
						if(result.success){
							$('#gif_list').datagrid('reload');
							$.messager.show({
								title:'提示',
								msg:'删除成功',
							})
						}else{
							$.messager.show({
								title:'提示',
								msg:result.msg
							})
						}
					},'json')
				}
			})
		}


		gif.showmsg=function(msg){
			var content=$('#fm p').find('label[for="'+msg+'"]').text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还未输入'+'【'+content+'】',
			})
		}
		$(function(){
			gif.init();
		})