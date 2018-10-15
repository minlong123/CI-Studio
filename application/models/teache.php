<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Teache extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function insert_teacher(){
			date_default_timezone_set('PRC');
			$data=array(
				'teacher_name'=>$this->input->post('teacher_name'),
				'teacher_age'=>$this->input->post('teacher_age'),
				'teacher_phone'=>$this->input->post('teacher_phone'),
				'teacher_address'=>$this->input->post('teacher_address'),
				'teacher_entry'=>$this->input->post('teacher_entry'),
				'teacher_state'=>$this->input->post('teacher_state'),
				'teacher_remarks'=>$this->input->post('teacher_remarks')
			);
			return $this->db->insert('teacher',$data);

		}

		public function get_teacher(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$this->db->limit($rows,$offset);
			$query=$this->db->get('teacher');
			return $query->result_array();

		}
		public function get_teacher_count(){
			return $this->db->count_all_results('teacher');
		}


		public function save_edit_teacher(){
			date_default_timezone_set('PRC');
			$id=intval($this->input->post('tercher_id'));
			$data=array(
				'teacher_name'=>$this->input->post('teacher_name'),
				'teacher_age'=>$this->input->post('teacher_age'),
				'teacher_phone'=>$this->input->post('teacher_phone'),
				'teacher_address'=>$this->input->post('teacher_address'),
				'teacher_entry'=>$this->input->post('teacher_entry'),
				'teacher_state'=>$this->input->post('teacher_state'),
				'teacher_remarks'=>$this->input->post('teacher_remarks')
			);
			$this->db->where('tercher_id',$id);
			return $this->db->update('teacher',$data);
		}

		public function delete_teacher(){
			$data=array(
				'tercher_id'=>$this->input->post('tercher_id'),
			);
			return $this->db->delete('teacher',$data);
		}

		// 查询结果和结果的总数，并进行分页，返回一个数组
		public function show_teacher(){
			$rows=$this->input->post('rows');
			$page=$this->input->post('page');
			$offset=($page-1)*$rows;

			$uid=$this->input->post('uid');
			$this->db->where('uid',$uid);
			$this->db->limit($rows,$offset);
			$query=$this->db->get('teachersign');
			$result=$query->result_array();
			$count=$query->num_rows();
			return array('total'=>$count,'rows'=>$result);
		}

	}

?>

