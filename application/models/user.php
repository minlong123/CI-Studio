<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function validate_user(){
			$username=$this->input->post('username');
			$password=md5($this->input->post('password'));
			$this->db->where('username',$username);
			$this->db->where('admin_pass',$password);
			$query=$this->db->get('admin');
			$result=$query->num_rows();
			if($result>0){
				$this->session->set_userdata('username',$username);
				return true;
			}else{
				return false;
			}
		}

	

	}

?>

