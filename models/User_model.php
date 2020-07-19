<?php

	class User_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			// $this->output->enable_profiler(TRUE);
		}
		
		public function city()
		{
			$query = $this->db->get('nav_city');
			$city_list = $query->result_array();
			return $city_list;
		}

		public function site_engineer()
		{
			$query = $this->db->get('nav_site_engineers');
			$engineer_list = $query->result_array();
			return $engineer_list;
		}


		public function machines()
		{
			$query = $this->db->get('nav_machines');
			$machine = $query->result_array();
			return $machine;
		}

		public function equi_model()
		{
			$this->db->order_by('model','asc');
			$query = $this->db->get('nav_equi_model');
			$equi_model = $query->result_array();
			return $equi_model;
		}


		public function form_data($data1)
		{
			if($this->db->insert('nav_ir',$data1))
			{
				return true;
			}  
		}

		public function form_service($data2,$num_rows,$pno)
		{
			for($i=1; $i <= $num_rows; $i++)
			{
				$num_count = count($data2['services'][$i]);
				for($j=0; $j < $num_count; $j++)
			 	{
					$services_to_insert[] = array('project_no' => $pno+1,'m_no' => $i, 'services' => $data2['services'][$i][$j], 'complete_date' => $data2['complete_date'][$i][$j], 'start_date' =>$data2['start_date'][$i][$j]);
				}
			}
			// print_r($services_to_insert);
			if($this->db->insert_batch('nav_services',$services_to_insert))
			{
				return true;
			}
		}

		public function form_equipments($data3,$num_equipment)
		{ 
			for($i=0; $i < $num_equipment; $i++)
			{
				if(isset($data3['diagram_ref'][$i]) && !empty($data3['diagram_ref'][$i]))
		        {
					$equipments_to_insert[] = array('p_no' => $data3['p_no'], 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i],'equi_desc' =>$data3['equi_desc'][$i+1][0]);
				}
				else
				{
					$equipments_to_insert[] = array('p_no' => $data3['p_no'], 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>"",'create_date' =>$data3['create_date'][$i],'equi_desc' =>$data3['equi_desc'][$i+1][0]);
				}
				if(isset($data3['equi_desc'][$i+1][0]) && !empty($data3['equi_desc'][$i+1][0]))
				{
					$model_to_insert[] = array('model' => $data3['equi_desc'][$i+1][0]);
				}
			}
			// print_r($equipments_to_insert);
			if($this->db->insert_batch('nav_services_provide',$equipments_to_insert))
			{
				if(isset($model_to_insert) && !empty($model_to_insert))
				{
					$this->db->insert_batch('nav_equi_model',$model_to_insert);
				}
				return true; 
			}  
				
		}

		public function get_data($usr_name)
		{	
			$start_date = date("Y-m-d", time()-360*24*3600);
			$end_date 	= date("Y-m-d");
			$this->db->where('completion_date >=',$start_date);
			$this->db->where('completion_date <=',$end_date);
			if($usr_name !='Priyanka' &&  $usr_name !='Vikas Kumar' && $usr_name !='Ujjwal' ) 
			{
				$this->db->like('eurus_engineer',$usr_name);
			}
			$this->db->order_by('id','desc');
			$query = $this->db->get('nav_ir');
			$data = $query->result_array();
			return $data;
		}

		public function last_project_id()
		{
			$this->db->select('id');
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$query = $this->db->get('nav_ir');
			$data_id = $query->row_array();
			return $data_id;
		}

		public function get_ir_data($id)
		{
			$this->db->where('id',$id);
			$query = $this->db->get('nav_ir');
			$data = $query->row_array();
			return $data;
		}

		public function get_services($id)
		{
			$this->db->where('project_no',$id);
			$query = $this->db->get('nav_services');
			$data_services = $query->result_array();
			return $data_services;
		}

		// public function get_equipment($id)
		// {
		// 	$this->db->select('s.*,m.model,m.id');
		// 	$this->db->from('nav_services_provide s');
		// 	$this->db->join('nav_equi_model m', 's.equipment = m.id');
		// 	$this->db->where('p_no',$id);
		// 	$query = $this->db->get();
		// 	$data_services = $query->result_array();
		// 	return $data_services;
		// }

		public function get_equipment($id)
		{
			$this->db->where('p_no',$id);
			$query = $this->db->get('nav_services_provide');
			$data_services = $query->result_array();
			return $data_services;
		}

		public function insert_file_path($id,$path)
		{
			$data = array(
			'file_path' => $path
			);

			$this->db->where('id', $id);
			if($this->db->update('nav_ir',$data))
			{
				return true;
			}	
		}

		public function filter_data($start_date,$end_date,$location,$site_engineer)
		{
			// $this->db->where( "$completion_date BETWEEN $start_date AND $end_date", NULL, FALSE );
			$this->db->where('completion_date >=',$start_date);
			$this->db->where('completion_date <=',$end_date);
			$this->db->like('eurus_engineer', $site_engineer,'both');
			$this->db->like('location', $location,'both');
			$this->db->order_by('id','desc');
			$query = $this->db->get('nav_ir');
			if($query-> num_rows()>0)
      		{
				$data = $query->result_array();
				return $data;
			}
			else
			{
				return array();
			}
		}

		public function update_IR_data($data1,$id)
		{
			$this->db->where('id', $id);
			if($this->db->update('nav_ir', $data1));
			{
				return true;
			} 
		}

		public function update_IR_services($data2,$num_rows)
		{
			for($i=0; $i < $num_rows; $i++)
			{
				$services_to_update[] = array('s_no'=> $data2['s_no'][$i], 'project_no' => $data2['project_no'], 'services' => $data2['services'][$i], 'complete_date' => $data2['complete_date'][$i], 'site_engineer' =>$data2['site_engineer'][$i]);
			}
			if($this->db->update_batch('nav_services',$services_to_update,'s_no'))
			{
				return true;
			}
		}

		public function update_IR_equipments($data3,$num_equipment)
		{
			if(!empty($data3)) {
				for($i=0; $i < $num_equipment; $i++)
				{
					$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $data3['p_no'], 'equipment' => $data3['equipment'][$i], 'po_desc' => $data3['po_desc'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i]);
				}
				if($this->db->update_batch('nav_services_provide',$equipments_to_update,'s_no'))
				{
					return true; 
				}
			}	
		}


		public function update_service($data2,$num_rows,$pno)
		{
			for($i=1; $i <= $num_rows; $i++)
			{
				$this->db->where('project_no',$pno);
				$this->db->where('m_no',$i);
				$query = $this->db->get('nav_services');
				 $ecount[$i] = $query->num_rows();
				// echo "<br>";
				$num_count[$i] = count($data2['services'][$i]);
				if($ecount[$i] == $num_count[$i]) {
					for($j=0; $j < $ecount[$i]; $j++)
				 	{
						$services_to_update = array('m_no' => $i, 'services' => $data2['services'][$i][$j], 'complete_date' => $data2['complete_date'][$i][$j], 'start_date' =>$data2['start_date'][$i][$j]);
						$this->db->where('project_no', $pno);
						$this->db->where('m_no', $i);
						$this->db->where('s_no', $data2['s_no'][$i][$j]);
						if($this->db->update('nav_services', $services_to_update))
						{
							$data[] = true;
						}
					}
				}
				elseif($num_count[$i] > $ecount[$i]) {
					for($j=0; $j < $ecount[$i]; $j++)
				 	{
						$services_to_update = array('m_no' => $i, 'services' => $data2['services'][$i][$j], 'complete_date' => $data2['complete_date'][$i][$j], 'start_date' =>$data2['start_date'][$i][$j]);
						$this->db->where('project_no', $pno);
						$this->db->where('m_no', $i);
						$this->db->where('s_no', $data2['s_no'][$i][$j]);
						if($this->db->update('nav_services', $services_to_update))
						{
							$data[] = true;
						}
					}
					for($k = $ecount[$i]; $k < $num_count[$i]; $k++)
				 	{
						$services_to_insert[] = array('project_no' => $pno,'m_no' => $i, 'services' => $data2['services'][$i][$k], 'complete_date' => $data2['complete_date'][$i][$k], 'start_date' =>$data2['start_date'][$i][$k]);
					}
				}

				elseif($ecount[$i] > $num_count[$i]) {		
					$this->db->where('project_no', $pno);
					$this->db->where('m_no', $i);
					$this->db->where_not_in('s_no', $data2['s_no'][$i]);
					if($this->db->delete('nav_services'))
					{
						for($j=0; $j < $num_count[$i]; $j++)
				 		{
							$services_to_update = array('m_no' => $i, 'services' => $data2['services'][$i][$j], 'complete_date' => $data2['complete_date'][$i][$j], 'start_date' =>$data2['start_date'][$i][$j]);
							$this->db->where('project_no', $pno);
							$this->db->where('m_no', $i);
							$this->db->where('s_no', $data2['s_no'][$i][$j]);
							if($this->db->update('nav_services', $services_to_update))
							{
								$data[] = true;
							}
						}
					}
				}
			}
			if(isset($services_to_insert) && !empty($services_to_insert))
			{
				if($this->db->insert_batch('nav_services',$services_to_insert))
				{
					$data[] = true;
				}
			}

			return $data;
		}

		public function update_equipment($data3,$num_rows,$pno)
		{ 
			$this->db->where('p_no',$pno);
			$query = $this->db->get('nav_services_provide');
			echo $mcount = $query->num_rows();
			echo "<br>";
			echo $num_rows;
			if($mcount == $num_rows) {
				for($i=0; $i < $num_rows; $i++)
				{
					if(isset($data3['diagram_ref'][$i]) && !empty($data3['diagram_ref'][$i]))
			        {
						$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i]);
					}
					else
					{
						$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i], 'create_date' =>$data3['create_date'][$i]);
					}
					// if(isset($data3['equi_desc'][$i+1][0]) && !empty($data3['equi_desc'][$i+1][0]))
					// {
					// 	$model_to_insert[] = array('model' => $data3['equi_desc'][$i+1][0]);
					// }
				}
				// print_r($equipments_to_insert);
				if($this->db->update_batch('nav_services_provide',$equipments_to_update,'s_no'))
				{
					return true; 
				}
			}
			elseif($mcount >  $num_rows) {
				$this->db->where('p_no', $pno);
				$this->db->where_not_in('s_no', $data3['s_no']);
				if($this->db->delete('nav_services_provide'))
				{
					for($i=0; $i < $num_rows; $i++)
					{
						if(isset($data3['diagram_ref'][$i]) && !empty($data3['diagram_ref'][$i]))
				        {
							$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i]);
						}
						else
						{
							$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i], 'create_date' =>$data3['create_date'][$i]);
						}
					}
					// print_r($equipments_to_insert);
					if($this->db->update_batch('nav_services_provide',$equipments_to_update,'s_no'))
					{
						return true; 
					}
				}
			}

			elseif($mcount <  $num_rows) {
				
				for($i=0; $i < $mcount; $i++)
				{
					if(isset($data3['diagram_ref'][$i]) && !empty($data3['diagram_ref'][$i]))
			        {
						$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i]);
					}
					else
					{
						$equipments_to_update[] = array('s_no'=> $data3['s_no'][$i], 'p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i], 'create_date' =>$data3['create_date'][$i]);
					}
				}
				if($this->db->update_batch('nav_services_provide',$equipments_to_update,'s_no'))
				{
					return true; 
				}

				for($i=$mcount; $i < $num_rows; $i++)
				{
					if(isset($data3['diagram_ref'][$i]) && !empty($data3['diagram_ref'][$i]))
			        {
						$equipments_to_insert[] = array('p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i],'diagram_ref' =>$data3['diagram_ref'][$i],'create_date' =>$data3['create_date'][$i]);
					}
					else
					{
						$equipments_to_insert[] = array('p_no' => $pno, 'equipment' => $data3['equipment'][$i], 'rack' =>$data3['rack'][$i], 'create_date' =>$data3['create_date'][$i]);
					}
				}
				// print_r($equipments_to_insert);
				if($this->db->insert_batch('nav_services_provide',$equipments_to_insert))
				{
					return true; 
				}
			}
				
		}


		public function add_comments($project_no,$comment)
		{
			$this->db->set('comments', $comment);
			$this->db->where('id', $project_no);
			$this->db->update('nav_ir'); 
		}
	}
?>