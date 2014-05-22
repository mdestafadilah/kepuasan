<?php
/***************************************************************************************
 *                       			perawat.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	perawat.php
*      Created:   		2012 - 12.35.07 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/
class Perawat extends MX_Controller
{
	private $groups = 'perawat';

	function __construct()
	{
		parent::__construct();
		$data = array();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('url', 'form'));
	}

	/*
	 * Fungsi untuk redirect default dengan level perawat
	 * ------
	 * @access
	 * @params 
	 * 
	 */
	function index()
	{

		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('perawat'))
		{
			// Get Detail Konsumen
			$data['user'] = $this->ion_auth->user()->row();
			$id = $data['user']->id;
			$pasangan = $this->db->query("
												SELECT
												rawat.id,
												userkonsumen.jawaban AS `jawaban`
												FROM
												rawatkonsumen AS rawat
												INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
												INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
										
												WHERE
												userperawat.id = $id
													
												")->row();
			
			$jawab = $pasangan->jawaban;
			
			// notif
			$data['notifikasi'] = ($jawab == TRUE) ? "<i class='splashy-check'></i>" : "<i class='splashy-remove'></i>";;

			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
				
			// render template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] 	 = "Welcome to Sistem Informasi Kepuasan Pelanggan";
			$data['perawat'] = "perawat"; // Controller
			$data['view'] = "home_perawat"; // View
			$data['module'] = "home"; // Controller

			echo Modules::run('template/perawat',$data);

		}
		else //apabila belum login
		{
			show_404();
		}
	}

	function profile()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($this->groups))
		{
				
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				
			$data['user'] = $this->ion_auth->user()->row();
			$data['grup'] = $this->ion_auth->group()->row();
				
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			// render Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']   = "Profile Perawat";
			$data['perawat'] = "perawat"; // Controller
			$data['view']    = "perawat_detil"; // View
			$data['module']  = "perawat"; // Controller

			echo Modules::run('template/perawat',$data);

		}
		else //apabila belum login
		{
			show_404();
		}
	}

	function debuk()
	{
		$data['user'] = $this->ion_auth->user()->row();
			$id = $data['user']->id;
			$pasangan = $this->db->query("
												SELECT
												rawat.id,
												userkonsumen.jawaban AS `jawaban`
												FROM
												rawatkonsumen AS rawat
												INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
												INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
										
												WHERE
												userperawat.id = $id
													
												")->row();
			
			$jawab = $pasangan->jawaban;
			
			echo $jawab;
	}

	function ubah_profile()
	{
		$data['title'] = "Update Profile";
			
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|alpha');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Nama Belakang', 'alpha');
		$this->form_validation->set_rules('address', 'Alamat Tinggal', 'required');
		$this->form_validation->set_rules('phone', 'Telephone', 'required');
		$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required');

		// Get one user
		$user = $this->ion_auth->user()->row();
		
		// Lakukan cek form
		if (isset($_POST) && !empty($_POST))
		{
			// validasi inputan
			$data = array(
					'username' => $this->input->post('username'),
					'email'  => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'dob' => $this->input->post('dob'),
					'sex' => $this->input->post('sex'),
			);
			// Jika betul, lakukan proses update
			if ($this->form_validation->run() == TRUE
					&& $this->ion_auth->update($user->id, $data))
			{

				//check to see if we are creating the user
				//redirect them back to the profile page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('user/perawat/ubah_profile', 'refresh');
			}
		}
		
		// Populate data
		
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$data['username'] = array(
				'name' => 'username',
				'id'   => 'username',
				'type' => 'username',
				'class'=> 'span4',
				'value' => $user->username,

		);
		
		$data['email'] = array(
				'name' => 'email',
				'id'   => 'email',
				'type' => 'email',
				'class'=> 'span4',
				'value' => $user->email,
		);
		
		$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
		);
		
		$data['first_name'] = array(
				'name' => 'first_name',
				'id'   => 'first_name',
				'type' => 'first_name',
				'value'=> $user->first_name,
		);
		
		$data['last_name'] = array(
				'name' => 'last_name',
				'id'   => 'last_name',
				'type' => 'last_name',
				'value'=> $user->last_name,

		);
		
		$data['address'] = array(
				'name' => 'address',
				'id'   => 'address',
				'type' => 'address',
				'value'=> $user->address,

		);
		
		$data['phone'] = array(
				'name' => 'phone',
				'id'   => 'phone',
				'type' => 'phone',
				'value'=> $user->phone,

		);
		
		$data['dob'] = array(
				'name' => 'dob',
				'id'   => 'dob',
				'type' => 'dob',
				'value'=> $user->dob,

		);
		
		$data['sex'] = array(
				'name' => 'sex',
				'id'   => 'sex',
				'type' => 'sex',
				'value'=> $user->sex,

		);
		
		$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
		);

		// render
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Perawat - Ubah Profile Perawat";
		$data['perawat']  = "perawat"; // Controller
		$data['view']   = "perawat_update"; // View
		$data['module'] = "perawat"; // Controller
		echo Modules::run('template/perawat',$data);

	}

	function  penilaian()
	{

	}
}


/* End of File: perawat.php */
/* Location: ../www/modules/user/perawat.php */