var student={};
		student.save=function(){
			$('#addst').dialog({
				title:"添加学员",
				iconCls:"icon-add",
				modal:true,
				closed:true,
				fixRowHeight:true,
				buttons:[{
					text:"保存",
					iconCls:"icon-ok",
					id:'add_save',
					handler:function(){
						student.add();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#addst').dialog('close');
					}
				}]
			});

			$('#edit_student').dialog({
				title:'修改学员信息',
				iconCls:'icon-edit',
				modal:true,
				closed:true,
				buttons:[{
					text:"保存",
					iconCls:"icon-ok",
					id:'edit_studentdate',
					handler:function(){
						student.save_editstudent();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#edit_student').dialog('close');
					}
				}]
			});
		
			$('#new_student').dialog({
				title:"学员新学期报名",
				iconCls:'icon-edit',
				height:250,
				width:275,
				modal:true,
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'new_save',
					handler:function(){
						student.saveEnrolment();
					}

				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#new_student').dialog('close');
					}
				}]

			});

			$('#Statistics').bind("click",function(){
				$('#charts').dialog("open");
			});
			$('#charts').dialog({
				width:"100%",
				height:"100%",
				title:"学员统计信息",
				closed:true,
				modal:true,
				draggable:false,
				fixRowHeight:true,
				inline:true,
				buttons:[{
					text:'关闭',
					iconCls:'icon-cancel',
					handler:function(){
						$('#charts').dialog('close');
					}

				}]
			});	

		}

		$('#studata').datagrid({
			url:'index.php/student/get_studentdata',
			fitColumns:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			border:'false',
			title:'学员列表',
			onSelect:function(index,row){
				student.show_details(index,row);
			},
			columns:[[
				{field:"student_name",title:"姓名",width:100,align:'center'},
				{field:"student_id",title:"id",width:0,align:'center',hidden:true},
				{field:"student_initials",title:"首字母",width:70,align:'center'},
				{field:"student_age",title:"年龄",width:50,align:'center'},
				{field:"student_data",title:"报名日期",width:120,align:'center'},
				{field:"student_rest",title:"剩余课时",width:50,align:'center'},
				{field:"student_action",title:"操作",width:100,align:'center',formatter:function(value,row,index){
					return '<span style="color:red;">'+
					'<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:student.newEnrolment('+index+');">'+"新报名"+'</a>'+"&nbsp"+
					'<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:student.edit_student('+index+');">'+"修改"+'</a>'+"&nbsp"+
					'<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:student.destroy_student('+index+');">'+"删除"+'</a></span>';
				}},
			]]
		});
		$(".searcc").bind('click',function(){
			var search_student=$.trim($("#search_data").val());
			if(search_student!=""){
				$('#studata').datagrid("loading");
				$.post('index.php/student/get_search',{search:search_student},function(result){
					$('#studata').datagrid('loaded');
					$('#studata').datagrid('loadData',result);
				},'json')
			}else{
				$.messager.confirm('confirm','搜索不能为空,请重新输入',function(r){
					if(r==true){
						$('#studata').datagrid('reload');
					}
				})
			}

		});

		$('#add_students').bind('click',function(){
			$('#addst').dialog('open');
			$('#fm').form('clear');
		});

		$('#renew_details').datagrid({
			title:'学员报名详情',
			pagination:true,
			rownumbers:true,
			fitColumns:true,
			singleSelect:true,
			columns:[[
				{field:'renew_date',title:'报名日期',width:100,align:'center'},
				{field:'add_classhour',title:'新增课时数',width:100,align:'center'},
				{field:'remarks',title:'备注',width:350,align:'center'}
			]]
		});
		

		// 添加打开新学期报名窗口并填充基本信息
		student.newEnrolment=function(index){
			var row=$('#studata').datagrid('getRows');
			$('#fomm').form('clear');
			$('#new_student').dialog('open');
			$('#fomm').form('load',row[index]);

		}



		// 修改学员信息
		student.edit_student=function(index){
			var rows=$('#studata').datagrid('getRows');
			$('#edit_student').dialog('open');
			$('#edit_fm').form('load',rows[index]);

		}
		
		// 保存修改好的学员信息
		student.save_editstudent=function(){
			var data=$('#edit_fm').serializeArray();
			var _validate=true;
			var labels="student_name,student_initials,student_age,student_birthday,parento,phoneo,sex,address,classType";
			$.each(data,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						student.showmsg(item['name']);
						return false;
					}
				}
			});
			if(_validate){
				$('edit_studentdate').linkbutton('disable');
				$.post('index.php/student/edit_studentdata',data,function(result){
					if(result.success){
						$('#edit_student').dialog('close');
						$('#studata').datagrid('reload');
						$.messager.show({
							title:'已成功修改内容',
							msg:'已成功提交'
						})
					}else{
						$.messager.show({
							title:'提交失败',
							msg:result.msg
						})
					}
					$('edit_studentdate').linkbutton('enable');
				},'json')
			}
		}


		// 保存新学期报名信息
		student.saveEnrolment=function(){
			var student_hour=$('#fomm').serializeArray();
			var _hour=true;
			var labels="student_name,renew_date,add_classhour";
			$.each(student_hour,function(index,item){
				if(labels.indexOf(item["name"])!=-1){
					if($.trim(item["value"])==""){
						_hour=false;
						student.showmsg2(item["name"]);
						return false;
					}
				}
			});
			if(_hour){
				$('#new_save').linkbutton('disable');
				$.post('index.php/student/add_hour',student_hour,function(result){
					if(result.success){
						$('#new_student').dialog('close');
						$('#studata').datagrid('reload');
						$.messager.show({
							title:'提成成功通知',
							msg:'已成功提交'
						})
					}else{
						$.messager.show({
							title:'提交失败通知',
							msg:result.msg
						})
					}
					$('#new_save').linkbutton('enable');
				},'json');
			}
		}


		// 增加学员信息
		student.add=function(){
			var data=$('#fm').serializeArray();
			var _validate=true;
			var labels="student_name,student_initials,student_age,student_birthday,parento,phoneo,sex,address,classType";
			$.each(data,function(index,item){
				if(labels.indexOf(item["name"])!=-1){
					if($.trim(item["value"])==""){
						_validate=false;
						student.showmsg(item["name"]);
						return false;
					}
				}
			});
			if(_validate){
				$('add_save').linkbutton('disable');
				$.post("index.php/student/save_student",data,function(result){
					if(result.success){
						$('#addst').dialog('close');
						$('#studata').datagrid('reload');
						$.messager.show({
							title:'提交成功通知',
							msg:'已成功提交'
						})
					}else{
						$.messager.show({
							title:'提交失败通知',
							msg:result.msg
						})
					}
					$('add_save').linkbutton('enable');
				},'json');
			}
		}


		// 删除用户信息
		student.destroy_student=function(index){
			var rows=$('#studata').datagrid('getRows');
			var student_id=rows[index].student_id;
			var name=rows[index].student_name;
			$.messager.confirm('提示','确认删除【'+name+'】学员吗？',function(r){
				if(r==true){
					$.post('index.php/student/destroy_data',{id:student_id},function(result){
						if(result.success){
							$('#studata').datagrid('reload');
							$.messager.show({
								title:'提交成功提示',
								msg:'删除成功'
							})
						}else{
							$.messager.show({
								title:'删除失败',
								msg:result.msg
							})
						}
					},'json');
				}
			});


		}
		// 弹出未填写信息窗口
		student.showmsg=function(msgdata){
			var content=$('#fm').find("label[for='"+msgdata+"']").text().replace(":","");
			$.messager.show({
				title:'您好',
				msg:'请正确填写【'+content+'】',
				showType:'show'
			})
		}

		// 弹出未填写信息窗口
		student.showmsg2=function(msgdata){
			var content=$('#fomm').find("label[for='"+msgdata+"']").text().replace(":","");
			$.messager.show({
				title:'您好',
				msg:'请正确填写【'+content+'】',
				showType:'show'
			})
		}

		// 向panel界面添加触发后的每一行的内容
		// 关于each、attr的使用多看下
		student.show_details=function(index,row){

			// 点击学员列表后向学员表单详情列表内添加内容
			$('#tab input').each(function(index,item){
				var span_name=$(this).attr('name');
				if(row[span_name]!=null){
					$(this).attr('value',row[span_name]);
				}else{
					$(this).attr('value',"");
				}
			});

			// 点击学员列表后向学员新报名列表中查询数据库内容
			$('#renew_details').datagrid({
				url:'index.php/student/show_renewdata',
				queryParams:{uid:row['student_id']}
			});
		}

		$(function(){
			student.save();
		});