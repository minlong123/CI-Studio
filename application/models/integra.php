<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Integra extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function get_student(){
			$page=intval($this->input->post('page'));
			$rows=intval($this->input->post('rows'));
			$offset=($page-1)*$rows;
			$this->db->select('student_name,student_initials,integral,student_id');
			$this->db->limit($rows,$offset);
			$query=$this->db->get('student');
			return $query->result_array();
		
		}
		public function get_student_count(){
			return $this->db->count_all_results('student');
		}



		// 根据当天的时间查询当天有几个学生签到，然后获取这些学生的uid,然后在学生表中查询这些uid的信息，然后以数组的形式返回
		public function get_now_student(){
			$date=$this->input->post('date');
			$this->db->select('uid');
			$this->db->where('course_data',$date);
			$query=$this->db->get('todaycourse');
			$res=$query->result_array();
			$result=array();
			foreach($res as $k=>$v){
				$this->db->select('student_name,student_initials,integral,student_id');
				$this->db->where('student_id',$v['uid']);
				$query=$this->db->get('student');
				$res1=$query->result_array();
				array_push($result,$res1[0]);

			}
			return $result;

		}
		// 增加积分,首先要更新studetn表，同时上传至integra表
		public function save_love(){
			date_default_timezone_set('PRC');
			$uid=intval($this->input->post('student_id'));//学生表主键id
			$add=intval($this->input->post('integral_now')); //新增了多少的积分
			$integral=intval($this->input->post('integral')); //获取学生上一次的积分数量
			$sum=$integral+$add;
			// 更新至student表里的积分为新增后的积分
			$this->db->where('student_id',$uid);
			$this->db->set('integral',$sum,FALSE);
			$this->db->update('student');

			$data=array(
				"uid"=>$uid,
				"integral_add"=>$add,
				"integral_date"=>date('Y-m-d'),
				"integral_now"=>$sum,
				"integral_type"=>"奖励",				
			);
			$this->db->insert('integra',$data);

			// 更新前面所有增加次数内的积分为最新的总积分。
			$this->db->where('uid',$uid);
			$this->db->set('integral_now',$sum,FALSE);
			$result=$this->db->update('integra');
			return $result;
		}

		public function get_details_data(){
			$uid=intval($this->input->post('uid'));
			// $this->db->where('uid',$uid);
			// $query=$this->db->get('integra');
			// 重新克隆一个字段的内容。给前台使用
			$query=$this->db->query("SELECT *,integral_add as integral_clone FROM integra WHERE uid=$uid order by integral_date desc");
			return $query->result_array();
		}
		public function get_details_count(){
			$uid=intval($this->input->post('uid'));
			$query=$this->db->query("SELECT *,integral_add as integral_clone FROM integra WHERE uid=$uid");
			return $query->num_rows();
		}

		// 插入数据后，如果成功后，礼品的剩余数量减1，学生的积分减去兑换积分，然后更新到学生表、积分表。 
		public function insert_exchange_details(){
			date_default_timezone_set('PRC');
			$uid=intval($this->input->post('uid'));
			$gif_restt=intval($this->input->post('gif_rest'));
			$gif_id=intval($this->input->post('gif_id'));
			$exchange_name=$this->input->post('exchange_gif'); //兑换的礼物是什么
			$exchange_integral=intval($this->input->post('exchange_integral'));//兑换该礼物所需的积分
			$student_integral=intval($this->input->post('student_integral'));//学生的积分
			

			// 插入积分兑换礼品记录         成功
			$data=array(
				"uid"=>$uid,
				"gif_id"=>$gif_id,
				"exchange_name"=>$exchange_name,
				"exchange_person"=>$this->input->post('student_name'),
				"exchange_date"=>date('Y-m-d'),
				"exchange_integral"=>$exchange_integral,
			);
			$result=$this->db->insert('exchange',$data);
			$exchange_id=$this->db->insert_id();

			if($result){
				// 如果插入成功，则返回他插入的主键id
				// 剩余数量-1并更新gif表中的剩余数量。        成功
				$gif_rest=$gif_restt-1;
				$this->db->where('id',$gif_id);
				$this->db->set('gif_rest',$gif_rest,'FALSE');
				$this->db->update('gif');

			// 学生的积分减去兑换积分，然后更新student表中的积分      成功
				$now_integral=$student_integral-$exchange_integral;
				$this->db->where('student_id',$uid);
				$this->db->set('integral',$now_integral,'FALSE');
				$this->db->update('student');

			// 向integra表新插入一条积分变动记录。有学生id/积分变动了多少/操作日期/操作后的积分/操作类型为兑换/操作说明为兑换了什么礼物。        成功
				$dat=array(
					"uid"=>$uid,
					"integral_add"=>$exchange_integral,
					"integral_date"=>date('Y-m-d'),
					"integral_now"=>$now_integral,
					"integral_type"=>"兑换",
					"integral_explain"=>"兑换礼物"."【".$exchange_name."】",
					"exchange_id"=>$exchange_id,
				);
				$res=$this->db->insert('integra',$dat);
				// 如果插入数据成功后，继续更新表中该学生的所有积分        成功
				if($res){
					$this->db->where('uid',$uid);
					$this->db->set('integral_now',$now_integral,'FALSE');
					return $this->db->update('integra');

				}
			}

		}
		public function get_exchange_data(){
			$uid=intval($this->input->post('uid'));
			$this->db->where('uid',$uid);
			$query=$this->db->get('exchange');
			return $query->result_array();
		}

		// 一、需要的信息是获取兑换记录表中的主键id，然后根据这个主键去删除该条记录。
		// 二、获取兑换该礼物所需的积分、获取目前的积分然后相加，然后获取学生表的主键id、更新学生表中该学生的积分。通过获取exchange表中的主键id来删除integral表中的积分变动。并通过uid更新表中该学生每次变动的所有积分。
		// 三、获取礼物的该id,和礼物的剩余数量+1.更新到gif表中。
		public function exit_integral(){
			$exchange_id=$this->input->post('exchange_id');//该礼物在兑换表中的主键id
			$integral=$this->input->post('integral');//该学生目前的剩余积分
			$exchange_integral=$this->input->post('exchange_integral');//兑换该礼物所用的积分
			$uid=$this->input->post('uid');//该学生在学生表内的主键id
			$gif_id=intval($this->input->post('gif_id'));//获取礼物的id

			// 删除兑换表中该礼物的信息   成功
			$this->db->where('id',$exchange_id);
			$this->db->delete('exchange');

			// 更新student表里该学生的积分   成功
			$integral_now=$integral+$exchange_integral;//退回后的学生的积分
			$this->db->where('student_id',$uid);
			$this->db->set('integral',$integral_now,'FALSE');
			$this->db->update('student');

			// 根据兑换表里的主键id找到integra表中相应的积分变动记录，并删除      成功
			$this->db->where('exchange_id',$exchange_id);
			$this->db->delete('integra');

			// 根据uid更新integra表中该学生的所有积分记录     成功
			$this->db->where('uid',$uid);
			$this->db->set('integral_now',$integral_now,'FALSE');
			$this->db->update('integra');

			
			// 根据礼物的主键id找到该礼物的剩余数量并加1，并更新到该表中  成功
			// update gif set gif_rest=(select gif_rest from gif where id=9)+1,where id=9
			$this->db->select('gif_rest');
			$this->db->where('id',$gif_id);
			$query=$this->db->get('gif');
			$result=$query->result_array();
			$gif_restt=$result[0]['gif_rest'];
			$gif_rest=$gif_restt+1;

			// 更新gif表里的该礼品数量  成功
			$this->db->where('id',$gif_id);
			$this->db->set('gif_rest',$gif_rest,'FALSE');
			$this->db->update('gif');
			return true;
		}


		// 下面的方法仅供测试时使用
		// public function test(){
		// 	$this->db->select('gif_rest');
		// 	$this->db->where('id',9);
		// 	$query=$this->db->get('gif');
		// 	$result=$query->result_array();
		// 	return $result[0]['gif_rest'];
		// }
	}

?>

