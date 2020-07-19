<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
			parent:: __construct();
			// error_reporting(E_ALL & ~E_NOTICE);
			if(!$this->session->userdata('login')){
				redirect(base_url().'auth');
			}
			$this->load->model('User_model');
		}

		public function task(){
			$data['name'] 		= $this->session->userdata('name');
			$data['usr_name'] 	= $this->session->userdata('user_id');
			$data['city'] 		= $this->User_model->city();
			$data['site_engineer'] = $this->User_model->site_engineer();
			$data['machines'] = $this->User_model->machines();

			if($this->input->get('filter') == "filter") {
				$start_date				=  	$this->input->get('s_date'); 
				if($start_date == "")
				{
					$start_date 		=	date("Y-m-d", time()-7*24*3600);
					$data['start_date']	=	$start_date ;
				}

				$end_date				= 	$this->input->get('e_date'); 

				if($end_date == "")
				{
					$end_date 			=	date("Y-m-d");
					$data['end_date']	=	$end_date ;
				}

				$location				= 	$this->input->get('location'); 

				$site_engineer			= 	$this->input->get('s_engineer');
				

				$data['form_data'] 	=	$this->User_model->filter_data($start_date,$end_date,$location,$site_engineer);
				$this->load->view('task',$data);
			}
			else
			{
				if($this->input->post('add_comment') == "comment") {
					$project_no =	$this->input->post('pid');
					$comment    =   $this->input->post('comment');  
					$data['form_data'] 	= $this->User_model->add_comments($project_no,$comment);
				}
				$data['form_data'] 	= $this->User_model->get_data($data['name']);
			
				$this->load->view('task',$data);
			}
		}

		public function add_ir()
		{
			$data['name'] = $this->session->userdata('name');
			$data['city'] = $this->User_model->city();
			$data['site_engineer'] = $this->User_model->site_engineer();
			$data['machines'] = $this->User_model->machines();
			$data['equi_model'] = $this->User_model->equi_model();
			$data['last_id'] 	= $this->User_model->last_project_id();
			if($data['last_id'] == ""){
				$data['last_id'] = 1;
			}
			// print_r($data['last_id']);

			if($this->input->post('form_submit') == "submit") {
				$e_engineer = implode(',', $this->input->post('e_engnr'));
				$data1 = array(
					'project_name'		=>	$this->input->post('p_name'), 
					'po'				=>	$this->input->post('po'),
					'po_date'			=>	$this->input->post('t_date'), 
					'location'			=>	$this->input->post('location'),
					'sublocation'		=>	$this->input->post('area'),
					'client_name'		=>	$this->input->post('c_name'), 
					'ir_prepared_by'	=>	$this->input->post('ir_by'), 
					'client_manager'	=>	$this->input->post('c_manager'), 
					'eurus_manager'		=>	$this->input->post('e_manager'), 
					// 'client_email'		=>	$this->input->post('c_email'), 
					'site_add'			=>	$this->input->post('site_add'), 
					'eurus_engineer'	=>	$e_engineer, 
					'completion_date'	=>	$this->input->post('dt_complt'), 
					// 'invoice_no'		=>	$this->input->post('invoice'),
					'install_report'	=>  $this->input->post('install_report'),
					'remarks'			=>  str_replace(array("\r\n", "\n", "\r"),' ',htmlspecialchars($this->input->post('remarks')))	
				);

				$data['last_id'] 	= $this->User_model->last_project_id();

				if($data['last_id'] != ""){
					$this->session->set_userdata('project_no_id', $data['last_id']);
					$project_no = $this->session->userdata('project_no_id');
				}
				else{
					$project_no = 0;
				}
				$data2 = array( 
					'services'			=> 	$this->input->post('tr_services'), 
					'start_date'		=> 	$this->input->post('tr_date'),
					'complete_date'		=> 	$this->input->post('tr_cdate')
				);

				$num_rows = count($data2['services']);
				$data4 = [];
				$fcount = count($_FILES['dgm_ref']['name']);
				foreach ($_FILES['dgm_ref']['name'] as $key => $value) {
					if(!empty($_FILES['dgm_ref']['name'][$key][0])){

						$_FILES['file']['name'] 	= $_FILES['dgm_ref']['name'][$key][0];
						$_FILES['file']['type'] 	= $_FILES['dgm_ref']['type'][$key][0];
						$_FILES['file']['tmp_name'] = $_FILES['dgm_ref']['tmp_name'][$key][0];
						$_FILES['file']['error'] 	= $_FILES['dgm_ref']['error'][$key][0];
						$_FILES['file']['size'] 	= $_FILES['dgm_ref']['size'][$key][0];
						// print_r($_FILES['file']);
						$config['upload_path']      = './uploads/'.($project_no['id'] + 1);
						if(!is_dir($config['upload_path'])) 
							{ 
								mkdir($config['upload_path'], 0777, TRUE);
							}
						$config['allowed_types']        = 'pdf|jpg|png|jpeg|csv|xlsx';
						$config['max_size']             = 2000;
						$config['max_width']            = 1024;
						$config['max_height']           = 768;
						echo $config['file_name'] 		= $_FILES['dgm_ref']['name'][$key][0];
						if(isset($this->upload)){
							unset($this->upload);
						}
						//unset($config['file_name']);
						$this->load->library('upload', $config);
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							// print_r($uploadData);	
							$filename = $uploadData['file_name'];
							$data4['totalFiles'][$key-1] = $filename;
						}
						else
						{
							$error = array('error' => $this->upload->display_errors());
							// print_r($error);
						}
		            }
		        }
		        $data4['equi_desc'] = $this->input->post('other');
		        if(isset($data4['totalFiles']) && !empty($data4['totalFiles']))
		        {
		        	$data3= array(
						'p_no' 				=>	$project_no['id'] + 1, 
						'equipment' 		=>	$this->input->post('equip'), 
						'equi_desc'			=>	$data4['equi_desc'], 
						'rack'				=>	$this->input->post('rack'),
						'diagram_ref'		=>	$data4['totalFiles'],
						'create_date'		=>	$this->input->post('todate')
					);
		        }
			    else
			    {
					$data3= array(
						'p_no' 				=>	$project_no['id'] + 1, 
						'equipment' 		=>	$this->input->post('equip'), 
						'equi_desc'			=>	$data4['equi_desc'], 
						'rack'				=>	$this->input->post('rack'),
						'diagram_ref'		=>  '',
						'create_date'		=>	$this->input->post('todate')
					);
				}
				$num_equipment = count($data3['equipment']);
				// echo "<pre>";
				// print_r($data3);
				
				// print_r($data2);
				$data['form'] = $this->User_model->form_data($data1);
				$data['service'] = $this->User_model->form_service($data2,$num_rows,$project_no['id']);
				$data['equipment'] = $this->User_model->form_equipments($data3,$num_equipment);
				$this->load->view('success',$data);
			}
			else{
				$this->load->view('add_new_ir',$data);
			}
		}

		public function form_data()
		{
			// if($this->input->post('form_submit') == "submit") {

			// 	$data1 = array(
			// 		'project_name'		=>	$this->input->post('p_name'), 
			// 		'po'				=>	$this->input->post('po'),
			// 		'po_date'			=>	$this->input->post('t_date'), 
			// 		'location'			=>	$this->input->post('location'),
			// 		'sublocation'		=>	$this->input->post('area'),
			// 		'client_name'		=>	$this->input->post('c_name'), 
			// 		'ir_prepared_by'	=>	$this->input->post('ir_by'), 
			// 		'client_manager'	=>	$this->input->post('c_manager'), 
			// 		'eurus_manager'		=>	$this->input->post('e_manager'), 
			// 		'client_email'		=>	$this->input->post('c_email'), 
			// 		'site_add'			=>	$this->input->post('site_add'), 
			// 		'eurus_engineer'	=>	$this->input->post('e_engnr'), 
			// 		'completion_date'	=>	$this->input->post('dt_complt'), 
			// 		'invoice_no'		=>	$this->input->post('invoice'),
			// 		'install_report'	=>  $this->input->post('install_report'),
			// 		'remarks'			=>  $this->input->post('remarks')	
			// 	);

			// 	$data['last_id'] 	= $this->User_model->last_project_id();

			// 	if($data['last_id'] != ""){
			// 		$this->session->set_userdata('project_no_id', $data['last_id']);
			// 		$project_no = $this->session->userdata('project_no_id');
			// 		// print_r($project_no);
			// 	}
			// 	else{
			// 		$project_no = 0;
			// 		// print_r($project_no);
			// 	}
			// 	$data2 = array(
			// 		'project_no'		=>  $project_no['id'] + 1, 
			// 		'services'			=> 	$this->input->post('tr_services'), 
			// 		'complete_date'		=> 	$this->input->post('tr_date'), 
			// 		'site_engineer'		=> 	$this->input->post('tr_engineer')
			// 	);

			// 	$num_rows = count($data2['services']);

			// 	$data3= array(
			// 		'p_no' 				=>	$project_no['id'] + 1, 
			// 		'equipment' 		=>	$this->input->post('equip'), 
			// 		'model'				=>	$this->input->post('model'), 
			// 		'rack'				=>	$this->input->post('rack'),
			// 		'diagram_ref'		=>	$this->input->post('dgm_ref'),
			// 		'create_date'		=>	$this->input->post('todate')

			// 	);

			// 	$num_equipment = count($data3['equipment']);
			// 	$data['form'] = $this->User_model->form_data($data1);
			// 	$data['service'] = $this->User_model->form_service($data2,$num_rows);
			// 	$data['equipment'] = $this->User_model->form_equipments($data3,$num_equipment);

			// 	$this->load->view('success',$data);
			// }

			 // redirect('/account/login', 'refresh');
			// redirect(base_url().'user/task');

			
		}

		public function download_file($id = NULL)
		{
			$this->load->library('pdfgenerator');
			$data['name'] 			= $this->session->userdata('name');
			$data['form_data']  	= $this->User_model->get_data();
			$data['ir_data'] 		= $this->User_model->get_ir_data($id);
			$data['get_services'] 	= $this->User_model->get_services($id);
			$data['get_equipment'] 	= $this->User_model->get_equipment($id);
			$html = $this->load->view('download', $data, true);
			$filename = 'report_'.time();
			$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

			// $this->load->view('download',$data);
		}

		public function upload_file($id = NULL)
		{
			// print_r($_POST);
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'pdf';
			// if($config['allowed_types']  == 'pdf') {
				$config['max_size']             = 2000;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('userfile'))
                {
                    $data = array('error' => $this->upload->display_errors());
                 
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $filepath = '../uploads/'.$data['upload_data']['file_name'];
                    $data['insert_path'] = $this->User_model->insert_file_path($id,$filepath);
                    $data['success'] =  $data['insert_path'];
                  
                }
                $this->load->view('success',$data);
	         // }
	         // else
	         // {
	         // 	echo "error";
	         // }
		}

		public function update_ir($id = NULL)
		{
			///////////////////////////// admin //////////////////////////////////////
			$data['project_no']		= $id;
			$data['machines'] 		= $this->User_model->machines();
			$data['ir_data'] 		= $this->User_model->get_ir_data($id);
			$data['get_services'] 	= $this->User_model->get_services($id);
			$data['get_equipment'] 	= $this->User_model->get_equipment($id);
			$data['city'] 			= $this->User_model->city();
			$data['site_engineer'] 	= $this->User_model->site_engineer();
			$data['equi_model'] 	= $this->User_model->equi_model();
			
			if($this->input->post('update') == "update") {

				// $data1 = array(
				// 	'id'				=>  $this->input->post('p_num'),
				// 	'project_name'		=>	$this->input->post('p_name'), 
				// 	'po'				=>	$this->input->post('po'),
				// 	'po_date'			=>	$this->input->post('t_date'), 
				// 	'location'			=>	$this->input->post('location'),
				// 	'sublocation'		=>	$this->input->post('area'),
				// 	'client_name'		=>	$this->input->post('c_name'), 
				// 	'ir_prepared_by'	=>	$this->input->post('ir_by'), 
				// 	'client_manager'	=>	$this->input->post('c_manager'), 
				// 	'eurus_manager'		=>	$this->input->post('e_manager'), 
				// 	'client_email'		=>	$this->input->post('c_email'), 
				// 	'site_add'			=>	$this->input->post('site_add'), 
				// 	'eurus_engineer'	=>	$this->input->post('e_engnr'), 
				// 	'completion_date'	=>	$this->input->post('dt_complt'), 
				// 	'invoice_no'		=>	$this->input->post('invoice'),
				// 	'install_report'	=>  $this->input->post('install_report'),
				// 	'remarks'			=>  $this->input->post('remarks')	
				// );
				// $data2 = array(
				// 	's_no'				=>	$this->input->post('id'),
				// 	'project_no'		=>  $this->input->post('p_num'), 
				// 	'services'			=> 	$this->input->post('tr_services'), 
				// 	'complete_date'		=> 	$this->input->post('tr_date'), 
				// 	'site_engineer'		=> 	$this->input->post('tr_engineer')
				// );

				// $num_rows = count($data2['services']);

				// $data3= array(
				// 	's_no'				=>	$this->input->post('id'),
				// 	'p_no' 				=>	$this->input->post('p_num'), 
				// 	'equipment' 		=>	$this->input->post('model'), 
				// 	'po_desc'			=>	$this->input->post('equip'), 
				// 	'rack'				=>	$this->input->post('rack'),
				// 	'diagram_ref'		=>	$this->input->post('dgm_ref'),
				// 	'create_date'		=>	$this->input->post('todate')

				// );








				$e_engineer = implode(',', $this->input->post('e_engnr'));
				$p_no 				=	$this->input->post('p_num');
				$data1 = array(
					'project_name'		=>	$this->input->post('p_name'), 
					'po'				=>	$this->input->post('po'),
					'po_date'			=>	$this->input->post('t_date'), 
					'location'			=>	$this->input->post('location'),
					'sublocation'		=>	$this->input->post('area'),
					'client_name'		=>	$this->input->post('c_name'), 
					'ir_prepared_by'	=>	$this->input->post('ir_by'), 
					'client_manager'	=>	$this->input->post('c_manager'), 
					'eurus_manager'		=>	$this->input->post('e_manager'), 
					'site_add'			=>	$this->input->post('site_add'), 
					'eurus_engineer'	=>	$e_engineer, 
					'completion_date'	=>	$this->input->post('dt_complt'), 
					'install_report'	=>  $this->input->post('install_report'),
					'remarks'			=>  str_replace(array("\r\n", "\n", "\r"),' ',htmlspecialchars($this->input->post('remarks')))	
				);

				$data2 = array( 
					'services'			=> 	$this->input->post('tr_services'), 
					'start_date'		=> 	$this->input->post('tr_date'),
					'complete_date'		=> 	$this->input->post('tr_cdate'),
					's_no'				=>	$this->input->post('tr_sno')
				);

				$num_rows = count($data2['services']);

				$data4 = [];
				if(isset($_FILES['dgm_ref']) && !empty($_FILES['dgm_ref']))
				{
					$fcount = count($_FILES['dgm_ref']['name']);
					foreach ($_FILES['dgm_ref']['name'] as $key => $value) {
						if(!empty($_FILES['dgm_ref']['name'][$key][0])){

							$_FILES['file']['name'] 	= $_FILES['dgm_ref']['name'][$key][0];
							$_FILES['file']['type'] 	= $_FILES['dgm_ref']['type'][$key][0];
							$_FILES['file']['tmp_name'] = $_FILES['dgm_ref']['tmp_name'][$key][0];
							$_FILES['file']['error'] 	= $_FILES['dgm_ref']['error'][$key][0];
							$_FILES['file']['size'] 	= $_FILES['dgm_ref']['size'][$key][0];
							// print_r($_FILES['file']);
							$config['upload_path']      = './uploads/'.($project_no['id'] + 1);
							if(!is_dir($config['upload_path'])) 
								{ 
									mkdir($config['upload_path'], 0777, TRUE);
								}
							$config['allowed_types']        = 'pdf|jpg|png|jpeg|csv|xlsx';
							$config['max_size']             = 2000;
							$config['max_width']            = 1024;
							$config['max_height']           = 768;
							echo $config['file_name'] 		= $_FILES['dgm_ref']['name'][$key][0];
							if(isset($this->upload)){
								unset($this->upload);
							}
							//unset($config['file_name']);
							$this->load->library('upload', $config);
							if($this->upload->do_upload('file')){
								$uploadData = $this->upload->data();
								// print_r($uploadData);	
								$filename = $uploadData['file_name'];
								$data4['totalFiles'][$key-1] = $filename;
							}
							else
							{
								$error = array('error' => $this->upload->display_errors());
								// print_r($error);
							}
			            }
			        }
			    }
		        $data4['equi_desc'] = $this->input->post('other');
		        if(isset($data4['totalFiles']) && !empty($data4['totalFiles']))
		        {
		        	$data3= array(
						'equipment' 		=>	$this->input->post('equip'), 
						'equi_desc'			=>	$data4['equi_desc'], 
						'rack'				=>	$this->input->post('rack'),
						'diagram_ref'		=>	$data4['totalFiles'],
						'create_date'		=>	$this->input->post('todate'),
						's_no'				=>	$this->input->post('m_sno')
					);
		        }
			    else
			    {
					$data3= array(
						'equipment' 		=>	$this->input->post('equip'), 
						'equi_desc'			=>	$data4['equi_desc'], 
						'rack'				=>	$this->input->post('rack'),
						'diagram_ref'		=>  '',
						'create_date'		=>	$this->input->post('todate'),
						's_no'				=>	$this->input->post('m_sno')
					);
				}
				$num_equipment = count($data3['equipment']);
				// $num_equipment = count($data3['equipment']);
				$data['details'] = 	$this->User_model->update_IR_data($data1,$p_no);
				$data['service'] = 	$this->User_model->update_service($data2,$num_rows,$p_no);
				$data['equipment'] = $this->User_model->update_equipment($data3,$num_equipment,$p_no);
				$this->load->view('success',$data);
				// echo "<pre>";
				// // echo "ujjwal";
				// print_r($data1);
				// print_r($_POST);
			}
			else{
				// $this->load->view('update_ir',$data);
				$this->load->view('update_ir',$data);
			}

			////////////////////////// END ////////////////////////////////


		}
			
		public function logout(){
			$value = array('login','user_id','name');
			$this->session->unset_userdata($value);
			redirect(base_url().'auth');
		}


}
?>