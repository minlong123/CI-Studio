		var course={};
		course.init=function(){
			$('#student_list_data').datagrid({
				height:'97%',
				width:'100%',
				url:'index.php/course/get_all_student',
				rownumbers:true,
				singleSelect:true,
				fitColumns:true,
				pagination:true,
				title:'学员列表',
				onSelect:function(index,row){
					course.get_student_course(index,row);
				},
				columns:[[
					{field:'student_name',title:'姓名',width:80,align:'center'},
					// {field:'student_integral',title:'积分',width:80,align:'center'},
					// {field:'uid',title:'id',width:80,align:'center'},
					{field:'student_rest',title:'剩余课时',width:80,align:'center'},
					{field:'action',title:'操作',width:80,align:'center',formatter:function(value,row,index){
						return '<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:course.add_student_default('+index+');">'+"增加"+'</a>';
					}},

				]],
			});


			$('#add_student_hour').dialog({
				height:300,
				width:300,
				modal:true,
				title:"添加学员课时",
				iconCls:'icon-add',
				closed:true,
				buttons:[{
					text:'保存',
					id:'save_student_hour',
					iconCls:'icon-ok',
					handler:function(){
						course.save_student();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#add_student_hour').dialog('close');
					}
				}],
			});


			$('#course_hour').datagrid({
				height:713,
				width:'100%',
				title:'课时列表',
				rownumbers:true,
				singleSelect:true,
				fitColumns:true,
				pagination:true,
				columns:[[
					{field:'course_data',title:'课程日期',width:80,align:'center'},
					{field:'timeslot',title:'时间段',width:80,align:'center'},
					{field:'course_content',title:'课程内容',width:150,align:'center'},
					{field:'action',title:'操作',width:80,align:'center',formatter:function(value,row,index){
						// 如果课程日期大于等于当天的时间则显示修改按钮，如果小于则不显示
						// 获取当前的时间
						var current_time=course.current_date();
						var nowdate=course.time_stamp(current_time);

						if(course.time_stamp(row['course_data'])>=nowdate){
							return '<a href="javascript:void(0)" onclick="javascript:course.default_edit_hour('+index+');">'+"修改"+'</a>';
						}else{
							return '<span>'+'不可修改，请新增'+'</span>';
						}
					}},

				]],
			})


			$('#edit_course_hour').dialog({
				height:300,
				width:300,
				modal:true,
				title:"修改学员课时",
				iconCls:'icon-edit',
				closed:true,
				buttons:[{
					text:'保存',
					id:'edit_student_hour',
					iconCls:'icon-ok',
					handler:function(){
						course.edit_student();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#edit_course_hour').dialog('close');
					}
				}],	
			})
			$('#btn_serach').bind('click',function(){
				var content=$('#search_data').val();
				course.search_update_data(content);
			});


		}

		// 这里有个问题，如果用户一直不断的点查询，那就会不断的创建大量的数据库连接，后面工作的时候，就需要给所有的点击事件加不同响应速度的事件节流
		course.search_update_data=function(data){
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

		course.current_date=function(){
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
			var nowdate=year+"-"+month+"-"+date;
			return nowdate;
		}

		// 计算时间戳
		course.time_stamp=function(dat){
			var day=new Date(dat);
			return day.getTime();

		}


		// 预定义打开添加学员课时的dialog表
		// 如果学员的剩余课时为0的话,不能新增课程。
		course.add_student_default=function(index){
			var rows=$('#student_list_data').datagrid('getRows');
			if(rows[index].student_rest<=0){
				$.messager.confirm('Confirm','课时不足,确定继续添加该学生课时吗?',function(r){
					if(r==true){
						$('#add_student_hour').dialog('open');
					}
				})
			}else{
				$('#add_student_hour').dialog('open');
			}
			$('#course_submit').form('load',rows[index]);
			var nowdate=course.current_date();
			$('#course_data').attr('value',nowdate);
			// var rowss=$('#course_hour').datagrid('getRows');
			// 打开表单的时候验证是否当天是否已增加过，每个学生每天只能增加一个课程安排，如果当天有课时安排，不弹出。做判断
			// for(var i=0;i<rowss.lenght;i++){
			// 	alert(rowss[i]['course_data']);
			// }
			// alert(rowss.length);


		}

		// 当用在学员列表中选中一行的时候触发
		course.get_student_course=function(index,row){
			var uid=row['student_id'];
			$('#course_hour').datagrid({
				url:'index.php/course/get_course_hour',
				queryParams:{uid:uid},
			});
		}

		// 当添加学员课时，保存的时候触发 insert 各表中的剩余学生课时-1。js做一些判断，如果用户没填信息，是不允许提交的。
		// 还有一种情况是，如果今天已经增加了一个课程，但是还增加一个今天的课程是不能允许的，这样的情况下，需要进行判断
		// 提交后，需要查找今天这个学生在数据库或已加载的本地数据是否有一个课程了，如果有，则不保存，并向前台反馈今天的课程已安排，请修改今天的课程或者为新增未来几天的课程，如果没有，则保存到数据库。然后数据库插入数据及更新剩余课时。
		course.save_student=function(){
			var content=$("#course_submit").serializeArray();
			var _validate=true;
			var labels="address,course_content";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						course.showmsg(item['name']);
						return false;
					}
				}
			});
			if(_validate){
				$('#save_student_hour').linkbutton('disable');
				var nowdate=course.current_date();
				var rowss=$('#course_hour').datagrid('getRows');
				var _content=true;
				for(var i=0;i<rowss.length;i++){
					if(rowss[i]['course_data']==nowdate){
						$('#add_student_hour').dialog('close');
						$('#save_student_hour').linkbutton('enable');
						$.messager.confirm('Confirm','该学生今天的课程已安排，请修改今天的课程或者新增未来几天的课程',function(r){
							if(r){
								$('#course_hour').datagrid('reload');
								$('#student_list_data').datagrid('reload');
							}
						});
						 _content=false;
					}
				}
				if(_content){
					$('#save_student_hour').linkbutton('enable');
					$.post('index.php/course/insert_student_course',content,function(result){
						if(result.success){
							$('#add_student_hour').dialog('close');
							$('#course_hour').datagrid('reload');
							$('#student_list_data').datagrid('reload');
							$.messager.show({
								title:'提示',
								msg:'学员课时增加成功',
							})
						}else{
							$('#add_student_hour').dialog('close');
							$.messager.show({
								title:'提示',
								msg:result.msg,
							})
						}
					},'json');
				}

			}
		}	

		// 保存修改后的课时信息时触发，update
		
		// 思路：如果用户没有修改信息，而是直接点保存，那么可以不用去连接数据库更新，虽然一般用户不会这么做，而是点取消，但是还有会有百分几的可能性会去这样做，当基数足够多的时候，这里就成了一个bug。所以应该加一个判断。还有更细的一点就是如果用户值修改了一个内容，就保存，那我们不必将所有数据重新更新一遍。他修改了哪个，就更新哪个。后面有时间再来思考这个问题
		
		// 这里还有一个细节，为了避免用户选择了过去的时间修改成功以及修改昨天的课时，这里要做一个判断，如果不是今天及以后的时间的课程没有修改的按钮，如果是今天及未来几天的时间就可以弹出修改窗口，这个已经在上面formatter格式化中实现，弹出窗口后，如果用户修改的时间为过去的时间，要弹出信息窗口提示请修改今天及以后的课程,过去的日期无效。也已在下方实现
		course.edit_student=function(){
			$('#edit_student_hour').linkbutton('disable');
			var content=$('#course_edit').serializeArray();
			var input_content=$('.edit_date').val();
			var current_time=course.current_date();
			var nowdate=course.time_stamp(current_time);
			if(course.time_stamp(input_content)<nowdate){
				$('#edit_student_hour').linkbutton('enable');
				$.messager.confirm('Confirm','请修改今天及以后的课程,过去的日期无效',function(r){});
			}else{
				$.post('index.php/course/edit_student_date',content,function(result){
					if(result.success){
						$('#edit_course_hour').dialog('close');
						$('#course_hour').datagrid('reload')
						$.messager.show({
							title:'提示',
							msg:'修改成功',
						});
					}else{
						$.messager.show({
							title:'提示',
							msg:result.msg,
						})
					}
					$('#edit_student_hour').linkbutton('enable');
				},'json');
			}
		}
		// 点击修改按钮后，预定义和填充的待修改的信息
		course.default_edit_hour=function(index){
			var row=$('#course_hour').datagrid('getRows');
			$('#edit_course_hour').dialog('open');
			$('#course_edit').form('load',row[index]);
		}


		// 当用户在表单内未填全信息的时候，触发。
		course.showmsg=function(name){
			var content=$('#course_submit').find("label[for='"+name+"']").text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还未填写'+'【'+content+'】',
			})
		}


		$(function(){
			course.init();
		})