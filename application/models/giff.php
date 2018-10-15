<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Giff extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		// 获取所有礼物
		public function get_gif(){
			$query=$this->db->get('gif');
			return $query->result_array();
		}

		// 新增礼物
		public function add_gif(){
			// date_default_timezone_set('PRC');
			$data=array(
				"gif_name"=>$this->input->post('gif_name'),
				"gif_sum"=>$this->input->post('gif_sum'),
				"gif_exchange_integral"=>$this->input->post('gif_exchange_integral'),
				"gif_price"=>$this->input->post('gif_price'),
				"gif_rest"=>$this->input->post('gif_sum')
			);
			return $this->db->insert('gif',$data);

		}

		// 修改礼物
		public function edit_gif_data(){
			$id=intval($this->input->post('id'));
			$data=array(
				"gif_name"=>$this->input->post('gif_name'),
				"gif_sum"=>$this->input->post('gif_sum'),
				"gif_exchange_integral"=>$this->input->post('gif_exchange_integral'),
				"gif_price"=>$this->input->post('gif_price'),
				"gif_rest"=>$this->input->post('gif_sum'),
			);
			$this->db->where('id',$id);
			return $this->db->update('gif',$data);
		}

		// 删除礼物
		public function delete_gif_data(){
			$id=intval($this->input->post('id'));
			$this->db->where('id',$id);
			return $this->db->delete('gif');
		}


		// 通过礼物的id查找兑换该礼物的所有记录
		public function get_gif_details(){
			$gif_id=intval($this->input->post('id'));
			$this->db->where('gif_id',$gif_id);
			$query=$this->db->get('exchange');
			return $query->result_array();
		}

		public function get_search_gif(){
			$gif_name=$this->input->post('name');
			$this->db->like('gif_name',$gif_name,'both');
			$query=$this->db->get('gif');
			return $query->result_array();
		}
	
	}

?>

