	var fecharts={};
	// 全年收支汇总的饼状图
	fecharts.year_money={
            // echarts_data.student_sex相当于option.这里的option变成了对象的属性,后面可以随时调用它
                title : {
                    text: '全年收支汇总',
                    subtext: '',
                    x:'center'
                },
                tooltip : {
                    // tooltip表示hover气泡显示数据
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                    // 饼图: a（系列名称），b（数据项名称），c（数值）, d（饼图：百分比 | 雷达图：指标名称）
                },
                legend: {
                    // legend是图例的意思
                    orient : 'vertical',
                    // orient有两个值，除了这个还有一个horizontal.表示布局方式是垂直还是水平

                    x : 'left',
                    // x表示水平安放位置，默认center
                    data:['今年收入','今年支出']
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false}, //显示为数据视图
                        // readOnly的值为boolean,true时为只读，false启用数据视图编辑
                        magicType : {
                            // 显示类型为饼状图
                            show: true, 
                            type:'pie',
                        },
                        restore : {show: true}, //还原
                        saveAsImage : {show: true} //保存为图片
                    }
                },
                calculable : true,
                series : [
                // series是系列的意思
                    {
                        name:'全年收支汇总',
                        type:'pie',
                        // 类型为饼状图

                        radius : '55%',
                        // 半径

                        center: ['50%', '60%'],
                        // 圆心坐标
                        data:[]
                    }
                ]
	}
	fecharts.every_one_month={
			    title : {
			        text: '全年收支数据',
			    },
			    tooltip : {
			    // 气泡提示框，常用语展现更详细的数据
			        trigger: 'axis'
			        // 有两个值，还有个item，默认item数据触发，这里设置的是轴触发。
			    },
			    legend: {
			    // legend表示数据和图形的关联
			        data:['收入','支出']
			    },
			    toolbox: {
			    	// 添加右上角工具箱
			        show : true,
			        feature : {
			            mark : {show: true},
			            dataView : {show: true, readOnly: false}, //数据视图
			            magicType : {show: true, type: ['line', 'bar']},//折线图和柱状图切换
			            restore : {show: true},//恢复、还原
			            saveAsImage : {show: true} //设置下载保存图片到本地
			        }
			    },
			    calculable : true,
			    // 是否启用拖拽重计算特性，默认关闭
			    xAxis : [
			        {
			            type : 'category',
			            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
			        }
			    ],
			    yAxis : [
			        {
			            type : 'value'
			        }
			    ],
			    series : [
			        {
			            name:'收入',
			            type:'bar',
			            data:[],
			            markPoint : {
			                data : [
			                    {type : 'max', name: '最大值'},
			                    {type : 'min', name: '最小值'}
			                    // 最高和最低的数据会显示在气泡中
			                ]
			            },
			            
			        },
			   {
			            name:'支出',
			            type:'bar',
			            data:[],
			            markPoint : {
			                data : [
			                    {type : 'max', name: '年最高'},
			                    {type : 'min', name: '年最低'}
			                    // 最高和最低的数据会显示在气泡中
			                ]
			            },
			        }
			    ]   
	}
	$(function(){
		var myCharts=echarts.init(document.getElementById('year_sum'));
		var myCharts1=echarts.init(document.getElementById('month_money_details'));
		$.post('index.php/finance/get_year_data',function(result){
               fecharts.year_money["series"][0]["data"]=[
                    {value:result.income ,name:'今年收入'},
                    {value:result.expend ,name:'今年支出'}
               ];
			myCharts.setOption(fecharts.year_money);
		},'json');


		$.post('index.php/finance/get_month_data',function(result){
			fecharts.every_one_month["series"][0]["data"]=result['income'];
			fecharts.every_one_month["series"][1]["data"]=result['expend'];
			myCharts1.setOption(fecharts.every_one_month);
		},'json')
	})