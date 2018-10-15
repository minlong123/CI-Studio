<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Test extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		// 遍历获取到的学生id一个一个查询学生信息，插入另一张表当中，同时各扣一分的剩余课时。
		public function today_course(){
			date_default_timezone_set('PRC');
			// 接收post数据，并将字符串转换成数组
			$ids="1,2";
			$timeslot="上午";
			if($ids!=""){
				$uidd=explode(",",$ids);
			// 遍历数组中的每一个学生id，进行查询student表、更新student表、插入todaycourse操作
				foreach($uidd as $v){
					$uid=intval($v);
					$this->db->select('student_name,student_rest,address');
					$this->db->where('student_id',$uid);
					$query=$this->db->get('student');
					$result=$query->result_array();
					foreach($result as $key=>$value){
						$result_restt=intval($value['student_rest'])-1;//剩余课时-1
						// 更新每个学生的剩余课时
						$data=array(
						  'student_rest'=>$result_restt,
						);
						$this->db->where('student_id',$uid);
						$this->db->update('student',$data);

					// 当天上课的学生及课程的信息插入新表当中
						$data1=array(
							'uid'=>$uid,
							'student_name'=>$value['student_name'],
							'timeslot'=>$timeslot,
							'student_rest'=>$result_restt,
							'course_data'=>date("Y-m-d"),
							'address'=>$value['address'],
						);
						$this->db->insert('todaycourse',$data1);

					}
				}
			}else{
				return false;
			}

		}
	}

?>