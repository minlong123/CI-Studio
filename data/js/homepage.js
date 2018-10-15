		var home={};
		home.init=function(){
			$("#bodyy").layout({loadingMessage:"loding..."});
			$('#start_button').bind('click',function(){
				home.student_load();
			});

			// 学生签到提交
			$('#submit_sign').bind('click',function(){
				var btn_sign=$('#submit_sign').linkbutton('options');
				if(btn_sign.disabled!=true){
					home.save_sign();
				}
			});
			// 老师签到提交
			$('#submit_teacher').bind('click',function(){
				var btn_sign=$(this).linkbutton('options');
				if(btn_sign.disabled!=true){
					home.save_teacher_sign();
				}
			})

			$('#student_search_name').bind("keyup",function(){
				home.search_initials($(this).val());

			});

			$('#teacher_stater').bind('click',function(){
				home.teacher_load();
			});


			$('#class_hour_details').datagrid({
				height:'100%',
				width:'100%',
				title:'课时列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'course_data',title:'课程日期',width:100,align:'center'},
					{field:'timeslot',title:'时间段',width:100,align:'center'},
					{field:'course_content',title:'课程内容',width:150,align:'center'},
				]]
			});


			$('#student_details_data').dialog({
				height:'100%',
				width:'100%',
				title:'学员详情',
				iconCls:'icon-man',
				inline:true,
				fit:true,
				border:false,
				draggable:false,
				closed:true,
			});

			$('#head_panel').panel({
				height:'15%',
				width:'100%',
				border:false,

			})

			$('#course_add').dialog({
				height:300,
				width:280,
				title:'学员课程录入',
				iconCls:'icon-edit',
				modal:true,
				closed:true,
				fixRowHeight:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'save_student',
					handler:function(){
						home.save_student_course();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#course_add').dialog('close');
					}
				}],

			});

			// 按日期查询的内容（日期）
			$('#now_date').calendar({
				current:new Date(),
				onSelect:function(date){
					var year=date.getFullYear();
					var month=date.getMonth()+1;
					var curren=date.getDate();
					if(month<10){
						month="0"+month;
					}
					if(curren<10){
						curren="0"+curren;
					}
					home.show_current_student(year+"-"+month+"-"+curren);
				},
			})

			$('#now_student_date').datagrid({
				url:'index.php/home/get_student',
				queryParams:{sign_data:home.timedate()},
				title:'按日期查询列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				onSelect:function(index,row){
					home.show_student_detailss(index,row);
				},
				columns:[[
					{field:'student_name',title:'姓名',width:80,align:'center'},
					{field:'course_data',title:'课程日期',width:80,align:'center'},
					{field:'timeslot',title:'时间段',width:80,align:'center'},
					{field:'course_content',title:'课程内容',width:80,align:'center'},
					{field:'student_rest',title:'剩余课时',width:80,align:'center'},
				]]
			})


			$('#date_student_details').panel({
				title:'学员详情',
				iconCls:'icon-man',
				fit:true,
			})

		}


		home.show_current_student=function(date){
			$('#now_student_date').datagrid({
				url:'index.php/home/get_student',
				queryParams:{sign_data:date},
			})
		}

		// 向页面更新今天是哪年哪月哪日哪周
		home.get_now_date=function(){
			var date=home.timedate();
			var dated=date.substring(0,4)+"年"+date.substring(5,7)+"月"+date.substring(8,10)+"日";
			$('#today_date').text(dated);
			var week=home.timeweek();
			$('#today_week').text(week);
		
		}

		// 获取今天上课的学生信息
		home.get_course_student=function(){
			$('#foot_dg').datagrid({
				url:'index.php/home/get_student',
				queryParams:{sign_data:home.timedate()},
				height:'85%',
				width:'100%',
				title:'今日上课学员列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'student_name',title:'姓名',width:80,align:'center'},
					{field:'course_data',title:'课程日期',width:80,align:'center'},
					{field:'timeslot',title:'时间段',width:80,align:'center'},
					{field:'uid',title:'id',width:80,align:'center',hidden:true},
					{field:'course_content',title:'课程内容',width:150,align:'center'},
					{field:'student_rest',title:'剩余课时',width:80,align:'center'},
					{field:'action',title:'操作',width:120,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" onclick="home.show_moredata('+index+')">'+"查看"+"&nbsp;"+'</a>'+'<a href="javascript:void(0)" onclick="home.add_course('+index+')">'+"课程录入"+'</a></span>';
					}}
				]]
			})
		}

		// 打开录入课程的窗口填充原有的信息
		home.add_course=function(index){
			$('#course_add').dialog('open');
			var rows=$('#foot_dg').datagrid('getRows');
			$('#course_submit').form('load',rows[index]);
		}

		// 保存课程录入的信息
		home.save_student_course=function(){
			var content=$('#course_submit').serializeArray();
			var _validate=true;
			var labels="address,course_content";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						home.showmsg(item['name']);
						return false;
					}
				}
			})
			if(_validate){
				$('#save_student').linkbutton('disable');
				$.post('index.php/home/save_course_data',content,function(result){
					$('#course_add').dialog('close');
					if(result.success){
						$('#foot_dg').datagrid('reload');
						$('#class_hour_details').datagrid('reload');
						$.messager.show({
							title:'提升',
							msg:'课程录入成功'
						})

					}else{
						$.messager.show({
							title:'录入失败',
							msg:result.msg
						})
					}
					$('#save_student').linkbutton('enable');
				},'json')
			}

		}

		home.showmsg=function(name){
			var content=$('#course_submit').find("label[for='"+name+"']").text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还没输入'+'【'+content+'】'+'呢?',
			})
		}


		// 获取填充当前签到上课的学生总人数
		home.get_course_numbers=function(){
			$.post('index.php/home/get_student',{sign_data:home.timedate()},function(result){
				if(result.total>0){
					$('#course_num').text(result.total);
					$('#foot_dg').datagrid('reload');
				}
			},'json');
		}



		// 点击课时不足人数后，显示详细数据
		home.get_norest_studentdata=function(){
			$('#foot_dg').datagrid({
				url:'index.php/home/get_norest_student',
				height:'85%',
				width:'100%',
				title:'课时不足学员列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'student_name',title:'姓名',width:150,align:'center'},
					{field:'parento',title:'家长',width:150,align:'center'},
					{field:'phoneo',title:'电话',width:150,align:'center'},
					{field:'student_rest',title:'剩余课时',width:150,align:'center'},
					{field:'integral',title:'积分',width:150,align:'center'},
				]]
			});
		}



		// 剩余课时不足的学生总数。指的是小于课时5的都是不足的
		home.no_studetn_rest=function(){
			$.post('index.php/home/nostudent_rest',function(result){
				if(result>0){
					$('#no_rest').text(result);
				}
			});
		}


		// 初始化input学员查询
		home.search_init=function(){
			$('#student_border').css("display",'none');
			// 这里缩小视窗大小后，这个下拉的datagrid数据表格不能实时的贴合在一起，后面有时间来解决
			var x=$('#search_data').offset().left;
			var y=$('#search_data').offset().top;
			$('#student_border').css("top",y+34);
			$('#student_border').css("left",x);
			$('#student_dg').datagrid({
				height:179,
				width:304,
				singleSelect:true,
				striped:true,
				onSelect:function(index,row){
					home.show_student_details(index,row);
				},
				columns:[[
					{field:'student_name',title:'姓名',width:100,align:'center'},
					{field:'student_initials',title:'首字母',width:100,align:'center'},
					{field:'student_rest',title:'剩余课时',width:102,align:'center'}
				]]
			});

// 这里设置为按键松下的时候即时查询信息，同时才会打开datagrid面板，取消了获得焦点的时候触发事件。
			$('#search_data').bind('keyup',function(e){
				home.search_student_data();
			});

			$('#search_data').bind('blur',function(e){
				setTimeout(function(){
					$('#student_border').css("display",'none');
				},1000);				
			});

// 创建文档点击事件，点击后，能够关闭用户很难关闭的下拉datagrid表，后面还可以在触发焦点的时候显示出来。所以这里无碍
// 关于销毁点击事件资料：http://www.cnblogs.com/jiqing9006/archive/2012/09/12/2681323.html
			// $(document).bind('click',xiaohui=function(){
			// 	$('#student_border').css("display",'none');
			// })
			// // 销毁上一个文档点击事件，只执行一次
			// $(document).bind('click',function(){
			// 	$(document).unbind('click',xiaohui);
			// });

		}

		// 根据用户输入的信息更新数据
		home.search_student_data=function(){
			var content=$.trim($('#search_data').val());
			if(content!=""){
				$('#student_border').css("display",'block');
				$('#student_dg').datagrid({
					url:'index.php/home/search_student_data',
					queryParams:{id:content}
				})
			}
		}

		// 搜索栏搜索的数据点击后触发的事件，传当天的时间。
		// 选中查询到的数据调出相关详细信息
		home.show_student_details=function(index,row){
			$('#student_details_data').dialog('open');
			var current_date=home.timedate();
			var uid=row['student_id'];
			$.post('index.php/home/get_student_details',{uid:uid},function(result){
				$('#tab input').each(function(index,item){
					input_name=$(this).attr('name');
					$.each(result,function(index,itemm){
						if(itemm[input_name]!=null){
							name=itemm[input_name];
						}else{
							name="";
						}
					});
					$(this).attr('value',name); 
				});
			},'json');
			$('#class_hour_details').datagrid({
				url:'index.php/home/show_all_course',
				queryParams:{uid:row['student_id']},
			})
		}

		// 这个传当天的时间，是今天上课学员列表里的查看那详情
		// 将基本状况内的数据表格内点击查看后显示的详细信息，写过的最头疼的循环，比上一个复杂点。两个each循环
		home.show_moredata=function(index){
			$('#student_details_data').dialog('open');
			var rows=$('#foot_dg').datagrid('getRows');
			var uid=rows[index]['uid'];
			var current_date=home.timedate();
			$.post('index.php/home/get_student_details',{uid:uid,current_date:current_date},function(result){
				$('#tab input').each(function(index,item){
					input_name=$(this).attr('name');
					$.each(result,function(index,itemm){
						if(itemm[input_name]!=null){
							name=itemm[input_name];
						}else{
							name="";
						}
					});
					$(this).attr('value',name); 
				});
			},'json');
			$('#class_hour_details').datagrid({
				url:'index.php/home/show_all_course',
				queryParams:{uid:uid},
			})
		}


		// 这个传用户点击的那个时间的课程信息
		// 跟上面重复，但是放的位置不同，是按日期查询里面的学员详情
		home.show_student_detailss=function(index,row){
			var rows=$('#now_student_date').datagrid('getRows');
			var uid=rows[index]['uid'];
			var current_date=rows[index]['course_data'];
			$.post('index.php/home/get_student_details',{uid:uid,current_date:current_date},function(result){
				$('#tabbb input').each(function(index,item){
					input_name=$(this).attr('name');
					$.each(result,function(index,itemm){
						if(itemm[input_name]!=null){
							name=itemm[input_name];
						}else{
							name="";
						}
					});
					$(this).attr('value',name); 
				});
			},'json');
		}

		// 关于查找学生的上一节课程和上一节课时间，思路是：
		// 一、先通过已知的学生的uid查出这个学生所有时间内上过的课程。
		// 二、根据uid和时间查出所选中的课程的当前的id,或者已知当前课程的id,查出小于当前id的所有记录。
		// 三、然后order by id desc limit 1 即可。
		// select * from todaycourse where uid=1 and id<10 order by id desc limit 1 已知uid和id
		// select * from todaycourse where uid=1 and id<(select id from todaycourse where uid=1 and course_data=$date) limit 1只知道uid和接收的当前课程的日期。
		// 根据已知的uid和和获取的当前的时间来求上一次课程的时间和内容

		// select id,uid,course_data,course_content from todaycourse where uid=3 and id<(select id from todaycourse where uid=3 and course_data='2018-03-05') order by id desc limit 1

		// 现在的问题是如何将查询的数据加入已经查询出来的数据当中还是单独post



		// 所有获取时间的操作
		// 获取今天的日期xxxx-xx-xx形式
		home.timedate=function(){
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
			var now_date=year+"-"+month+"-"+date;
			return now_date;
			// alert(now_date);
		}

		// 获取当前时间段
		home.timeslog=function(){
			var dat=new Date();
			var hour=dat.getHours();
			if(hour<13){
				return "上午";
			}else if(hour>=13){
				return "下午";
			}
		}

		// 获取今天是哪一周
		home.timeweek=function(){
			var day=new Date();
			var thisday=day.getDay();
			switch(thisday){
				case 0:
					return "星期天";
				case 1:
					return "星期一";
				case 2:
					return "星期二";
				case 3:
					return "星期三";
				case 4:
					return "星期四";
				case 5:
					return "星期五";
				case 6:
					return "星期六";

			}
		}

		// / 学生点击开始签到后向服务器请求数据
		home.student_load=function(){
			$.post('index.php/home/student',function(result){
				if(result.length>0){
					home.student_show(result);
				}
			},'json')
			// 这里出了一个问题，就是自己没写接收的是json数据，导致报错纠结半天在解决
		}
		// 处理上一个属性传过来的数据，填充至前台中
		home.student_show=function(result){
				$('#start_button').css("display","none");
				$("#student_search_data").css("display","block");
				$('#student_search_submit').css("display","block");
				$.each(result,function(index,item){
					var student_letter=item["student_initials"].substr(0,1);
					$('#student_search_data .name_'+student_letter).css('display','block');
		// 这里会用到apendTo方法：http://www.runoob.com/try/try.php?filename=tryjquery_html_appendto
		// 要注意里面的单引号和双引号和+的写法
					var student_data=$("<a href='javascript:void(0);' data-student_letter='"+item['student_initials']+"' id='student_id_"+item['student_id']+"' style='margin-left:10px;'>"+item['student_name']+"</a>").appendTo($('#student_search_data .name_'+student_letter));
					$('#student_id_'+item['student_id']).linkbutton();
					student_data.bind('click',function(){
						var btn_options=$('#student_id_'+item['student_id']).linkbutton('options');//返回来的是个对象
						if(btn_options.disabled !=true){//这里就可以使用对象.属性调用了
							home.add_data_student($(this));
							$('#student_id_'+item['student_id']).linkbutton('disable');
						}
					})

				});
				home.Submitted_student();
		}

		// 提交之前设置增删进行签到的学生数
		home.add_data_student=function(btn_dom){
			var uid=btn_dom.attr('id');
			var uname=btn_dom.text();
			var btn_student=$("<a href='javascript:void(0)' id='"+uid+"' style='margin-left:10px;'>"+uname+"</a>").appendTo($('#student_index'));
			btn_student.linkbutton();
			btn_student.bind('click',function(){
				btn_dom.linkbutton('enable');
				$(this).remove();
			});
		}



