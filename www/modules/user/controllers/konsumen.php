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
class Konsumen extends MX_Controller
{
	private $groups = 'konsumen';
	
	function __construct()
	{
		parent::__construct();
		$data = array();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper(array('url', 'form'));
	}

	function index()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($this->groups))
		{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			
			// Buat Template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 		= "Dashboard Panel";
			$data['module'] 	= "home"; // Controller module
			$data['konsumen'] 	= "konsumen"; // Controller file
			$data['view'] 		= "home_konsumen"; // View module
				
			// Load Template->view(login)
			echo Modules::run('template/konsumen',$data);
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
			$data['pasangan']= $this->db->query("
					SELECT
					rawat.id,
					userkonsumen.username AS `nama_konsumen`,
					userkonsumen.address AS `alamat_konsumen`,
					userkonsumen.email AS `email_konsumen`,
					userkonsumen.first_name AS `nama_depan_kon`,
					userkonsumen.last_name AS `nama_belakang_kon`,
					userkonsumen.active AS `aktif_konsumen`,
					userperawat.username AS `nama_perawat`,
					userperawat.elderly AS `jenis_rawat`,
					userperawat.address AS `alamat_peawat`,
					userperawat.email AS `email_perawat`,
					userperawat.phone AS `telpon_perawat`,
					userperawat.active AS `aktif_perawat`
					FROM
					rawatkonsumen AS rawat
					INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
					INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
						
					WHERE
					userkonsumen.id = $id
											
					")->row();
			
		echo $data['pasangan']->nama_konsumen;
	}
	
	function profile()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($this->groups))
		{
				
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				
			$data['user'] = $this->ion_auth->user()->row();
			$data['grup'] = $this->ion_auth->group()->row();
			
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
			
			/* 	$data['users'] = $this->ion_auth->users()->result();
			
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			} */
	
			// render Template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title']   	= "Profile Pelanggan";
			$data['pelanggan'] 	= "pelanggan"; // Controller
			$data['view']    	= "pelanggan_detil"; // View
			$data['module']  	= "pelanggan"; // Controller
	
			echo Modules::run('template/konsumen',$data);
	
		}
		else //apabila belum login
		{
			show_404();
		}
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
				redirect('user/konsumen/ubah_profile', 'refresh');
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
		$data['title']  = "Module Konsumen - Ubah Profile Konsumen";
		$data['pelanggan']  = "pelanggan"; // Controller
		$data['view']   = "pelanggan_update"; // View
		$data['module'] = "pelanggan"; // Controller
		echo Modules::run('template/konsumen',$data);
		
	}
}
 
 
 /* End of File: konsumen.php */
/* Location: ../www/modules/user/konsumen.php */ 