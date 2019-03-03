<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function __construct()
	{
		$this->load->database();	
	}

	public function find($table, $where = '', $order_by = '', $order_type = '', $join = '', $id = '', $join2 = '', $id2 = '', $join3 = '', $id3 = '', $params = array(), $search = '') {
		
		if ($order_by != '') {
			if ($order_type != '') {
				$this->db->order_by( $order_by, $order_type);
			} else {
				$this->db->order_by($order_by, 'ASC');
			}
		}
		if ($join != '') {
			$this->db->join($join, $id, 'left');
			if ($join2 != '') {
				$this->db->join($join2, $id2, 'left');
				if ($join3 != '') {
					$this->db->join($join3, $id3, 'left');
				}
			}
		}

		if(!empty($params['search']['keywords'])){
			$this->db->like($search ,$params['search']['keywords']);
		}
        //sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by($search ,$params['search']['sortBy']);
		}else{
			$this->db->order_by($order_by,'desc');
		}

		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		} elseif (!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}


		if ($where != '') {
			$query = $this->db->get_where($table, $where);
		} else {
			$query = $this->db->get($table);
		}
		return ($query->num_rows() > 0)?$query:FALSE;
	}

	function save($data,$table){
		$this->db->insert($table, $data);
	}

	function update($field, $value, $table, $data)
	{
		return $this->db->where($field, $value)->update($table, $data);
	}

	function delete($where,$table){
		$this->db->where($where);
		if ($this->db->delete($table)) {
			return true;
		}
	}

	public function getUserInfo($id)  
	{  
		$q = $this->db->get_where('mahasiswa', array('nim' => $id), 1);   
		if($this->db->affected_rows() > 0){  
			$row = $q->row();  
			return $row;  
		}else{  
			error_log('no user found getUserInfo('.$id.')');  
			return false;  
		}  
	}  

	public function getUserInfoByEmail($table, $email){  
		$q = $this->db->get_where($table, $email, 1);   
		if($this->db->affected_rows() > 0){  
			$row = $q->row();  
			return $row;  
		}  
	}  

	public function insertToken($user_id)  
	{    
		$token = substr(sha1(rand()), 0, 30);   
		$date = date('Y-m-d');  

		$string = array(  
			'token'=> $token,  
			'user_id'=>$user_id,  
			'created'=>$date  
		);  
		$query = $this->db->insert_string('tokens',$string);  
		$this->db->query($query);  
		return $token . $user_id;  

	}  

	public function isTokenValid($token)  
	{  
		$tkn = substr($token,0,30);  
		$uid = substr($token,30);     

		$q = $this->db->get_where('tokens', array(  
			'tokens.token' => $tkn,   
			'tokens.user_id' => $uid), 1);               

		if($this->db->affected_rows() > 0){  
			$row = $q->row();         

			$created = $row->created;  
			$createdTS = strtotime($created);  
			$today = date('Y-m-d');   
			$todayTS = strtotime($today);  

			if($createdTS != $todayTS){  
				return false;  
			}  

			$user_info = $this->getUserInfo($row->user_id);  
			return $user_info;  

		}else{  
			return false;  
		}  

	}

	public function ambil()
	{
		$query = $this->db->get('ide_skripsi')->result_array();
		return $query;
	}
}