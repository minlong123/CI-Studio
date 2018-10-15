<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Homepage extends CI_Model{
		public function __construct(){
			parent::__construct();

		}


		public function get_studentdata(){
			$this->db->select('student_name,student_initials,student_id');
			$query=$this->db->get('student');
			return $query->result_array();
		}

		// 遍历获取到的学生id一个一个查询学生信息，插入另一张表当中，同时各扣一分的剩余课时。
		public function today_course(){
			date_default_timezone_set('PRC');
			// 接收post数据，并将字符串转换成数组
			$ids=$this->input->post('sgin_id');
			$timeslot=$this->input->post('timeslot');
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
				return true;
			}else{
				return false;
			}

		}
		public function get_today(){
			$goed=$this->input->post('go_toclass');

			// sql语句：select uid from todaycourse where course_data='2018-3-2' 
			// 换成ci语句
			$this->db->select('uid');
			$this->db->where('course_data',$goed);
			$query=$this->db->get('todaycourse');
			$result=$query->result_array();
			return $result;
		}

		public function get_teacher(){
			$this->db->select('teacher_name,tercher_id');
			$query=$this->db->get('teacher');
			$result=$query->result_array();
			return $result;
		}


		public function teacher_now_sign(){
			date_default_timezone_set('PRC');
			$uid=$this->input->post('id');
			$timeslot=$this->input->post('timeslot');
			if($uid!=""){
				$uidd=explode(",",$uid);
				foreach($uidd as $id){
					$this->db->select('teacher_name');
					$this->db->where('tercher_id',$id);
					$query=$this->db->get('teacher');

					$result=$query->result_array();
					foreach($result as $k=>$v){
						$data=array(
							'uid'=>$id,
							'teacher_name'=>$v['teacher_name'],
							'teacher_sign_data'=>date('Y-m-d'),
							'timeslot'=>$timeslot,
						);
						$this->db->insert('teachersign',$data);
					}
				}
			return true;
			}else{
				return false;
			}
		}

		public function get_today_teache(){
			$date=$this->input->post('now');
			$this->db->select('uid');
			$this->db->where('teacher_sign_data',$date);
			$query=$this->db->get('teachersign');
			return $query->result_array();
		}

		public function get_student(){
			$initials=$this->input->post('id');
			// $this->db->select('student_name,student_initials,student_rest');
			$this->db->or_like('student_name',$initials);
			$this->db->or_like('student_initials',$initials);
			$query=$this->db->get('student');
			return $query->result_array();

		}

		public function get_all_cours(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;

			$uid=intval($this->input->post('uid'));
			$this->db->select('course_data,timeslot,course_content');
			$this->db->limit($offset,$rows);
			$this->db->where('uid',$uid);
			$query=$this->db->get('todaycourse');
			$result=$query->result_array();
			$count=$query->num_rows();
			return array('total'=>$count,'rows'=>$result);
		}


		// 获取当天签到上课的学生信息
		public function get_all_date(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$date=$this->input->post('sign_data');
			$this->db->where('course_data',$date);
			$this->db->limit($rows,$offset);
			$query=$this->db->get('todaycourse');
			$result=$query->result_array();
			$count=$query->num_rows();
			return array('total'=>$count,'rows'=>$result);
		}

		public function get_norest_num(){
			$this->db->where('student_rest <',5);
			$query=$this->db->get('student');
			return $query->num_rows();
		}


		// 获取学生剩余课时不足5个的所有学生信息
	    public function	get_norest_data(){
	    	$this->db->select('student_name,parento,phoneo,student_rest,integral');
			$this->db->where('student_rest <',5);
			$query=$this->db->get('student');
			return $query->result_array();
		}


// <!-- select id,uid,course_data,course_content from todaycourse where uid=3 and id<(select id from todaycourse where uid=3 and course_data='2018-03-05') order by id desc limit 1 -->

 		public function get_student_detail(){
 			$uid=intval($this->input->post('uid'));
 			$date=$this->input->post('current_date');

 			$this->db->where('student_id',$uid);
 			$query=$this->db->get('student');
 			$res=$query->result_array();

 			// 判断当用户搜索信息的时候，因为前面js多个语句中调用了这段代码，每次调用，传了日期，有的没有传日期，如果日期不存在的话，应该怎么做，存在的话又怎么做
 			if(!empty($date)){
				$quer=$this->db->query("select course_data,course_content from todaycourse where uid=$uid and id<(select id from todaycourse where uid=$uid and course_data='".$date."') order by id desc limit 1");
 			}else if(empty($date)){
 				$quer=$this->db->query("select course_data,course_content from todaycourse where id=(select id from todaycourse where uid=$uid order by id desc limit 1)");
 			}
 			$res1=$quer->result_array();
 			// $result=array_merge($res,$res1);
 			// 避免没有上一次的课程时间和课程内容，而错误的进行了赋值。所以这里加了判断。
 			if(!empty($res1)){
	 			$res[0]['course_data']=$res1[0]['course_data'];
	 			$res[0]['course_content']=$res1[0]['course_content'];
 			}
 			return $res;
 		}

 //每天只能签到一次，所以各个学生的uid每天只能出现一次。因为该表当中每次签到的uid相同，只用一个uid条件进行更新的话，会同时把前面所有签到的内容都会进行修改。所以更新的时候还需要加一个条件，判断只更新是uid的，并且是当天的日期的才进行更新。过去的日期就不会被错误更新了。
 		public function save_course(){
 			$id=intval($this->input->post('uid'));
 			$date=$this->input->post("course_data");
 			$data=array(
 				"timeslot"=>$this->input->post("timeslot"),
 				"address"=>$this->input->post("address"),
 				"course_content"=>$this->input->post("course_content")
 			);
 			$this->db->where('uid',$id);
 			$this->db->where('course_data',$date);
 			return $this->db->update('todaycourse',$data);
 		}

 		// public function get_last_coursedate(){
 		// 	$uid=intval($this->input->post('curren_id'));
 		// 	$date=$this->input->post('current_date');
 		// 	$query=$this->db->query("select course_data,course_content from todaycourse where uid=$uid and id<(select id from todaycourse where uid=$uid and course_data='".$date."') order by id desc limit 1");
 		// 	return $query->result_array();
 		// }
	}

?>
