		var admin={};
		admin.init=function(){
			$('#admin_list').datagrid({
				url:'index.php/admin/get_admin_data',
				height:'100%',
				width:'100%',
				title:'管理员列表',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				onSelect:function(index,row){
					$('#fom').form("load",row);
					$('#username').attr("readonly","readonly");
				},
				columns:[[
					{field:'username',title:'登陆账号',width:100,align:'center'},
					{field:'myname',title:'姓名',width:100,align:'center'},
					{field:'admin_type',title:'类型',width:100,align:'center',formatter:function(value,row,index){
						if(value==0){
							return '<span>'+"普通管理员"+'</span>';
						}else{
							return '<span>'+"超级管理员"+'</span>';
						}
					}},
					{field:'myphone',title:'电话',width:100,align:'center'},
					{field:'action',title:'操作',width:50,align:'center',formatter:function(value,row,index){
						// id是唯一的，所以这里只有一个超级管理员能进行删除操作，其他添加的超级管理员不能删除
						if(row['id']!=1){
							return '<span><a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:admin.edit_user('+index+');">'+"删除"+'</a></span>';
						}
					}},

				]],
			})
			$('#edit_ps').dialog({
				height:220,
				width:300,
				title:'修改当前登录帐号密码',
				iconCls:'icon-edit',
				modal:true,
				closed:true,
				buttons:[{
					text:'保存',
					iconCls:'icon-ok',
					id:'save_password',
					handler:function(){
						admin.sava_user_pw();
					}
				},{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#edit_ps').dialog('close');
					}
				}]



			})
			$('#btn_admin').bind('click',function(){
				$('#username').focus();
			})

			$('#save_admin').bind('click',function(){
				admin.save_new_user();
			})

			$('#edit_pw_btn').bind('click',function(){
				$('#edit_ps').dialog('open');
			})
		}

		// 修改当前登录帐号密码后的保存操作
		// 判断是否为空，判断两次输入的密码是否相同、判断旧密码是否正确。以上判断结束后才能正确修改
		admin.sava_user_pw=function(){
			$('#save_password').linkbutton('disable');
			var old_pw=$('#old_pw').val();
			var new_pw=$('#new_pw').val();
			var new_pw_validate=$('#new_pw_validate').val();
			if(old_pw=="" || new_pw=="" || new_pw_validate==""){
				$('#save_password').linkbutton('enable');
				$.messager.show({
					title:'提示',
					msg:'必须全部输入',
				})
			}else if(new_pw!=new_pw_validate){
				$('#save_password').linkbutton('enable');
				$.messager.show({
					title:'提示',
					msg:'两次输入的新密码不一致',
				})
			}else{
				$.post('index.php/admin/edit_pass',{old_pw:old_pw,new_pw_validate:new_pw_validate},function(result){
					if(result.success){
						$('#save_password').linkbutton('enable');
						$('#edit_ps').dialog('close');
						$.messager.show({
							title:'提示',
							msg:'修改成功',
						})
						window.location.href='index.php/logout';
					}else{
						$.messager.alert('提示','原密码错误','error');
						$('#save_password').linkbutton('enable');
					}
				},'json');
			}

		}
		// 删除普通管理员操作
		admin.edit_user=function(index){
			var row=$('#admin_list').datagrid('getRows');
			$.messager.confirm('Confirm','确定删除'+'【'+row[index]['username']+'】',function(r){
				if(r==true){
					$.post('index.php/admin/destroy_user',{id:row[index]['id']},function(result){
						if(result.success){
							$('#admin_list').datagrid('reload');
							$.messager.show({
								title:'提示',
								msg:'删除成功',
							})
						}else{
							$.messager.show({
								title:'提示',
								msg:result.msg,
							})
						}
					},'json')
				}
			})
		}

		// 保存新增的普通管理员事件
		admin.save_new_user=function(){
			$('#save_admin').linkbutton('disable');
			var content=$('#fom').serializeArray();
			var _validate=true;

			// 以下注释写法可以往json数据里添加内容
			// var arr={
			// 	"name":"admin_type",
			// 	"value":$('#admin_type').combobox('getValue')
			// }
			// content.push(arr);
			// alert(JSON.stringify(content));//打印json数组
			var labels="username,myname";
			$.each(content,function(index,item){
				if(labels.indexOf(item['name'])!=-1){
					if($.trim(item['value'])==""){
						_validate=false;
						admin.showmsg(item['name']);
						$('#save_admin').linkbutton('enable');
						return false;
					}
				}
			})
			if(_validate){
				$.post('index.php/admin/save_admin_data',content,function(result){
					$('#save_admin').linkbutton('enable');
					$('#fom').form('reset');
					if(result.success){
						$('#admin_list').datagrid('reload');
						$.messager.show({
							title:'提示',
							msg:'添加管理员成功'
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
		admin.showmsg=function(msg){
			var content=$('#fom p').find('label[for="'+msg+'"]').text().replace(":","");
			$.messager.show({
				title:'提示',
				msg:'您还问输入'+'【'+content+'】',
			})
		}
		$(function(){
			admin.init();
		})