// 在用户点击签到的时候，展示所有学生信息后调用这个方法给当天已签到过的学生加disable。先通过当天的时间进行查询有没有今天签到的学生，如果没有签到的返回false，如果有签到的返回学生的id，然后根据id，遍历设置每个按钮为enable
		home.Submitted_student=function(){
			$.post('index.php/home/get_today_student',{go_toclass:home.timedate()},function(result){
					$.each(result,function(index,item){
					  $("#student_id_"+item.uid).linkbutton('disable');
					})
			},'json');
		}


		home.Submitted_teacher=function(){
			$.post('index.php/home/get_today_teacher',{now:home.timedate()},function(result){
				$.each(result,function(index,item){
					$("#teacher_"+item.uid).linkbutton('disable');
				});
			},'json');
		}


		// 当客户输入首字母的时候，能够快速将字母对应的学生姓名放在最前面。
		// 先获取用户输入的字母，然后将所有学生的linkbutton隐藏掉,然后匹配用户输入的字母显示查询到的数据。
		// 输入的字母越多，查询结果越精准。
		home.search_initials=function(search_val){
			if(search_val!=""){
				var content=search_val.substr(0,1);
				$("#student_search_data p").each(function(index){
					if(index!=0){
						$(this).css('display','none');
						$('.name_'+content).css('display','inline-block');
					}
				});
		// 寻找在上一次插入数据的data-student_letter:的数据然后比对用户输入的内容，不等于-1的情况下让a标签的内容显示出来
				$(".name_"+content+" a").each(function(){
					if($(this).data("student_letter").indexOf(search_val)!=-1){
						$(this).css('display','inline-block');
					}else{
						$(this).css('display','none');
					}
				});

			}else{
				// 用户未输入任何字母的时候，将没有数据的p标签全部隐藏
				$("#student_search_data p").each(function(index){
					if(index!=0){
						$(this).css('display','block');
						if($(this).find("a").length<1){
							$(this).css('display','none');
						}else{
							$(this).find("a").css('display','inline-block');
						}

					}
				});
			}
			

		}


		// 学生签到提交
		home.save_sign=function(){
			var sgin_id="";
			$('#submit_sign').linkbutton('disable');
			$('#student_index a').each(function(){
				var id=$(this).attr('id');
				id=id.substring(11,id.length);
				// substring() 方法用于提取字符串中介于两个指定下标之间的字符。
				// http://www.w3school.com.cn/jsref/jsref_substring.asp
				if(sgin_id==""){
					sgin_id=id;
				}else{
					sgin_id=sgin_id+","+id;
				}
			});
			//alert(sgin_id);//测试成功，成功弹出签到的学生所对应的ID组合的字符串
			if(sgin_id==""){
				$('#submit_sign').linkbutton('enable');
				return false;
			}else{
				$.post('index.php/home/sign',{sgin_id:sgin_id,timeslot:home.timeslog()},function(result){
					$('#submit_sign').linkbutton('enable');
					if(result.success){
						$('#student_index a').remove();
						$.messager.show({
							title:'成功提交',
							msg:'已成功提交'
						})
						home.get_course_numbers();
					}else{
						$('#student_index a').remove();
						$.messager.show({
							title:'提交失败',
							msg:result.msg
						})
					}
				},'json');
			}
// 把当前的时段和当天签到上课的学生id，post到数据库内。在modal内将该字符串遍历查询数据库信息，然后填充到每天上课的数据表当中。同时将上课的各学生的课时分别减1.
		}

		// 远程加载教师的数据，并传给home.teacher_sign()
		home.teacher_load=function(){
			$.post('index.php/home/get_teacherdata',function(result){
				if(result.length>0){
					home.teacher_sign(result);
				}
			},'json')
		}


		// 处理教师的数据并传输给页面
		home.teacher_sign=function(result){
				$('#teacher_stater').css("display","none");
				$('#start_teacher').css("display","block");
				$('#teacher_search_submit').css("display","block");
				$.each(result,function(index,item){
					$("<a href='javascript:void(0);'  id='teacher_"+item['tercher_id']+"' style='margin-left:10px;'>"+item['teacher_name']+"</a>").appendTo($('#p_teacher'));
					$('#teacher_'+item['tercher_id']).linkbutton();
					$('#teacher_'+item['tercher_id']).bind('click',function(){
						var btn_options=$(this).linkbutton('options');
						if(btn_options.disabled!=true){
							home.add_data_teacher($(this));
							$('#teacher_'+item['tercher_id']).linkbutton('disable');
						}
					})

				});
				home.Submitted_teacher();//把当前已经签到过的学生按钮禁用

		}
		// 点击签到提交前发生的事情
		home.add_data_teacher=function(btn_dom){
			var uid=btn_dom.attr('id');
			var uname=btn_dom.text();
			$("<a href='javascript:void(0)' id='teacher_sub_"+uid+"' style='margin-left:10px;'>"+uname+"</a>").appendTo($('#p_teacherr'));
			$('#teacher_sub_'+uid).linkbutton();
			$('#teacher_sub_'+uid).bind('click',function(){
				btn_dom.linkbutton('enable');
				$(this).remove();
			});
		}
		// 教师签到提交
		home.save_teacher_sign=function(){
			var sgin_teacher_id="";
			$('#submit_teacher').linkbutton('disable');
			$('#p_teacherr a').each(function(){
				var id=$(this).attr('id');
				id=id.substring(20,id.length);
				if(sgin_teacher_id==""){
					sgin_teacher_id=id;
				}else{
					sgin_teacher_id=sgin_teacher_id+","+id;
				}
			});
			if(sgin_teacher_id==""){
				$('#submit_teacher').linkbutton('enable');
				return false;
			}else{
				$.post('index.php/home/teacher_sign',{id:sgin_teacher_id,timeslot:home.timeslog()},function(result){
					$('#p_teacherr a').remove();
					if(result.success){
						$('#submit_teacher').linkbutton('enable');
						$.messager.show({
							title:'签到提示',
							msg:'教师签到成功'
						})
					}else{
						$.meeager.show({
							title:'签到提示',
							msg:result.msg
						})
					}
				},'json')
			}
		}
		$(function(){
			home.init();
			home.search_init();
			home.get_course_numbers();
			home.get_course_student();
			home.no_studetn_rest();
			home.get_now_date();
		});