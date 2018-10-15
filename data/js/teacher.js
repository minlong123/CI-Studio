var teacher={};
		teacher.sameday_date=function(){
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
			var now_day=year+"-"+month+"-"+date;
			return now_day;

		}

		teacher.init=function(){
			$('#add_teacher').dialog({
				height:400,
				width:300,
				closed:true,
				title:'添加教师',
				modal:true,
				iconCls:'icon-add',
				buttons:[{
					text:'保存',
					id:'save_teacher_button',
					iconCls:'icon-ok',
					handler:function(){
						teacher.save_teacherdate(); 
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#add_teacher').dialog('close');
					}
				}]

			});


			$('#edit_teacher').dialog({
				height:400,
				width:300,
				closed:true,
				title:'修改教师',
				modal:true,
				iconCls:'icon-edit',
				buttons:[{
					text:'保存',
					id:'edit_teacher_button',
					iconCls:'icon-ok',
					handler:function(){
						teacher.save_edit_teacherdate(); 
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#edit_teacher').dialog('close');
					}
				}]
			});


			$('#teacher_list').datagrid({
				height:'100%',
				width:'100%',
				title:'教师列表',
				rownumbers:true,
				singleSelect:true,
				fitColumns:true,
				pagination:true,
				pageSize:3,//每页显示多少行数据
				pageList:[3,6,9,12,15],//可以通过这个手动选择每页展示多少行
				url:'index.php/teacher/get_teacherdata',
				onSelect:function(index,row){
					teacher.show_details(index,row);
				},
				columns:[[
					{field:'teacher_name',title:'姓名',width:100,align:'center'},
					{field:'teacher_age',title:'年龄',width:100,align:'center'},
					{field:'teacher_phone',title:'电话',width:100,align:'center'},
					{field:'tercher_id',title:"id",width:0,hidden:true},
					{field:'teacher_entry',title:'入职日期',width:100,align:'center'},
					{field:'teacher_address',title:'地址',width:100,align:'center'},
					{field:'teacher_state',title:'状态',width:100,align:'center'},
					{field:'teacher_caozuo',title:'操作',width:100,align:'center',formatter:function(val,row,index){
						return '<span><a href="javascript:void(0)" onclick="javascript:teacher.edit_teacherdata('+index+');">'+"修改"+'</a>'+'&nbsp;'+'<a href="javascript:void(0)" onclick="javascript:teacher.destroy_teacherdata('+index+');">'+"删除"+'</a>'+'</span>';
					}},
				]]
			})

			$('#teacher_sign').datagrid({
				height:'100%',
				width:'100%',
				title:'签到记录列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'teacher_name',title:'姓名',width:100},
					{field:'teacher_sign_data',title:'签到日期',width:100},
					{field:'timeslot',title:'时间段',width:100},
				]]

			})

			$('#teacher_entry').datebox({
				value:'teacher.sameday_date()'
			});

			$('#teacher_addbutton').bind('click',function(){
				$('#add_teacher').dialog('open');
			})


		}

		teacher.show_details=function(index,row){
			var uid=row['tercher_id'];
			$('#teacher_sign').datagrid({
				url:'index.php/teacher/show_teacher_sign',
				queryParams:{uid:uid}
			});
		}

		teacher.edit_teacherdata=function(index){
			var row=$('#teacher_list').datagrid('getRows');
			$("#fomm").form('clear');
			$("#fomm").form('load',row[index]);
			$('#edit_teacher').dialog('open');

		}

		teacher.save_teacherdate=function(){
			var data=$("#fm").serializeArray();
			var _validate=true;
			var labels="teacher_name,teacher_age,teacher_phone";
			$.each(data,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						teacher.showmsg(item['name']);
						return false;
					}
				}
			});
			if(_validate){
				$('#save_teacher_button').linkbutton('disable');
				$.post('index.php/teacher/sava_teacher',data,function(result){
					if(result.success){
						$('#add_teacher').dialog('close');
						$('#teacher_list').datagrid('reload');
						$.messager.show({
							title:'提交成功',
							msg:'成功新增一名老师'
						})
					}else{
						$('#add_teacher').dialog('close');
						$.messager.show({
							title:'提交失败',
							msg:'录入失败,请重新尝试'
						})
					}
					$('#save_teacher_button').linkbutton('enable');
				},'json');
			}
		}


		teacher.save_edit_teacherdate=function(){
			var content=$('#fomm').serializeArray();
			var _validate=true;
			var labels="teacher_name,teacher_age,teacher_phone";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						teacher.showmsg1(item['name']);
						return false;
					}
				}
			});
			if(_validate){
				$('#edit_teacher_button').linkbutton('disable');
				$.post('index.php/teacher/edit_teacher',content,function(result){
					if(result.success){
						$('#edit_teacher').dialog('close');
						$('#teacher_list').datagrid('reload');
						$.messager.show({
							title:'修改成功',
							msg:'成功修改'
						});
					}else{
						$('#edit_teacher').dialog('close');
						$.meeager.show({
							title:'修改失败',
							msg:result.msg
						})
					}
					$('#edit_teacher_button').linkbutton('enable');
				},'json');
			}
		}


		teacher.destroy_teacherdata=function(index){
			var row=$('#teacher_list').datagrid('getRows');
			var id=row[index]['tercher_id'];
			var nam=row[index]['teacher_name'];
			$.messager.confirm('提示','确认删除【'+nam+'】',function(r){
				if(r==true){
					$.post('index.php/teacher/destroy_teacher',{tercher_id:id},function(result){
						if(result.success){
							$('#teacher_list').datagrid('reload');
							$.messager.show({
								title:'删除提示',
								msg:'删除成功'
							})							
						}else{
							$.messager.show({
								title:'删除提示',
								msg:result.msg
							})
						}
					},'json');
				}else{
					$('#teacher_list').datagrid('reload');
				}
			})
		}



		teacher.showmsg=function(id){
			// 获取form的所有子代元素
			var content=$('#fm').find("label[for='"+id+"']").text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'请填写'+'【'+content+'】'
			});
		}


		teacher.showmsg1=function(id){
			var content=$('#fomm').find("label[for='"+id+"']").text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'请填写'+'【'+content+'】'
			});
		}
		$(function(){
			teacher.init();
		})