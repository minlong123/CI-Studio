<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('studen');
			$this->anquan();
		}
	public function index(){
		$data['title']='学生—123画室管理系统';
		$this->load->view("admin/header",$data);
		$this->load->view("admin/student");
		$this->load->view("admin/footer");
	}
	public function get_studentdata(){
		$student_data=$this->studen->get_studentdata();
		$student_count=$this->studen->get_stucount();
		echo json_encode(array('total'=>$student_count,'rows'=>$student_data));
	}

	public function get_search(){
		$student_data=$this->studen->get_searchstudent();
		$student_count=$this->studen->get_stucount();
		echo json_encode(array('total'=>$student_count,'rows'=>$student_data));
	}
	public function save_student(){
		$result=$this->studen->sava_studen();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Some Errors Occured'));
		}
	}

	public function add_hour(){
		$result=$this->studen->save_hour();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Some Errors Occured'));
		}
	}
	public function edit_studentdata(){
		$result=$this->studen->edit_student();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('Errors'=>'Some Errors Occured'));
		}
	}

	public function destroy_data(){
		$result=$this->studen->delete_student();
		if($result){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('Errors'=>'删除失败'));
		}

	}
	public function show_renewdata(){
		$result=$this->studen->get_renewdate();
		echo json_encode($result);
	}
	public function get_sexcount(){
		$result=$this->studen->get_sexnan();
		$result1=$this->studen->get_sexnv();
		echo json_encode(array('man'=>$result,'woman'=>$result1));
	}

	public function get_hours(){
		$class_hours=$this->studen->classhours();
		echo json_encode($class_hours);
	}
	public function get_renew_student(){
		$renew_num=$this->studen->get_num();
		echo json_encode($renew_num);
	}
	public function anquan(){
		if(!$this->session->userdata('username')){
			redirect('login/');
		}
	}

}
