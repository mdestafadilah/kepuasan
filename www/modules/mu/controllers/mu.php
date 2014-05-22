<?php
/***************************************************************************************
 *                       			mu.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	mu.php
 *      Created:   		2013 - 14.16.31 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Mu extends MX_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->library(array('pagination','ion_auth','session','form_validation'));
		$this->load->model(array('user/user_model','dimensi/dimensi_model','soal/soal_model','mu_model'));
  	}
  	
 	function index()
 	{
 		if ($this->ion_auth->is_admin()
 				|| $this->ion_auth->in_group('manajer'))
 		{
 			$this->_manage();
 		}
 		else
 		{
 			echo "Please Login";
 			echo br(2);
 			echo anchor('auth/login','Login');
 		}
 	}
 	
 	function debuk()
 	{
 		$id = 12;
 		$soalDimensi = $this->mu_model
					 		->with('banksoal')
					 		->with('users')
					 		->with('dimensi')
					 		->get($id);
 		
 		dump($soalDimensi);
 	}
 	
 	function update($id = null)
 	{
 		$id = (int) $id;
 		$data['title'] = "Edit Pengguna";
 		
 		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
 		{
 			redirect('mu', 'refresh');
 		}
 			 			
 		// $mu = $this->mu_model->get($id); // an object of soal
 		
 		$soal = $this->soal_model->get_all();
 		$konsumen = $this->user_model->get_all();
 		$dimensi = $this->dimensi_model->get_all();
 		$mu = $this->mu_model
 							->with('banksoal')
						 	->with('users')
						 	->with('dimensi')
 							->get($id);
 		
 		$this->form_validation->set_rules('banksoal_id', 'Pertanyaan', 'required');
 		$this->form_validation->set_rules('user_id', 'Nama Konsumen', 'required');
 		$this->form_validation->set_rules('dimensi_id', 'Dimensi', 'required');
 		$this->form_validation->set_rules('MuHasil', 'Hasil Awal', 'required');
 		$this->form_validation->set_rules('MuFire', 'Nilai Total', 'required');
 		$this->form_validation->set_rules('MuKecewa', 'Nilai Kecewa', 'required');
 		$this->form_validation->set_rules('MuBiasa', 'Nilai Biasa', 'required');
 		$this->form_validation->set_rules('MuPuas', 'Nilai Puas', 'required');
 		
 		// cek hasil ketik
 		if (isset($_POST) && !empty($_POST))
 		{
 			$data = array(
 					'banksoal_id' => $this->input->post('banksoal_id'),
 					'user_id' => $this->input->post('user_id'),
 					'dimensi_id' => $this->input->post('dimensi_id'),
 					'MuHasil'	=> $this->input->post('MuHasil'),
 					'MuFire' => $this->input->post('MuFire'),
 					'MuKecewa' => $this->input->post('MuKecewa'),
 					'MuBiasa' => $this->input->post('MuBiasa'),
 					'MuPuas' => $this->input->post('MuPuas'),
 			);
 		
 			// jika bedul
 			if ($this->form_validation->run() == TRUE &&
 					$this->mu_model->update($mu->id, $data))
 			{
 				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Keanggotaan sudah terupdate! </div>");
 				redirect('mu/index', 'refresh');
 			}
 		}
 		
 		// Populate
 		$data['single'] = $mu;
 		$data['dimensi'] = $dimensi;
 		$data['banksoal'] = $soal;
 		$data['konsumen'] = $konsumen;
 			
 		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
 		
 		$data['MuHasil'] = array(
 				'name'  => 'MuHasil',
 				'id'    => 'MuHasil',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('MuHasil', $mu->MuHasil),
 		);
 		
 		$data['MuKecewa'] = array(
 				'name'  => 'MuKecewa',
 				'id'    => 'MuKecewa',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('MuKecewa', $mu->MuKecewa),
 		);
 		
 		$data['MuBiasa'] = array(
 				'name'  => 'MuBiasa',
 				'id'    => 'MuBiasa',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('MuBiasa', $mu->MuBiasa),
 		);
 		
 		$data['MuPuas'] = array(
 				'name'  => 'MuPuas',
 				'id'    => 'MuPuas',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('MuPuas', $mu->MuPuas),
 		);
 		
 		$data['MuFire'] = array(
 				'name'  => 'MuFire',
 				'id'    => 'MuFire',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('MuFire', $mu->MuFire),
 		);
 		
 		$data['dimensi_id'] = array(
 				'name'  => 'dimensi_id',
 				'id'    => 'dimensi_id',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('dimensi_id', $mu->dimensi_id),
 		);
 		
 		$data['user_id'] = array(
 				'name'  => 'user_id',
 				'id'    => 'user_id',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('user_id', $mu->user_id),
 		);
 		
 		$data['banksoal_id'] = array(
 				'name'  => 'banksoal_id',
 				'id'    => 'banksoal_id',
 				'type'  => 'text',
 				'value' => $this->form_validation->set_value('banksoal_id', $mu->banksoal_id),
 		);
 		
 		
 		// render template
 		$data['welcome'] = ucfirst($this->session->userdata('email'));
 		$data['title'] = "Modul Fuzzy Keanggotaan - Ubah Nilai Keanggotaan";
 		$data['module'] = "mu"; // module
 		$data['mu'] = "mu"; // controller
 		$data['view'] = "mu_edit"; // view
 		
 		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 			}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 			}
 			
 	}
 	
 	function delete($id)
 	{
 		if ($this->ion_auth->is_admin()
 							&& $this->mu_model->delete($id))
 		{
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Mu berhasil dihapus!</div>");
 			redirect('mu/index');
 		}
 	}
 	
 	function _manage()
 	{
 		
 		$this->load->library('pagination');
 		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
 		
 		$uri_segment = 3;
 		$data['offset'] = $this->uri->segment($uri_segment);
 		
 		$config['base_url'] = base_url().'mu/index/';
 		$config['total_rows'] = $this->mu_model->count_all();
 		$config['per_page'] = 50;
 		$config['next_link'] = '<li>Selanjutnya</li>';
 		$config['prev_link'] = '<li>Sebelumnya</li>';
 		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> Halaman Ke -';
 		$config['cur_tag_close'] = '</li>';
 		
 		$this->pagination->initialize($config);
 		$data['paging'] = $this->pagination->create_links();
 		$data['limit'] = $config['per_page'];
 		
 		$data['selected'] = $this->input->post('user_id');
 		$user = $this->input->post('user_id');
 		$data['alls'] = $this->mu_model
						 		->with('banksoal')
						 		->with('users')
						 		->with('dimensi')
						 		->order_by('user_id')
						 		->get_many_by('user_id',$user);
 			
 			
 		// Template
 		$data['welcome'] = ucfirst($this->session->userdata('email'));
 		$data['title']  = "Module Mu - Data All";
 		$data['mu']  = "mu"; // Controller
 		$data['view']   = "mu_view"; // View
 		$data['module'] = "mu"; // Controller
 			
 		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 			}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 			}
 	}
 	
 	function search()
 	{
 		echo "Still development";
 	}
 }
 
 
 /* End of File: mu.php */
/* Location: ../www/modules/mu.php */ 