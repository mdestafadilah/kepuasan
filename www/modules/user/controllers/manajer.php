<?php
/***************************************************************************************
 *                       			konsumen.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	konsumen.php
 *      Created:   		2012 - 12.35.14 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
class Manajer extends MX_Controller
{
	private $groups = 'manajer';
	
	function __construct()
	{
		parent::__construct();
		$data = array();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper(array('url', 'form'));
		$this->load->model(array('user/user_model','soal/soal_model','pelanggan/pelanggan_model','user/rawatkonsumen_model','perawat/perawat_model'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		// Enable the output profiler so you can see the db queries run.
		// $this->output->enable_profiler(TRUE);
	}
	
	function debuk()
	{
		
		$data['user'] = $this->ion_auth->user($id)->row();
			$data['grup'] = $this->ion_auth->group($id)->row();
			
			$id = $data['user']->id;
			$data['pasangan']= $this->db->query("
							SELECT
							rawat.id,
							userperawat.username AS `nama_perawat`,
							userperawat.elderly AS `jenis_rawat`,
							userperawat.address AS `alamat_perawat`,
							userperawat.email AS `email_perawat`,
							userperawat.phone AS `telpon_perawat`
							FROM
							rawatkonsumen AS rawat
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							WHERE
							userkonsumen.id = $id
							")->row();
		
		dump($id);
		dump($this->db->last_query());
		dump($this->db->insert_id());
		exit;
		
	}

	function index()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('manajer'))
		{
				
			// For span in Dashboard Manajer
			$data['total_perawat']  = $this->ion_auth->users('4')->num_rows();
			$data['total_konsumen'] = $this->ion_auth->users('3')->num_rows();
			$data['total_soal'] 	= $this->soal_model->count_by('publish','1');
			
			// Buat Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] 	 = "Welcome to Sistem Informasi Kepuasan Pelanggan";
			$data['manajer'] = "manajer"; // Controller
			$data['view'] 	 = "home_manajer"; // View
			$data['module']  = "home"; // Controller
				
			// Load Template->view(login)
			echo Modules::run('template/manajer',$data);
		}else{
			redirect('auth/index/', 'refresh');
		}
	}
	
	function profile()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($this->groups))
		{
				
			// Buat Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] 	 = "Profile Manajer";
			$data['manajer'] = "manajer"; // Controller
			$data['view'] 	 = "gen_manajer"; // View
			$data['module']  = "user"; // Controller
		
			// Load Template->view(login)
			echo Modules::run('template/manajer',$data);
		}else{
			redirect('auth/index/', 'refresh');
		}
	}
	//------------------------------------------------------------------------------------------------
	
	/*
	 * Fungsi untuk menambah informasi data pasangan perawat dan konsumen
	 * ----
	 * 
	 */
	function rawat_konsumen()
	{
			// validasi inputan dropdon
			$this->form_validation->set_rules('perawat_id', 'Nama Perawat');
			$this->form_validation->set_rules('konsumen_id', 'Nama Konsumen');
			
			if ($this->form_validation->run() == true)
			{
				//populate data
				$data = array(
						'perawat_id'	=> $this->input->post('perawat_id'),
						'konsumen_id'   => $this->input->post('konsumen_id'),
						);
			}
			
			if ($this->form_validation->run() == true
					&& $this->rawatkonsumen_model->insert($data))
			{
				
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Informasi berhasil ditambahkan!</div>");
				redirect('user/manajer/rawat_konsumen/','refresh');
			}
			else
			{
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
				
				$data['konsumen_id'] = array(
						'name' => 'konsumen_id',
						'id' => 'konsumen_id',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('konsumen_id'),
				);
				
				$data['perawat_id'] = array(
						'name' => 'perawat_id',
						'id' => 'perawat_id',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('perawat_id'),
				);
								
				// Buat Template
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title'] 	 = "Module Manajer - Update Rawat Konsumen";
				$data['manajer'] = "manajer"; // Controller
				$data['view'] 	 = "rawat_konsumen_view"; // View
				$data['module']  = "user"; // Controller
				
				// Load Template->view(login)
				echo Modules::run('template/manajer',$data);
			}
		}

	/*
	 * Fungsi menampilkan daftar pasangan perwwat dan konsumen
	 * ----
	 * 
	 */
	function list_rawat_konsumen()
	{
		// paging
		$this->load->library('pagination');
		
		$uri_segment = 4;
		$data['offset'] = $this->uri->segment($uri_segment);
		$config['base_url'] = base_url().'user/manajer/list_rawat_konsumen/index/';
		$config['total_rows'] = $this->rawatkonsumen_model->count_all();
		$config['per_page'] = 10;
		$config['next_link'] = '<li>Selanjutnya</li>';
		$config['prev_link'] = '<li>Sebelumnya</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
		$config['cur_tag_close'] = ' </li>';
		
		// run paging
		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();
		
		$data['get_info'] = $this->db->query("
		 		SELECT
				rawat.id,
		 		userkonsumen.username AS `nama_konsumen`,
		 		userperawat.username AS `nama_perawat`,
		 		userperawat.elderly AS `jenis_rawat`,
		 		userkonsumen.address AS `alamat_konsumen`
		 		FROM
		 		rawatkonsumen AS rawat
		 		INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
		 		INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
 				")->result();
		 
		 $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
		 			 
		 // Buat Template
		 $data['welcome'] 	= ucfirst($this->session->userdata('email'));
		 $data['title'] 	= "Module Manajer - Update Rawat Konsumen";
		 $data['manajer'] 	= "manajer"; // Controller
		 $data['view'] 	 	= "data_rawat_konsumen_view"; // View
		 $data['module']  	= "user"; // Controller
		 
		 // Load Template->view(login)
		 echo Modules::run('template/manajer',$data);
		 
		 /*	 
		 dump($this->db->last_query());
		 dump($data);exit;
		 */
		 
	}
	
	/*
	 * Fungsi untuk meng-update- informasi pasangan
	 * ----
	 * 
	 */
	function edit_informasi($id = null)
	{
		
		$id = (int) $id;
		
		$data['title'] = "Edit Informasi Pasangan";
			
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manajer'))
		{
			redirect('home', 'refresh');
		}
		
		$detail = $this->rawatkonsumen_model->get_by('id',$id);
		$this->form_validation->set_rules('konsumen_id', 'Nama Konsumen', 'required');
		$this->form_validation->set_rules('perawat_id', 'Nama Perawat', 'required');
		
		if (isset($_POST) && !empty($_POST))
		{
			// validasi inputan yang tersimpan
			$data = array(
					'konsumen_id' => $this->input->post('konsumen_id'),
					'perawat_id'  => $this->input->post('perawat_id'),
			);
			
			// jika yes
			if ($this->form_validation->run() == TRUE 
					&& $this->rawatkonsumen_model->update($detail->id, $data))
			{
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('user/manajer/list_rawat_konsumen', 'refresh');
			}
		}
		
		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
		$data['get_info'] = $detail;
		
		$data['konsumen_id'] = array(
				'name' => 'konsumen_id',
				'id'   => 'konsumen_id',
				'type' => 'konsumen_id',
				'value'=> $detail->konsumen_id,
		);
		$data['perawat_id'] = array(
				'name' => 'perawat_id',
				'id'   => 'perawat_id',
				'type' => 'perawat_id',
				'value'=> $detail->perawat_id,
		);
					
		// Buat Template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 		= "Module Manajer - Update Rawat Konsumen";
		$data['manajer'] 	= "manajer"; // Controller
		$data['view'] 	 	= "rawat_konsumen_edit"; // View
		$data['module']  	= "user"; // Controller
			
		// Load Template->view(login)
		echo Modules::run('template/manajer',$data);
	}
	
	function detail_informasi($id)
	{
		
		$id = (int) $id;
		
		$data['user'] = $this->ion_auth->user($id)->row();
		$id = $data['user']->id;
		
		$data['pasangan']= $this->db->query("
							SELECT
							rawat.id,
							userperawat.username AS `nama_perawat`,
							userperawat.elderly AS `jenis_rawat`,
							userperawat.address AS `alamat_perawat`,
							userperawat.email AS `email_perawat`,
							userperawat.phone AS `telpon_perawat`
							FROM
							rawatkonsumen AS rawat
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							WHERE
							userkonsumen.id = $id
							")->row();
			
			
		// Buat Template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 		= "Module Manajer - Update Rawat Konsumen";
		$data['manajer'] 	= "manajer"; // Controller
		$data['view'] 	 	= "rawat_konsumen_detail"; // View
		$data['module']  	= "user"; // Controller
			
		// Load Template->view(login)
		echo Modules::run('template/manajer',$data);
	}
	
	function hapus_informasi($id)
	{
		$id = (int) $id;
		
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo 'You don\'t have an access';
		}
		elseif ($this->ion_auth->in_group('manajer')
					&& $this->rawatkonsumen_model->delete($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data berhasil dihapus!</div>");
			redirect('user/manajer/list_rawat_konsumen/index');
		}
		
	}
}
 
 
 /* End of File: konsumen.php */
/* Location: ../www/modules/konsumen.php */ 