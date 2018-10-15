<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->model('user');
		
		}
		public function index(){
			$this->load->view("login");
			
		}
		public function validate_data(){
			$result=$this->user->validate_user();
			if($result){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('success'=>false));
			}
		}

}