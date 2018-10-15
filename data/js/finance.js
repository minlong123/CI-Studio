		var finance={};
		finance.init=function(){
			$('#btn_serach').bind('click',function(){
				var start_date=$('#search_data').datebox('getValue');
				var end_date=$('#search_end').datebox('getValue');
				var s=finance.time_stamp(start_date);
				var e=finance.time_stamp(end_date);
				if(start_date==""){
					$.messager.show({
						title:'提示',
						msg:'请输入起始日期',
					})
					return false;
				}else if(end_date==""){
					$.messager.show({
						title:'提示',
						msg:'请输入截止日期',
					})
					return false;
				}else if(s>e){
					$.messager.show({
						title:'提示',
						msg:'起始时间不能大于截至时间',
					})
					return false;
				}else{
					$('#finance_list').datagrid('load',{start:start_date,end:end_date});
				}
			})
			$('#finance_list').datagrid({
				url:'index.php/finance/get_finance_details',
				queryParams:{start:finance.month_first_date(),end:finance.month_last_date()},
				height:'93%',
				width:'100%',
				title:'财务明细列表',
				toolbar:'#toolbar',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				columns:[[
					{field:'finance_type',title:'类型',width:45,align:'center',formatter:function(value,row,index){
						if(value=="收入"){
							return '<span style="color:green">'+value+'</span>';
						}else{
							return '<span style="color:red">'+value+'</span>';
						}

					}},
					{field:'finance_money',title:'金额',width:80,align:'center'},
					{field:'finance_details',title:'明细',width:169,align:'center'},
					{field:'finance_date',title:'账目日期',width:80,align:'center'},
					{field:'finance_entering',title:'录入时间',width:150,align:'center'},
					{field:'action',title:'操作',width:80,align:'center',formatter:function(value,row,index){
						return '<span><a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:finance.edit_finance_details('+index+');">'+"修改"+'</a>'+'</span>';
					}},
				]]
			})
			$('#record_money').dialog({
				title:'入账/出账录入',
				iconCls:'icon-edit',
				height:290,
				width:290,
				modal:true,
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'save_record',
					handler:function(){
						finance.save_record_details();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#record_money').dialog('close');
					}
				}]
			})

			$('#edit_record').dialog({
				title:'入账/出账修改',
				iconCls:'icon-edit',
				height:290,
				width:290,
				modal:true,
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'edit_record_detail',
					handler:function(){
						finance.edit_record_details();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#edit_record').dialog('close');
					}
				}]
			})
			$('#finance_date').datebox('setValue','finance.current_now_date()');

			$('#add_finance_btn').bind('click',function(){
				$('#record_money').dialog('open');
			})
			$('#this_month').bind('click',function(){
				$('#finance_list').datagrid('load',{start:finance.month_first_date(),end:finance.month_last_date()})
			})
			$('#last_month').bind('click',function(){
				$('#finance_list').datagrid('load',{start:finance.last_month_start(),end:finance.last_month_end()})
			})
		}
//页面打开后会显示当月的收支记录，然后是上月的收支记录，如果要找更多的财务记录就需要输入时间进行查询
		finance.time_stamp=function(dat){
			var day=new Date(dat);
			return day.getTime();
		}
		// 获取当天的时间
		finance.current_now_date=function(){
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
			var current=year+"-"+month+"-"+date;
			return current;

		}

		// 获取当月的第一天日期
		finance.month_first_date=function(){
			var day=new Date();
			var year=day.getFullYear();
			var month=day.getMonth()+1;
			if(month<10){
				month="0"+month;
			}
			var first=year+"-"+month+"-01";
			return first;
		}

		// 获取当月的最后一天日期
		finance.month_last_date=function(){
			var day=new Date();
			var year=day.getFullYear();
			var month=day.getMonth()+1;
			var lastdate=finance.month_num(month,year);
			if(month<10){
				month="0"+month;
			}
			if(lastdate<10){
				lastdate="0"+lastdate;
			}
			var last=year+"-"+month+"-"+lastdate;
			return last;

		}
		// 获取上个月的第一天日期,获取的当前月份减1.
		finance.last_month_start=function(){
			var day=new Date();
			var year=day.getFullYear();
			var month=day.getMonth()+1;
			month=month-1;
			if(month<10){
				month="0"+month;
			}
			var first=year+"-"+month+"-01"; 
			return first;
		}


		// 获取上个月的最后一天日期
		finance.last_month_end=function(){
			var day=new Date();
			var year=day.getFullYear();
			var month=day.getMonth()+1;
			month=month-1;
			var lastdate=finance.month_num(month,year);
			if(month<10){
				month="0"+month;
			}
			if(lastdate<10){
				lastdate="0"+lastdate;
			}
			var last=year+"-"+month+"-"+lastdate;
			return last;
		}

// 根据月份和年份，获取每个月多少天，天数既是每个月的最后一天的日期
		finance.month_num=function(month,year){
			var days=null;
			switch(month){
				case 1:
				case 3:
				case 5:
				case 7:
				case 8:
				case 10:
				case 12:
					days=31;
					break;
				case 2:
					if(year%4==0 && year%100==0 || year%400==0){
						days=29;
					}else{
						days=28;
					}
					break;
				default:
					days=30;
					break;
			}
			return days;
		}


		// 入账出账事件
		finance.save_record_details=function(){
			$('#save_record').linkbutton('disable');
			var content=$('#fom').serializeArray();
			var _validate=true;
			var labels="finance_money,finance_details";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						$('#save_record').linkbutton('enable');
						_validate=false;
						finance.showmsg(item['name']);
						return false;
					}
				}
			})
			if(_validate){
				$.post('index.php/finance/save_record',content,function(result){
					if(result.success){
						$('#save_record').linkbutton('enable');
						$('#finance_list').datagrid('reload');
						$('#record_money').dialog('close');
						$.messager.show({
							title:'提示',
							msg:'记账成功',
						})
					}else{
						$.messager.show({
							title:'提示',
							msg:result.msg,
						})
					}
				},'json')
			}
		}
		// 验证未输入内容弹出信息框
		finance.showmsg=function(msg){
			var content=$('#fom p').find('label[for="'+msg+'"]').text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还未输入'+'【'+content+'】',
			})
		}

		// 点击修改后的事件
		finance.edit_finance_details=function(index){
			var row=$('#finance_list').datagrid('getRows');
			$('#edit_record').dialog('open');
			$('#fmm').form('load',row[index]);

		}

		// 保存修改后的表单后发生的事情
		finance.edit_record_details=function(){
			$('#edit_record_detail').linkbutton('disable');
			var content=$('#fmm').serializeArray();
			var _validate=true;
			var labels="finance_money,finance_details";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						$('#edit_record_detail').linkbutton('enable');
						_validate=false;
						finance.showmsg2(item['name']);
						return false;
					}
				}
			})
			if(_validate){
				$.post('index.php/finance/edit_record',content,function(result){
					if(result.success){
						$('#edit_record_detail').linkbutton('enable');
						$('#finance_list').datagrid('reload');
						$('#edit_record').dialog('close');
						$.messager.show({
							title:'提示',
							msg:'修改成功',
						})
					}else{
						$.messager.show({
							title:'提示',
							msg:result.msg,
						})
					}
				},'json')
			}
		}
		finance.showmsg2=function(msg){
			var content=$('#fmm p').find('label[for="'+msg+'"]').text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还未填写'+'【'+content+'】',
			})
		}
		$(function(){
			finance.init();		
		})