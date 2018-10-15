<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Financ extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function get_same_month(){
			$start=$this->input->post('start');
			$end=$this->input->post('end');
			$sql="select * from finance where finance_date between '".$start."' and '".$end."'";
			$query=$this->db->query($sql);
			return $query->result_array();
		}

		public function get_same_count(){
			$start=$this->input->post('start');
			$end=$this->input->post('end');
			$sql="select * from finance where finance_date between '".$start."' and '".$end."'";
			$query=$this->db->query($sql);
			return $query->num_rows();
		}

		public function add_finance_details(){
			date_default_timezone_set('PRC');
			$data=array(
				"finance_type"=>$this->input->post('finance_type'),
				"finance_money"=>$this->input->post('finance_money'),
				"finance_details"=>$this->input->post('finance_details'),
				"finance_date"=>$this->input->post('finance_date'),
				"finance_entering"=>date('Y-m-d H:i:s')
			);
			return $this->db->insert('finance',$data);
		}

		public function edit_finance_details(){
			$id=intval($this->input->post('id'));
			$data=array(
				"finance_type"=>$this->input->post('finance_type'),
				"finance_money"=>$this->input->post('finance_money'),
				"finance_details"=>$this->input->post('finance_details'),
				"finance_date"=>$this->input->post('finance_date'),
			);
			$this->db->where('id',$id);
			return $this->db->update('finance',$data);
		}

		// 获取今年总共收入多少
		public function get_income(){
			$this->db->where('finance_type',"收入");
			$this->db->select_sum('finance_money');
			$query=$this->db->get('finance');
			$result=$query->result_array();
			return intval($result[0]['finance_money']);
		}

		// 获取今年总共支出了多少
		public function get_expend(){
			$this->db->where('finance_type',"支出");
			$this->db->select_sum('finance_money');
			$query=$this->db->get('finance');
			$result=$query->result_array();
			return intval($result[0]['finance_money']);
		}
		// 获取每月收入多少
		// 要用每月的月份去查询该月所有的收入并求和。
		public function get_income_details(){
			date_default_timezone_set('PRC');
			$day=date('Y');
			$result=array();
			for($i=1;$i<=12;$i++){
				if($i<10){
					$i="0".$i;
				}
				$date=$day.'-'.$i;
				$this->db->where('finance_type','收入');
				$this->db->like('finance_date',$date,'FALSE');
				$this->db->select_sum('finance_money');
				$query=$this->db->get('finance');
				$res=$query->result_array();
				array_push($result,intval($res[0]['finance_money']));
			}
			return $result;

		}
		// 获取每月支出多少
		public function get_expend_details(){
			date_default_timezone_set('PRC');
			$day=date('Y');
			$result=array();
			for($i=1;$i<=12;$i++){
				if($i<10){
					$i="0".$i;
				}
				$date=$day.'-'.$i;
				$this->db->where('finance_type','支出');
				$this->db->like('finance_date',$date,'FALSE');
				$this->db->select_sum('finance_money');
				$query=$this->db->get('finance');
				$res=$query->result_array();
				array_push($result,intval($res[0]['finance_money']));
			}
			return $result;
		}

	}

?>

