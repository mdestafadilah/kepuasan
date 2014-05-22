<?php
/***************************************************************************************
 *                       			group.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	group.php
 *      Created:   		2013 - 09.35.45 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Group extends MX_Controller
 {
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper('url');
		$this->load->model('group_model');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}
	
 	function index()
 	{
 		if (!$this->ion_auth->is_admin())
 		{
 			redirect('auth', 'refresh');
 		}
 		
 		$data['message'] = $this->session->flashdata('message');
 			
 		// paging
 		$this->load->library('pagination');
 		
 		$uri_segment = 3;
 		$data['offset'] = $this->uri->segment($uri_segment);
 		
 		$config['base_url'] = base_url().'group/index';
 		$config['total_rows'] = $this->ion_auth->groups()->num_rows(); // for paging
 		$config['per_page'] = 6;
 		$config['next_link'] = '<li>Selanjutnya</li>';
 		$config['prev_link'] = '<li>Sebelumnya</li>';
 		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> Page - ';
 		$config['cur_tag_close'] = '</li> ';
 		
 		$data['groups'] = $this->ion_auth->offset($this->uri->segment($uri_segment))->limit($config['per_page'])->groups()->result();
 		
 		// load paging
 		$this->pagination->initialize($config);
 		$data["paging"] = $this->pagination->create_links();
 			
 		
 		// call other module
 		$data['welcome'] = ucfirst($this->session->userdata('email'));
 		$data['title'] 	 = "Module Pengguna Sistem";
 		$data['auth'] 	 = "group"; 		// Controller
 		$data['view'] 	 = "listgroup"; 	// View
 		$data['module']  = "group"; 		// Controller
 			
 		echo Modules::run('template/admin',$data);
 	}
 	
 	/*
 	 * Method untuk menambah level/ group pengguna
 	 * 
 	 */
 	function add()
 	{
 		$data['title'] = "Tambah Group";
	
		if (!$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		
		// Setting Form
		$this->form_validation->set_rules('name', 'Nama Level', 'required|alpha');
		$this->form_validation->set_rules('description', 'Penjelasan', 'required|alpha_numeric');
		
		if ($this->form_validation->run() == true)
		{
			// cek passing valuenya
			$name = $this->input->post('name');
			$description = $this->input->post('description');
		}
		
		if ($this->form_validation->run() == true 
				&& $this->ion_auth->create_group($name, $description))
		{
			// jika berhasil arahkan ke tabel group
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Level Pengguna berhasil ditambahkan!</div>");
			redirect(base_url().'group', 'refresh');
		}
		else
		{	
			// Pesan errur kalo inputnya kurang, dan berhasil jika berhasil
			$data['message'] =  (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : 
								($this->ion_auth->errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.$this->ion_auth->errors().'</div>' : $this->session->flashdata('message')));
			
			$data['name'] = array(
					'name'  => 'name',
					'id'    => 'name',
					'type'  => 'name',
					'value' => $this->form_validation->set_value('name'),
			);
				
			$data['description'] = array(
					'name'  => 'description',
					'id'    => 'txtarea_limit_chars',
					'type'  => 'description',
					'value' => $this->form_validation->set_value('description'),
			);
			
			// render template
			$data['welcome'] = "Welcome back ". ucfirst($this->session->userdata('email'));
			$data['title'] 	 = "Module Pengguna Sistem";
			$data['group'] 	 = "group"; 		// Controller
			$data['view'] 	 = "newgroup"; 	// View
			$data['module']  = "group"; 		// Controller
			
			echo Modules::run('template/admin',$data);	
		}
 	}
 	
 	/*
 	 * Method untuk menghapus group
 	 */
 	function delete($id)
 	{
 		$data['title'] = "Hapus Group";
 		
 		if(!$this->ion_auth->is_admin())
 		{
 			redirect(base_url().'group');
 		}
 		
 		// pass the right arguments and it's done
 		$group_delete = $this->ion_auth->delete_group($id);
 		
 		if(!$group_delete)
 		{
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors(): $this->session->flashdata('message')));
 		}
 		else
 		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Level Pengguna berhasil dihapus!</div>");
 			redirect(base_url('group'),$data);
 		}
 	}
 	
 	/*
 	 * Method mengupdate group
 	 * 
 	 */
 	public function edit($id = NULL)
 	{
 		
 		$id = (int) $id;
		
		$data['title'] = "Edit Level";
			
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('group', 'refresh');
		}
		
		$group = $this->ion_auth->group($id)->row();
		
 		// setting validasi
 		$this->form_validation->set_rules('name', 'Nama Level', 'required');
 		$this->form_validation->set_rules('description', 'Penjelasan', 'required');
 		
 		if (isset($_POST) && !empty($_POST))
 		{
 			// validasi inputan
 			$data = array(
 					'name' => $this->input->post('name'),
 					'description' => $this->input->post('description'),
 			);
 			
 			if ($this->form_validation->run() == TRUE 
 					&& $this->group_model->update($group->id, $data))
 				
 			{
 				
 				//check to see if we are creating the user
 				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Group sudah terupdate! </div>");
 				redirect('group', 'refresh');
 			}
 		}
 		
 			// Pesan errur kalo inputnya kurang
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors(): $this->session->flashdata('message')));
 			
 			// pass group to view
 			$data['group'] = $group;
 			
 			$data['name'] = array(
 					'name'  => 'name',
 					'id'    => 'name',
 					'type'  => 'name',
 			);
 				
 			$data['description'] = array(
 					'name'  => 'description',
 					'id'    => 'description',
 					'type'  => 'description',
 			);
 			
 			// call other module
	 		$data['welcome'] = ucfirst($this->session->userdata('email'));
	 		$data['title'] 	 = "Module Admin - Update Level Pengguna";
	 		$data['admin'] 	 = "admin"; 		// Controller
	 		$data['view'] 	 = "editgroup"; 	// View
	 		$data['module']  = "group"; 		// Controller
	 			
	 		echo Modules::run('template/admin',$data);
 		}
 	}
 
 /* End of File: group.php */
/* Location: ../www/modules/group.php */ 