var integral={};
		integral.init=function(){
			$('#student_list_data').datagrid({
				url:'index.php/integral/get_student_data',
				height:'94%',
				width:'100%',
				title:'学员列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				toolbar:'#toolbar',
				onSelect:function(index,row){
					integral.open_integral_details(index,row);
				},
				columns:[[
					{field:'student_name',title:'姓名',width:100,align:'center'},
					{field:'student_initials',title:'首字母',width:85,align:'center'},
					{field:'integral',title:'可用积分',width:80,align:'center'},
					{field:'action',title:'操作',width:110,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" onclick="javascript:integral.reward_open('+index+');">'+"奖励"+'</a>'+"&nbsp;"+'<a href="javascript:void(0)" onclick="javascript:integral.gif_exchange_data('+index+');">'+"兑换/退回"+'</a></span>';
					}},
				]]
			})
			// 点击今日按钮的事件
			$("#now_date").bind('click',function(){
				$('#student_list_data').datagrid({
					url:'index.php/integral/get_sign_student',
					queryParams:{date:integral.current_date()}
				})
			})
			// 点击全部按钮的事件
			$('#all_student').bind('click',function(){
				$('#student_list_data').datagrid('loading');
				$('#student_list_data').datagrid({
					url:'index.php/integral/get_student_data',
				})
				$('#student_list_data').datagrid('loaded');
			})

			$('#reward_love').dialog({
				title:'奖励小爱心',
				iconCls:'icon-add',
				modal:true,
				closed:true,
				buttons:[{
					text:'确认',
					iconCls:'icon-ok',
					id:'save_love',
					handler:function(){
						integral.save_integral();
					}
			
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#reward_love').dialog('close');
					}
				}]
			})
			// 积分列表
			// 字段：uid、日期、积分、类型、说明、操作
			$('#integral_list_data').datagrid({
				height:'94%',
				width:'100%',
				title:'积分列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'integral_date',title:'日期',width:100,align:'center'},
					{field:'integral_add',title:'每次变动积分',width:100,align:'center'},
					{field:'integral_clone',title:'爱心',width:200,align:'center',formatter:function(value,row,index){
						var type=row['integral_type'];
						if(type=="奖励"){
							if(value==1){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==2){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==3){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==4){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==5){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin.png" style="height:30px;width:30px;"></a>'+'</span>';	
							}
						}else{
							if(value==1){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==2){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==3){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==4){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'</span>';
							}
							if(value==5){
								return '<span>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'<a href="javascript:void(0);" id="hend_cursor"><img src="data/images/xin-1.png" style="height:30px;width:30px;"></a>'+'</span>';	
							}
						}
					}},
					// 	// 根据增加的积分是多少，格式化然后显示相对应的爱心
					{field:'integral_type',title:'类型',width:100,align:'center',formatter:function(value,row,index){
							if(value=="奖励"){
								return '<span style="color:green">'+value+'</span>';
							}else if(value="兑换"){
								return '<span style="color:red">'+value+'</span>';
							}
					}},				
					{field:'integral_explain',title:'说明',width:150,align:'center'},
				]]
			})

			// 当点击查询的时候，向数据库查询结果
			$('#btn_serach').bind('click',function(){
				var content=$('#search_data').val();
				integral.search_update_data(content);
			});
			// 如果有焦点的或者按键松下的时候时候，回车的时候也会搜索出来结果
			$('#search_data').bind('keyup',function(e){
				if(e.keyCode==13){
					var content=$('#search_data').val();
					integral.search_update_data(content);
				}
			})

			$('#exchange_gif').dialog({
				title:'兑换礼物',
				height:725,
				width:828,
				draggable:false,
				inline:true,
				fit:true,
				closed:true,
			})


			// 兑换记录列表
			$('#exchange_gif_list').datagrid({
				height:'100%',
				width:'100%',
				title:'兑换记录列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'exchange_name',title:'礼物名称',width:87,align:'center'},
					{field:'exchange_integral',title:'兑换积分',width:60,align:'center'},
					{field:'exchange_person',title:'兑换人',width:80,align:'center'},
					{field:'exchange_date',title:'兑换时间',width:80,align:'center'},
					{field:'action',title:'操作',width:100,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:integral.exit_action('+index+');">'+"退回"+'</a></span>';
					}},
				]]
			})

			// 待兑换的礼物列表
			$('#gif_list').datagrid({
				url:'index.php/integral/get_gif_data',
				height:'100%',
				width:'100%',
				title:'礼物列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'gif_name',title:'礼物名称',width:80,align:'center'},
					{field:'gif_rest',title:'剩余数量',width:80,align:'center'},
					{field:'gif_exchange_integral',title:'所需积分',width:80,align:'center'},
					{field:'action',title:'操作',width:80,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:integral.exchange_action('+index+');">'+"兑换"+'</a></span>';
					}},
				]]
			})

		}



		// 点击兑换和退回后的事件操作，获取学生id，用uid然后在exchange表里查询兑换记录，并显示出来
		integral.gif_exchange_data=function(index){
			var row=$('#student_list_data').datagrid('getRows');
			var uid=row[index]['student_id'];
			$('#exchange_gif').dialog('open');
			$('#student_first').attr('value',row[index]['student_name']);
			$('#student_second').attr('value',row[index]['integral']);
			$('#student_third').attr('value',row[index]['student_id']);
			$('#exchange_gif_list').datagrid({
				url:'index.php/integral/get_exchange_details',
				queryParams:{uid:uid},
			})


		}
		// 点击兑换操作后，弹出确认兑换吗以及进行数据库的加减操作
		// 点击兑换后，获取礼物那一行所有的信息。要收集的信息有：uid、兑换人、gif_id   礼品的名字、兑换日期、兑换积分
		// 插入数据后，如果成功后，礼品的剩余数量减1，学生的积分减去兑换积分，然后更新到学生表、积分表。 
		integral.exchange_action=function(index){
			var rows=$('#gif_list').datagrid('getRows');
			var uid=$('#student_third').val();//学生的id
			var gif_id=rows[index]['id'];//礼物的id
			var student_name=$('#student_first').val(); //兑换积分的学生
			var exchange_gif=rows[index]['gif_name'];//礼品的名字
			var exchange_integral=rows[index]['gif_exchange_integral'];//兑换该礼物所需的积分
			var gif_rest=rows[index]['gif_rest']; //礼品的剩余数量
			var student_integral=$('#student_second').val();// 学生目前的积分
			var student_noww=parseInt(student_integral)-parseInt(exchange_integral);
			$.messager.confirm('Confirm',"确定兑换吗?",function(r){
				if(r==true){
					$.post('index.php/integral/add_exchange_details',{uid:uid,gif_id:gif_id,student_name:student_name,exchange_gif:exchange_gif,exchange_integral:exchange_integral,gif_rest:gif_rest, student_integral:student_integral},function(result){
						if(result.success){
							$('#student_second').attr('value',student_noww);
							$('#student_list_data').datagrid('reload');
							$('#integral_list_data').datagrid('reload');
							$('#exchange_gif_list').datagrid('reload');
							$('#gif_list').datagrid('reload');
							$.messager.show({
								title:'提示',
								msg:'兑换成功'
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
		// 点击退回后,会弹出一条信息框，确认退回该礼物吗？,然后该条兑换记录会删除，可用积分加兑换的积分为更新后的积分。被兑换的剩余礼物数量+1，并更新至student表和integra表里的积分
		// 积分兑换后出现的退回操作，当点击后发生的事件
		// 一、需要的信息是获取兑换记录表中的主键id，然后根据这个主键去删除该条记录。
		// 二、获取兑换该礼物所需的积分、获取目前的积分然后相加，然后获取学生表的主键id、更新学生表中该学生的积分。通过获取exchange表中的主键id来删除integral表中的积分变动。并通过uid更新表中该学生每次变动的所有积分。
		// 三、获取礼物的该id,和礼物的剩余数量+1.更新到gif表中。
		integral.exit_action=function(index){
			$.messager.confirm('Confirm','确定退回吗?',function(r){
				if(r==true){
					var row=$('#exchange_gif_list').datagrid('getRows');
					var exchange_id=row[index]['id'];//该礼物在兑换表中的主键id
					var integral=$('#student_second').val(); //该学生目前的剩余积分
					var exchange_integral=row[index]['exchange_integral'];//兑换该礼物所用的积分
					var uid=$('#student_third').val(); //该学生在学生表内的主键id
					var gif_id=row[index]['gif_id'];//获取礼物的id
					var integral_rest=parseInt(integral)+parseInt(exchange_integral);
					$.post('index.php/integral/exit_gif_action',{exchange_id:exchange_id,integral:integral,exchange_integral:exchange_integral,uid:uid,gif_id:gif_id},function(result){
						if(result.success){
							$('#student_second').attr('value',integral_rest);
							$('#student_list_data').datagrid('reload');
							$('#integral_list_data').datagrid('reload');
							$('#exchange_gif_list').datagrid('reload');
							$('#gif_list').datagrid('reload');
							$.messager.show({
								title:'提示',
								msg:'退回成功'
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



	// 这里有个问题，如果用户一直不断的点查询，那就会不断的创建大量的数据库连接，后面工作的时候，就需要给所有的点击事件加不同响应速度的事件节流
		integral.search_update_data=function(data){
			$('#btn_serach').linkbutton('disable');
			if($.trim(data)!=""){
				$('#student_list_data').datagrid('loading');
				$.post('index.php/course/search_student_data',{content:data},function(result){
					if(result!=""){
						$('#student_list_data').datagrid('loadData',result);
					}
				},'json')
				$('#student_list_data').datagrid('loaded');
				$('#btn_serach').linkbutton('enable');
			}else{
				$('#search_data').focus();
				$('#btn_serach').linkbutton('enable');
				$('#student_list_data').datagrid('reload');//如果为空的时候点击该按钮刷新返回所有数据页
			}
		}

		// 时间操作
		integral.current_date=function(){
			var day=new Date();
			var year=day.getFullYear();
			var month=day.getMonth()+1;
			var date=day.getDate();
			if(month<10){
				month="0"+month;
			}
			if(date<10){
				date="0"+date;
			}
			now=year+"-"+month+"-"+date;
			return now;
		}

		// 点击奖励后打开dialog 
		integral.reward_open=function(index){
			$('#reward_love').dialog('open');
			// $('#btn_lovv').attr('class',btn_lovee);
			var rows=$('#student_list_data').datagrid('getRows');
			$('#fom').form('load',rows[index]);

			// 表单中爱心的增加与删除
			var num=1;
			$("#spann #add_newlove").bind('click',function(){
				$('#spann #btn_lovv').eq(num-1).removeClass();
				if(num<5){
					num++;
				}
				$('.input_val').attr('value',num);
			})
			// 表单中增加与删除
			$('#spann #btn_lovv').bind('click',function(){
				if(num>1){
					num--;
				}
				$(this).addClass('btn_lovee');
				$('.input_val').attr('value',num);
				
			})

		}

		// 奖励小爱心后点击确认后的事件,还有个问题,添加爱心成功之后,默认的爱心恢复原状态,遍历所有的a元素判断，如果有一个没有相应的class，就为他加一个class
		integral.save_integral=function(){
			$('#save_love').linkbutton('disable');
			var content=$('#fom').serializeArray();
			$.post('index.php/integral/sava_data',content,function(result){
				if(result.success){
					$('#student_list_data').datagrid('reload');
					$('#integral_list_data').datagrid('reload');
					$('#spann #btn_lovv').addClass('btn_lovee');
					$('.input_val').attr('value',1);
					$('#reward_love').dialog('close');
					$.messager.show({
						title:'奖励提示',
						msg:'奖励小爱心成功',
					})
				}else{
					$.messager.show({
						title:'奖励失败',
						msg:result.msg,
					})
				}
				$('#save_love').linkbutton('enable');
			},'json')
		}


		integral.open_integral_details=function(index,row){
			var uid=row['student_id'];
			$('#integral_list_data').datagrid({
				url:'index.php/integral/get_integral_details',
				queryParams:{uid:uid},
			})

		}

		$(function(){
			integral.init();
		})