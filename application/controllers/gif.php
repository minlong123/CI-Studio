<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gif extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('giff');
			$this->anquan();
		}

		public function index(){
			$data['title']='礼物—123画室管理系统';
			$this->load->view("admin/header",$data);
			$this->load->view("admin/gif");
			$this->load->view("admin/footer");
		}

		public function get_all_gif(){
			$result=$this->giff->get_gif();
			echo json_encode($result);
		}
		public function update_new_gif(){
			$result=$this->giff->add_gif();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function save_edit_gif(){
			$result=$this->giff->edit_gif_data();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function delete_gif(){
			$result=$this->giff->delete_gif_data();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'Some Errors Occured'));
			}
		}

		public function get_exchange_details(){
			$result=$this->giff->get_gif_details();
			echo json_encode($result);
		}

		public function get_search_data(){
			$result=$this->giff->get_search_gif();
			echo json_encode($result);
		}
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}

}