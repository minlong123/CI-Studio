<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->anquan();
			
		}
		public function index(){
			if($this->session->userdata('username')){
				$this->session->unset_userdata('username');
				redirect('login/');
			}	
		}
		public function anquan(){
			if(!$this->session->userdata('username')){
				redirect('login/');
			}
		}

}