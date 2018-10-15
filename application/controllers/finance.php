<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finance extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('financ');
			$this->anquan();
		}

		public function index(){
			$data['title']='财务—123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/finance");
			$this->load->view("admin/footer");


		}
		public function get_finance_details(){
			$result=$this->financ->get_same_month();
			$count=$this->financ->get_same_count();
			echo json_encode(array('total'=>$count,'rows'=>$result));
		}

		public function save_record(){
			$result=$this->financ->add_finance_details();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}
		public function edit_record(){
			$result=$this->financ->edit_finance_details();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		// 获取今年总共支出多少，总共收入多少
		public function get_year_data(){
			$income=$this->financ->get_income();
			$expend=$this->financ->get_expend();
			echo json_encode(array('income'=>$income,'expend'=>$expend));
		}

		// 获取一年12个月每个月的收支记录
		public function get_month_data(){
			$income=$this->financ->get_income_details();
			$expend=$this->financ->get_expend_details();	
			echo json_encode(array('income'=>$income,'expend'=>$expend));
			// echo json_encode($income);
		}
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}
}