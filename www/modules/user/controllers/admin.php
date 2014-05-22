<?php
/***************************************************************************************
 *                       			admin.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	admin.php
 *      Created:   		2012 - 12.26.00 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
class Admin extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','session','pagination','form_validation'));
		$this->load->helper(array('url', 'form'));
		// Profiler
		// $this->output->enable_profiler(TRUE);
		$this->load->model(array('widget/widgetmodel','user/user_model','soal/soal_model','pelanggan/pelanggan_model','user/rawatkonsumen_model','perawat/perawat_model'));
	}

	function index()
	{
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin())
		{
			$data['total_pengguna'] = $this->ion_auth->users()->num_rows();
			$data['total_perawat'] = $this->ion_auth->users('4')->num_rows();
			$data['total_konsumen'] = $this->ion_auth->users('3')->num_rows();
			$data['total_manajer'] = $this->ion_auth->users('25')->num_rows();
			$data['total_direktur'] = $this->ion_auth->users('6')->num_rows();
			$data['total_members'] = $this->ion_auth->users('26')->num_rows();
			$data['total_soal'] 	= $this->soal_model->count_by('publish','1');
			$data['total_online'] = $this->widgetmodel->getGuestOnline();
				
			$data['welcome']= ucfirst($this->session->userdata('email'));
			$data['title'] 	= "Welcome to CRM - DSS Application";
			$data['module'] = "home"; // Controller MODUL
			$data['admin'] 	= "admin"; // Controller AKSES
			$data['view'] 	= "home_admin"; // View MODUL
										
			echo Modules::run('template/admin',$data);
			//$this->load->view('user/admin',$data);
		}else{
			redirect('auth/index/', 'refresh');
		}	
	}
	
	//---------------------------------------------------------------------------------------------------
	function awal()
	{
		
	}
	//----------------------------------------------------------------------------------------------------
	
	/*
	 * create a new user
	 * fungsi create_user yang sama seperti di ion_auth, hanya ada perubahan dikit
	 * 
	 */
	function newUser()
	{
		$data['title'] = "Tambah Pengguna";
	
		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('phone1', 'First Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'xss_clean|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('company', 'Company Name', 'xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
	
			$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone1'),
			);
		}
		if ($this->form_validation->run() == true && 
			$this->ion_auth->register($username, $password, $email, $additional_data, $this->input->post('group')))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', "Pengguna Telah Ditambahkan");
			redirect("user/admin");
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
						
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors(): $this->session->flashdata('message')));
		
			
			$data['first_name'] = array(
					'name'  => 'first_name',
					'id'    => 'first_name',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('first_name'),
			);
			$data['last_name'] = array(
					'name'  => 'last_name',
					'id'    => 'last_name',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('last_name'),
			);
			$data['email'] = array(
					'name'  => 'email',
					'id'    => 'email',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('email'),
			);
			$data['company'] = array(
					'name'  => 'company',
					'id'    => 'company',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('company'),
			);
			$data['phone1'] = array(
					'name'  => 'phone1',
					'id'    => 'phone1',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('phone1'),
			);
			$data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'type'  => 'password',
					'value' => $this->form_validation->set_value('password'),
			);
			$data['password_confirm'] = array(
					'name'  => 'password_confirm',
					'id'    => 'password_confirm',
					'type'  => 'password',
					'value' => $this->form_validation->set_value('password_confirm'),
			);
			
			$data['welcome']= "Welcome back ". ucfirst($this->session->userdata('email'));
			$data['title'] 	= "Module Pengguna Sistem";
			$data['auth'] 	= "auth"; 		// Controller
			$data['view'] 	= "create_user"; 	// View
			$data['module'] = "auth"; 		// Controller
	
			echo Modules::run('template/admin',$data);
		}
	}
}
 
 
 /* End of File: admin.php */
/* Location: ../www/modules/admin.php */ 