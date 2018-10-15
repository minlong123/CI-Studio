<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('teache');
			$this->anquan();

		}

		public function index(){
			$data['title']='教师—123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/teacher");
			$this->load->view("admin/footer");
		}

		public function sava_teacher(){
			$result=$this->teache->insert_teacher();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occoured'));
			}
		}

		public function get_teacherdata(){
			$result=$this->teache->get_teacher();
			$count=$this->teache->get_teacher_count();
			echo json_encode(array('total'=>$count,'rows'=>$result));
		}

		public function edit_teacher(){
			$result=$this->teache->save_edit_teacher();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function destroy_teacher(){
			$result=$this->teache->delete_teacher();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function show_teacher_sign(){
			$result=$this->teache->show_teacher();
			echo json_encode($result);
		}
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}
}