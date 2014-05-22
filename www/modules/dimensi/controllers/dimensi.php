<?php
/***************************************************************************************
 *                       			dimensi.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	dimensi.php
*      Created:   		2013 - 11.30.54 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/

class Dimensi extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->model('dimensi_model');
	}

	function debuk()
	{
		$data['results'] = $this->dimensi_model->get_options()->get_all();
			
		dump($data['results']); exit;
	}

	function index()
	{
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			// paging
			$this->load->library('pagination');

			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));

			$uri_segment = 3;
			$data['offset'] = $this->uri->segment($uri_segment);

			$config['base_url'] = base_url().'dimensi/index/';
			$config['total_rows'] = $this->dimensi_model->count_all();
			$config['per_page'] = 10;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
			$config['cur_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();

			$data['limit'] = $config['per_page'];
			$data['results'] = $this->dimensi_model
			->as_array()
			->limit($data['limit'], $data['offset'])
			->get_all();

			// render template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 		= "Modul Dimensi - Daftar Dimensi/ Variabel";
			$data['module'] 	= "dimensi"; // module
			$data['dimensi'] 	= "dimensi"; // controller
			$data['view'] 		= "dimensi_view"; // view
				
			if($this->ion_auth->is_admin()) {
				echo Modules::run('template/admin',$data);
			}
			if($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer', $data);
			}
		}
		else
		{
			echo 'You not have access';
			echo br(2);
			echo anchor('auth/login','Kembali');
		}
	}
	
	/*
	 * Fungsi menambahkan data dimensi
	 * ------
	 * 
	 */
	function add()
	{
		if ($this->ion_auth->is_admin())
		{
			// berikan aturan, haaa
			$this->form_validation->set_rules('nama','Nama','required|xss_clean|alpha');
			$this->form_validation->set_rules('keterangan','Keterangan','required|xss_clean');
		}
			
		if ($this->form_validation->run() == true)
		{
			$data = array(
					'nama' => $this->input->post('nama'),
					'keterangan' => $this->input->post('keterangan'),
			);
		}
		if ($this->form_validation->run() == true
				&& $this->dimensi_model->insert($data))
		{
			//dump($_POST);exit;
			$this->session->set_flashdata('message', "<div class=\"alert alert-success\"> <a class=\"close\" data-dismiss=\"alert\">X</a>Dimensi Berhasil Ditambahkan </div>");
			redirect('dimensi/index','refresh');
		}
		else
		{
			// populate data
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"> <a class="close" data-dismiss="alert">X</a>'. validation_errors().'</div>' : $this->session->flashdata('message'));
				
			$data['nama'] = array(
					'name'  => 'nama',
					'id'    => 'nama',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('nama'),
			);
				
			$data['keterangan'] = array(
					'name'  => 'keterangan',
					'id'    => 'keterangan',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('keterangan'),
			);
				
			// render template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 		= "Modul Dimensi - Tambah Dimensi/ Variabel";
			$data['module'] 	= "dimensi"; // module
			$data['dimensi'] 	= "dimensi"; // controller
			$data['view'] 		= "dimensi_form"; // view

			if($this->ion_auth->is_admin()) {
				echo Modules::run('template/admin',$data);
			}
			if($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer', $data);
			}
		}
	}

	/*
	 * Fungsi mengupdate data dimensi
	 * ------
	 * 
	 */
	function update($dimensi_id=null)
	{
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$dimensi = $this->dimensi_model
									->as_array()
									->get($dimensi_id); // an array of dimensi
			
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
			
			if (isset($_POST) && !empty($_POST))
			{
				$data = array(
						'nama' => $this->input->post('nama'),
						'keterangan' => $this->input->post('keterangan'),
				);
				
				// jika bedul
				if ($this->form_validation->run() == TRUE &&
						$this->dimensi_model->update($dimensi->dimensi_id, $data))
				{
					$this->session->set_flashdata('message', "<div class=\"alert alert-success\"> <a class=\"close\" data-dismiss=\"alert\">X</a>Dimensi Berhasil Diupdate </div>");
					redirect('dimensi/index', 'refresh');
				}
			}
			
			$data['results'] = $dimensi;
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['nama'] = array(
					'name'  => 'nama',
					'id'    => 'nama',
					'type'  => 'text',
					'value' => $dimensi['nama'],
			);
			
			$data['keterangan'] = array(
					'name'  => 'keterangan',
					'id'    => 'keterangan',
					'type'  => 'text',
					'value' => $dimensi['keterangan'],
			);
			// render template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 		= "Modul Dimensi - Tambah Dimensi/ Variabel";
			$data['module'] 	= "dimensi"; // module
			$data['dimensi'] 	= "dimensi"; // controller
			$data['view'] 		= "dimensi_form"; // view
			
			if($this->ion_auth->is_admin()) {
				echo Modules::run('template/admin',$data);
			}
			if($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer', $data);
			}
		}
	}

	/*
	 * Fungsi untuk menghapus data dimensi
	 * ------
	 * 
	 */
	function delete($dimensi_id)
	{
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo 'You don\'t have an access';
			echo br(2);
			echo anchor('dimensi/index','Kembali');
		}
			
		/*
		 * Admin done
		*/
		elseif ($this->ion_auth->is_admin()
				&& $this->dimensi_model->delete($dimensi_id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Dimensi berhasil dihapus!</div>");
			redirect('dimensi/index');
		}
		/*
		 * Manajer done
		*/
		elseif ($this->ion_auth->in_group('manajer')
				&& $this->dimensi_model->delete($dimensi_id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Dimensi berhasil dihapus!</div>");
				
			redirect('dimensi/index');
		}
	}
	
	/*
	 * Untested!
	 * 
	 */
	function search()
	{
		// get an array
		$data['dimensi']  = $this->dimensi_model
								->searching()
								->as_array() // optional, can use as_object?? really
								->get_by(array(
										'variabel' => $this->input->post('cari'),
								)
								);
		
		if ($data['dimensi'] == null)
		{
			echo "Data yang dimasukan salah!";
			echo br(2);
			echo anchor('dimensi/index', 'kembali');
		}
		else
		{
		
			dump($data['dimensi']);
			exit;
		
			// Render Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Dimensi - Pencarian Dimensi";
			$data['dimensi']  = "dimensi"; // Controller
			$data['view']   = "dimensi_all"; // View
			$data['module'] = "dimensi"; // Controller
		
			echo Modules::run('template/admin',$data);
		
		}
	}


}

/* End of File: dimensi.php */
/* Location: ../www/modules/dimensi.php */