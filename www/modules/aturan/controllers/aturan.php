<?php
/***************************************************************************************
 *                       			aturan.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	aturan.php
 *      Created:   		2013 - 14.09.45 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Aturan extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		// IONAuth Standard load
 		$this->load->library(array('ion_auth','session','form_validation'));
 		$this->load->helper('url');
 		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 		$this->load->model('aturan_model');
 	}
 	
 	function index()
 	{
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			$this->_manage();
 		}
 		else
 		{
 			echo "Restricted Area";
 			echo br(2);
 			echo anchor('home','Kembali');
 		}
 	}
 	/*
 	 * Fungsi untuk mengatur/ menampilkan data
 	 * ------
 	 * 
 	 */
 	function _manage()
 	{
 		// paging
 		$this->load->library('pagination');
 		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
 		
 		$uri_segment = 3	;
 		$data['offset'] = $this->uri->segment($uri_segment);
 		
 		$config['base_url'] = base_url().'aturan/index/';
 		$config['total_rows'] = $this->aturan_model->count_all();
 		$config['per_page'] = 5;
 		$config['next_link'] = '<li>Selanjutnya</li>';
 		$config['prev_link'] = '<li>Sebelumnya</li>';
 		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> Halaman Ke -';
 		$config['cur_tag_close'] = '</li>';
 		
 		$this->pagination->initialize($config);
 		$data['paging'] = $this->pagination->create_links();
 		
 		$data['limit'] = $config['per_page'];
 		
 		// all soal as object as object :)
 		$data['results'] = $this->aturan_model
 								->as_array()
						 		->limit($data['limit'], $data['offset'])
						 		->get_all();
 			
 		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Aturan - Daftar Aturan";
 		$data['module'] 	= "aturan"; // module
 		$data['aturan'] 	= "aturan"; // controller
 		$data['view'] 		= "aturan_view"; // view
 			
 		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 		}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 		}
 	}
 	
 	function add()
 	{
 		if ($this->ion_auth->is_admin())
 		{
 			// buat aturan dulu
 			$this->form_validation->set_rules('variabel','variabel','required');
			$this->form_validation->set_rules('nilai','Nilai','required|is_unique[aturan.min]');
 		}
 		
 		if ($this->form_validation->run() == true)
 		{
 			$data = array(
 					'variabel' 	=> $this->input->post('variabel'),
 					'nilai' 		=> $this->input->post('nilai'),
 			);
 		}
 		
 		if ($this->form_validation->run() == true
 				&& $this->aturan_model->insert($data))
 		{
 			//dump($_POST);exit;
 			$this->session->set_flashdata('message', "<div class=\"alert alert-success\"> <a class=\"close\" data-dismiss=\"alert\">X</a>Aturan Berhasil Ditambahkan </div>");
 			redirect('aturan/index','refresh');
 		}
 		else
 		{
			// populate data
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"> <a class="close" data-dismiss="alert">X</a>'. validation_errors().'</div>' : $this->session->flashdata('message'));
			
			$data['variabel'] = array(
					'name'  => 'variabel',
					'id'    => 'variabel',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('variabel'),
			);
			
			// render template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 		= "Modul Aturan - Tambah Aturan Fuzzy";
			$data['module'] 	= "aturan"; // module
			$data['aturan'] 	= "aturan"; // controller
			$data['view'] 		= "aturan_tambah"; // view

			if($this->ion_auth->is_admin()) {
				echo Modules::run('template/admin',$data);
			}
			if($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer', $data);
			}
 		}
 	}
 	
 	function update($aturan_id = null)
 	{
 		$aturan_id = (int) $aturan_id;
 		
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			$aturan = $this->aturan_model->get($aturan_id);
 			
 			$this->form_validation->set_rules('variabel', 'Variabel', 'required');
 			$this->form_validation->set_rules('nilai', 'Nilai Value', 'required');
 			$this->form_validation->set_rules('nfuzzy', 'Nilai Fuzzy', 'required');
 		 			
 			if (isset($_POST) && !empty($_POST))
 			{
 				// populate data
 				$data = array(
 							'variabel' => $this->input->post('variabel'),
 							'max'	   => $this->input->post('max'),
 							'min'	   => $this->input->post('min'),	 						
 						);
 				
 				// jika bedul
 				if ($this->form_validation->run() == TRUE &&
 						$this->aturan_model->update($aturan->aturan_id, $data))
 				{
 					$this->session->set_flashdata('message', "<div class=\"alert alert-success\"> <a class=\"close\" data-dismiss=\"alert\">X</a>Aturan Berhasil Diupdate </div>");
 					redirect('aturan/index', 'refresh');
 				}
 			}
 			
 			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
 			
 			$data['variabel'] = array(
 					'name'  => 'variabel',
 					'id'    => 'variabel',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('variabel', $aturan->variabel),
 			);
 			
 			$data['nilai'] = array(
 					'name'  => 'nilai',
 					'id'    => 'nilai',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('nilai', $aturan->nilai),
 			);
 			
 			$data['nfuzzy'] = array(
 					'name'  => 'nfuzzy',
 					'id'    => 'nfuzzy',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('nfuzzy', $aturan->nfuzzy),
 			);
 			
 			// render template
 			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 			$data['title'] 		= "Modul Aturan - Update Aturan Fuzzy";
 			$data['module'] 	= "aturan"; // module
 			$data['aturan'] 	= "aturan"; // controller
 			$data['view'] 		= "aturan_tambah"; // view
 			
 			if($this->ion_auth->is_admin()) {
				echo Modules::run('template/admin',$data);
			}
			if($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer', $data);
			}
 		}
 	}
 	
 	function delete($aturan_id = null)
 	{
 		$aturan_id = (int) $aturan_id;
 		
 		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('aturan/index','Kembali');
 		}
 			
 		/*
 		 * Admin done
 		*/
 		elseif ($this->ion_auth->is_admin()
 				&& $this->aturan_model->delete($aturan_id))
 		{
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Aturan berhasil dihapus!</div>");
 			redirect('aturan/index');
 		}
 		/*
 		 * Manajer done
 		*/
 		elseif ($this->ion_auth->in_group('manajer')
 				&& $this->aturan_model->delete($aturan_id))
 		{
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Aturan berhasil dihapus!</div>");
 		
 			redirect('aturan/index');
 		}
 	}
 }
 
 
 /* End of File: aturan.php */
/* Location: ../www/modules/aturan/aturan.php */ 