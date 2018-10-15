<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('homepage');
			$this->load->model('test');
			$this->anquan();

		}

		public function index(){
			$data['title']='首页—123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/home");
			$this->load->view("admin/footer");

		}

		public function student(){
			$result=$this->homepage->get_studentdata();
			echo json_encode($result);

		}
		public function sign(){
			$result=$this->homepage->today_course();
			if($result){
				echo json_encode(array('success'=>'true'));
			}else{
				echo json_encode(array('msg'=>'提交失败'));
			}
		}

		public function get_today_student(){
			$result=$this->homepage->get_today();
			if($result){
			echo json_encode($result);
			}else{
				echo false;
			}
		}

		public function get_teacherdata(){
			$result=$this->homepage->get_teacher();
			echo json_encode($result);
		}

		public function teacher_sign(){
			$result=$this->homepage->teacher_now_sign();
			if($result){
				echo json_encode(array('success'=>'true'));
			}else{
				echo json_encode(array('msg'=>'提交失败'));
			}
		}

		public function get_today_teacher(){
			$result=$this->homepage->get_today_teache();
			echo json_encode($result);

		}
		public function search_student_data(){
			$result=$this->homepage->get_student();
			echo json_encode($result);
		}
		public function show_all_course(){
			$result=$this->homepage->get_all_cours();
			echo json_encode($result);
		}
		public function get_student(){
			$result=$this->homepage->get_all_date();
			echo json_encode($result);
		}
		public function nostudent_rest(){
			$result=$this->homepage->get_norest_num();
			echo $result;
		}
		public function get_norest_student(){
			$result=$this->homepage->get_norest_data();
			echo json_encode($result);
		}

		public function get_student_details(){
			$result=$this->homepage->get_student_detail();
			echo json_encode($result);
			// print_r($result);
		}
		public function save_course_data(){
			$result=$this->homepage->save_course();
			if($result){
				echo json_encode(array('success'=>'true'));
			}else{
				echo json_encode(array('msg'=>'提交失败'));
			}
		}
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}
		// public function last_course_detailse(){
		// 	$result=$this->homepage->get_last_coursedate();
		// 	echo json_encode($result);
		// }
}