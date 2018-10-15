    var echarts_data={};
        // 上课的男女比例
        echarts_data.student_sex={
            // echarts_data.student_sex相当于option.这里的option变成了对象的属性,后面可以随时调用它
                title : {
                    text: '男女比例',
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
                    data:['男','女']
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
                        name:'男女比例',
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

        // 剩余课时统计
        echarts_data.student_hour={
            title : {
                text: '剩余课时统计',
                subtext: ''
            },
            tooltip : {
            	show:true,
                trigger: 'axis',
                formatter: "{b}剩余课时 <br> {a} : {c}"
            },
            legend: {
                // data:['最多人数','最少人数']
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false}, //数据视图可以编辑。
                    magicType : {show: true, type: ['line', 'bar']},//可切换折线图和柱状图
                    restore : {show: true}, //还原
                    saveAsImage : {show: true} //保存视图
                }
            },
            calculable : true,
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : [],
                    axisLabel:{
                    	formatter:'{value} 剩余课时'
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    axisLabel : {
                        formatter: '{value} 人'
                    }
                }
            ],
            series : [
                {
                    name:'人数',
                    type:'line',
                    data:[],
                    markPoint : {
                        data : [
                            {type : 'max', name: '最大值'},
                            {type : 'min', name: '最小值'}
                        ]
                    },
                    markLine : {
                        data : [
                            {type : 'average', name: '平均值'}
                        ]
                    }
                }
            ]

        }

        // 每月新报名的人数
        echarts_data.student_renewdata={
                title : {
                    text: '2018年按月报名数据',
                    subtext: ''
                },
                tooltip : {
                // 气泡提示框，常用语展现更详细的数据
                    trigger: 'axis'
                    // 有两个值，还有个item，默认item数据触发，这里设置的是轴触发。
                },
                legend: {
                // legend表示数据和图形的关联
                    // data:'报名人数'
                },
                toolbox: {
                    // 添加右上角工具箱
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false}, //数据视图
                        magicType : {show: true, type: ['bar','line']},//折线图和柱状图切换
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
                        name:'报名人数',
                        type:'bar',
                        data:[],
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                                // 最高和最低的数据会显示在气泡中
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: '平均值'}
                                // 求平均值并显示一条直线在图表上
                            ]
                        }
                    }
                ]
        }

         // 使用刚指定的配置项和数据显示图表。
         $(function(){
            var myChart=echarts.init(document.getElementById("ratio"));
            var myChart1=echarts.init(document.getElementById('ratio_two'));
            var myChart2=echarts.init(document.getElementById('ratio_three'));
            $.post('index.php/student/get_sexcount',function(result){
                echarts_data.student_sex["series"][0]["data"]=[
                    {value:result.man ,name:'男'},
                    {value:result.woman ,name:'女'}
                ];
                myChart.setOption(echarts_data.student_sex);
            },'json');

            // x坐标内容和y轴坐标内容由数据库获取，已有的课时，每个剩余课时都有多少人
            // 思路：用group by获取所有不相同的课时，然后通过遍历出来的课时查询表中有多少人。

            // 返回的数据：{"classhours":["0","5","10","40"],"personnum":[3,8,1,1]}
            $.post('index.php/student/get_hours',function(result){
            	echarts_data.student_hour['xAxis'][0]["data"]=result["classhours"];
            	echarts_data.student_hour['series'][0]["data"]=result['personnum'];
            	myChart1.setOption(echarts_data.student_hour);
            },'json');


            // 知道12个月,循环12次，用每月的条件去查询数据库表里有多少条。如果没有则为0。
            // 因为刚报名和新报名是两张表，所以需要同时查两张表。查询的前提条件是刚报名和新报名的时间不会在同一个月内。一个人每月不能报名两次。
            // 因为数据库里的月份都是2018-00-00格式。所以需要用like方法，比如"2018-01%"去查询该月有多少条记录
            $.post('index.php/student/get_renew_student',function(result){
            	echarts_data.student_renewdata['series'][0]["data"]=result['renew_person'];
            	myChart2.setOption(echarts_data.student_renewdata);
            },'json');

         })
         
