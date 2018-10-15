<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('addmin');
			$this->anquan();
		}


		public function index(){
			$data['title']='管理员-123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/admm");
			$this->load->view("admin/footer");
			
		}
		public function get_admin_data(){
			$result=$this->addmin->get_user_data();
			$count=$this->addmin->get_admin_count();
			echo json_encode(array('total'=>$count,'rows'=>$result));
		}

		public function destroy_user(){
			$result=$this->addmin->delete_user();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function save_admin_data(){
			$result=$this->addmin->add_user();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}
		public function edit_pass(){
			$result=$this->addmin->edit_user_pw();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('success'=>false));
			}
		}

		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}

}