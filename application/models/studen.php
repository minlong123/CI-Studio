<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Studen extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function get_studentdata(){
			// $student_name=$this->input->post('search');
			// $student_initials=$this->input->post('student_initials');
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$this->db->limit($rows,$offset);
			$query=$this->db->get('student');
			$row=$query->result_array();
			return $row;

		}
		public function get_stucount(){
			// 返回结果集的总行数
			return $this->db->count_all_results('student');
		}

		public function get_searchstudent(){
			$_search=$this->input->post('search');
			$this->db->or_like('student_name',$_search);
			$this->db->or_like('student_initials',$_search);
			$query=$this->db->get('student');
			return $query->result_array();
		}

		public function sava_studen(){
			date_default_timezone_set("PRC");
			// 这里因为没有设置中国时区而报错
			$data=array(
				"student_name"=>$this->input->post('student_name'),
				"student_initials"=>$this->input->post('student_initials'),
				"student_age"=>intval($this->input->post('student_age')),
				"student_data"=>date("Y-m-d H:i:s"),// 这里因为没有设置中国时区而报错
				"student_rest"=>intval($this->input->post('student_rest')),
				"student_birthday"=>$this->input->post('student_birthday'),
				"parento"=>$this->input->post('parento'),
				"phoneo"=>$this->input->post('phoneo'),
				"sex"=>$this->input->post('sex'),
				"parentt"=>$this->input->post('parentt'),
				"phonet"=>$this->input->post('phonet'),
				"address"=>$this->input->post('address'),
				"classType"=>$this->input->post('classType'),
				"school"=>$this->input->post('school'),
				"integral"=>intval($this->input->post('integral')),
				"state"=>$this->input->post('state'),
				"remarks"=>$this->input->post('remarks'),
			);
			return $this->db->insert('student',$data);

		}

		// 重新报名和更新剩余课时
		public function save_hour(){
			date_default_timezone_set('PRC');
			$add_classhour=intval($this->input->post('add_classhour'));
			$student_id=intval($this->input->post('student_id'));

			$data=array(
				"student_name"=>$this->input->post('student_name'),
				"renew_date"=>$this->input->post('renew_date'),
				"add_classhour"=>$add_classhour,
				"remarks"=>$this->input->post('remarks'),
				"sid"=>$student_id,
			);


			$query=$this->db->select('student_rest')->where('student_id',$student_id)->get('student');
			$result=$query->result_array();
			$student_rest=$result[0]['student_rest'];
			$data1=array(
				"student_rest"=>$student_rest+$add_classhour,
			);
			$this->db->where('student_id',$student_id);
			$this->db->update('student',$data1);


			return $this->db->insert('renew',$data);

		}

		public function edit_student(){
			date_default_timezone_set("PRC");
			$student_id=$this->input->post('student_id');
			$data=array(
				"student_name"=>$this->input->post('student_name'),
				"student_initials"=>$this->input->post('student_initials'),
				"student_age"=>intval($this->input->post('student_age')),
				"student_data"=>date("Y-m-d H:i:s"),// 这里因为没有设置中国时区而报错
				"student_rest"=>intval($this->input->post('student_rest')),
				"student_birthday"=>$this->input->post('student_birthday'),
				"parento"=>$this->input->post('parento'),
				"phoneo"=>$this->input->post('phoneo'),
				"sex"=>$this->input->post('sex'),
				"parentt"=>$this->input->post('parentt'),
				"phonet"=>$this->input->post('phonet'),
				"address"=>$this->input->post('address'),
				"classType"=>$this->input->post('classType'),
				"school"=>$this->input->post('school'),
				"integral"=>intval($this->input->post('integral')),
				"state"=>$this->input->post('state'),
				"remarks"=>$this->input->post('remarks'),
			);
			$this->db->where('student_id',$student_id);
			$query=$this->db->update('student',$data);
			return $query;
		}

		public function delete_student(){
			$student_id=intval($this->input->post('id'));
			$this->db->where('student_id',$student_id);
			$result=$this->db->delete('student');
			return $result;
		}

		
		public function get_renewdate(){
			$uid=intval($this->input->post('uid'));
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));

			$offset=($page-1)*$rows;

			$this->db->where('sid',$uid);
			$this->db->limit($rows,$offset);
			$query=$this->db->get('renew');

			$result=$query->result_array();
			return $result;
		}

		// 获取学生为男生的人数
		public function get_sexnan(){
			$this->db->where('sex','男');
			$query=$this->db->count_all_results('student');
			return $query;
		}

		// 获取学生为女生的人数
		public function get_sexnv(){
			$this->db->where('sex','女');
			$query=$this->db->count_all_results('student');
			return $query;
		}

		//获取每个剩余课时以及每个剩余课时还有多少人正在进行
		public function classhours(){
			$res=array();
			$this->db->select('student_rest');
			$this->db->group_by('student_rest');
			$rs=$this->db->get('student');


			// $sql="select student_rest from student group by student_rest";
			// $rs=$this->db->query($sql);
			$result=$rs->result_array();
			$res1=array();
			$res2=array();
			foreach($result as $key=>$value){
				array_push($res1,$value['student_rest']);
				$this->db->where('student_rest',$value['student_rest']);
				$query=$this->db->count_all_results('student');
				array_push($res2,$query);
			}
			$res['classhours']=$res1;
			$res['personnum']=$res2;

			return $res;//返回一个二维数组，在contorller转化为json数据
			

		}

		public function get_num(){
			$res=array();
			$result=array();
			for($i=1;$i<=12;$i++){
				// SELECT * FROM `student` WHERE student_data like "2018-02%"
				if($i<10){
					$this->db->like('student_data','2018-0'.$i,'after');
					$re=$this->db->count_all_results('student');
					$this->db->like('renew_date','2018-0'.$i,'after');
					$re1=$this->db->count_all_results('renew');
					$re2=$re+$re1;
					array_push($result,$re2);
					
				}else{
					$this->db->like('student_data','2018-'.$i,'after');
					$re=$this->db->count_all_results('student');
					$this->db->like('renew_date','2018-'.$i,'after');
					$re1=$this->db->count_all_results('renew');
					$re2=$re+$re1;
					array_push($result,$re2);
					
				}
			}
			$res['renew_person']=$result;
			return $res;
		}

	}

?>
