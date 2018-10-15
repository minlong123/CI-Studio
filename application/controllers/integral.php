<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Integral extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('integra');
			$this->load->model('coursee');
			$this->load->model('giff');
			$this->anquan();

		}

		public function index(){
			$data['title']='积分—123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/integral");
			$this->load->view("admin/footer");
		}
		public function get_student_data(){
			$result=$this->integra->get_student();
			$count=$this->integra->get_student_count();
			echo json_encode(array('total'=>$count,'rows'=>$result));
		}

		// 今日上课的会显示出来
		public function get_sign_student(){
			$result=$this->integra->get_now_student();
			echo json_encode($result);
		}

		public function sava_data(){
			$result=$this->integra->save_love();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function get_integral_details(){
			$result=$this->integra->get_details_data();
			$count=$this->integra->get_details_count();
			echo json_encode(array('total'=>$count,'rows'=>$result));
		}

		public function search_student_data(){
			$result=$this->coursee->search_student();
			echo json_encode($result);
		}

		// 获取所有礼物信息
		public function get_gif_data(){
			$result=$this->giff->get_gif();
			echo json_encode($result);
		}

		public function add_exchange_details(){
			$result=$this->integra->insert_exchange_details();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function get_exchange_details(){
			$result=$this->integra->get_exchange_data();
			echo json_encode($result);
		}

		public function exit_gif_action(){
			$result=$this->integra->exit_integral();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		// 下面的方法仅供测试时使用
		// public function test_s(){
		// 	$result=$this->integra->test();
		// 	echo $result;
		// }
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}

}