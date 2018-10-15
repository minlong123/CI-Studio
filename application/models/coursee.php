<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Coursee extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		// 学员列表数据
		public function get_student(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			// $this->db->select('student_name,student_rest');
			$this->db->limit($rows,$offset);
			$query=$this->db->get('student');
			$result=$query->result_array();
			return $result;
	
		}

		// 学员列表数据数量
		public function get_student_count(){
			return $this->db->count_all_results('student');
		}

		// 课时列表数据
		public function get_all_hour(){
			$uid=intval($this->input->post('uid'));
			$this->db->where('uid',$uid);
			$query=$this->db->get('todaycourse');
			return $query->result_array();
		}

		public function get_count(){
			$uid=intval($this->input->post('uid'));
			$this->db->where('uid',$uid);
			$query=$this->db->get('todaycourse');
			return $query->num_rows();
		}



		// 新增课时表，插入数据库，各表中剩余课时-1
		public function insert_student(){
			$student_rest=intval($this->input->post('student_rest'))-1;
			$uid=$this->input->post('student_id');
			$this->db->where('student_id',$uid);
			$this->db->set('student_rest',$student_rest,FALSE);
			$this->db->update('student');

			$data=array(
				"student_name"=>$this->input->post('student_name'),
				"course_data"=>$this->input->post('course_data'),
				"timeslot"=>$this->input->post('timeslot'),
				"address"=>$this->input->post('address'),
				"course_content"=>$this->input->post('course_content'),
				"uid"=>$uid,
				"student_rest"=>$student_rest,
				// "student_integral"=>$this->input->post('integral')
			);
			return $this->db->insert('todaycourse',$data);
		}

		public function update_student(){
			$id=intval($this->input->post('id'));
			$data=array(
				"student_name"=>$this->input->post('student_name'),
				"course_data"=>$this->input->post('course_data'),
				"timeslot"=>$this->input->post('timeslot'),
				"address"=>$this->input->post('address'),
				"course_content"=>$this->input->post('course_content')
			);

			$this->db->where('id',$id);
			return $this->db->update('todaycourse',$data);
		}

		public function search_student(){
			$data=$this->input->post('content');
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;

			$this->db->or_like('student_name',$data);
			$this->db->or_like('student_initials',$data);
			$this->db->limit($rows,$offset);
			$query=$this->db->get('student');
			$result=$query->result_array();
			$count=$query->num_rows();
			return array('total'=>$count,'rows'=>$result);
		}

	}

?>

