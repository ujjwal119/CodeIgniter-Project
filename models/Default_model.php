<?php

	class Default_model extends CI_Model {
		public function __construct(){
			parent::__construct();
		}
		
		public function user_exists($user){
			$this->db->select('name,user_name,user_pwd');
			$this->db->from('travel_users');
			$this->db->where('user_name',$user);
			$query = $this->db->get();
			$user_data = $query->row_array();
			if($user_data){
				return $user_data;
			}else{
				return false;
			}
		}
	}
?>