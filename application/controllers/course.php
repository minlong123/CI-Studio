<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('coursee');
			$this->anquan();
		}

	public function index(){
		$data['title']='课程—123画室管理系统';
		$this->load->view("admin/header",$data);
		$this->load->view("admin/course");
		$this->load->view("admin/footer");
	}


	public function get_all_student(){
		$result=$this->coursee->get_student();
		$count=$this->coursee->get_student_count();
		echo json_encode(array('total'=>$count,'rows'=>$result));
		// 这里遇到一个问题，把total和rows的赋值写到这儿,分页就正常了，但是写在model里就不正常了
	}

	public function get_course_hour(){
		$result=$this->coursee->get_all_hour();
		$count=$this->coursee->get_count();
		echo json_encode(array('total'=>$count,'rows'=>$result));
	}

	public function insert_student_course(){
		$result=$this->coursee->insert_student();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Some Errors Occured'));
		}
	}

	public function edit_student_date(){
		$result=$this->coursee->update_student();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Some Errors Occured'));
		}
	}

	public function search_student_data(){
		$result=$this->coursee->search_student();
		echo json_encode($result);
	}
	public function anquan(){
		if(!$this->session->userdata('username')){
			redirect('login/');
		}
	}

}