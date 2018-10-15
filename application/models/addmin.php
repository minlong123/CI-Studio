<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Addmin extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function get_user_data(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$this->db->limit($rows,$offset);
			$query=$this->db->get('admin');
			return $query->result_array();
		}

		public function get_admin_count(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$this->db->limit($rows,$offset);
			$query=$this->db->get('admin');
			return $query->num_rows();
		}

		public function delete_user(){
			$id=intval($this->input->post('id'));
			$this->db->where('id',$id);
			return $this->db->delete('admin');
		}
		public function add_user(){
			$data=array(
				"username"=>$this->input->post('username'),
				"admin_pass"=>MD5("123456"),
				"myname"=>$this->input->post('myname'),
				"admin_type"=>$this->input->post('admin_type'),
				"myphone"=>$this->input->post('myphone'),
				"admin_remarks"=>$this->input->post('admin_remarks'),
			);
			return $this->db->insert('admin',$data);
		}

		// 更新密码
		public function edit_user_pw(){
			$pass=MD5($this->input->post('old_pw'));
			$pass1=MD5($this->input->post('new_pw_validate'));
			$login_user=$this->session->userdata('username');
			
			$this->db->where('admin_pass',$pass);
			$query=$this->db->get('admin');
			$res=$query->num_rows();
			
			if($res>0){
				$this->db->where('username',$login_user);
				$this->db->set('admin_pass',$pass1,'FALSE');
				$result=$this->db->update('admin');
				return $result;
			}else{
				return false;
			}
		}
	}

?>

