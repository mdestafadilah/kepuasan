<?php
/***************************************************************************************
 *                       			temp.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	temp.php
 *      Created:   		2013 - 19.07.45 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
function add()
{
	$username = $this->input->post('first_name');
	$password = '12345678';
	$email = '';
	$additional_data = array(
			'first_name' => 'Perawat',
			'last_name' => 'Manajer6',
			'address' => 'Jakarta',
			'phone' => '09898989',
			'dob' => '1989-12-12',
			'sex' => 'L',
	);
	$group = array('25'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
		
	$data = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
		
	if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
	{
		$this->form_validation->set_rules('first_name', 'Nama Depan','required');
		$this->form_validation->set_rules('last_name', 'Nama Belakang','required');
		$this->form_validation->set_rules('address', 'Alamat');
		$this->form_validation->set_rules('phone', 'Telephone');
		$this->form_validation->set_rules('dob', 'Tanggal Lahir');
		$this->form_validation->set_rules('sex', 'Jenis Kelamin');
			
		if ($this->form_validation->run() == true)
		{
			$config['upload_path'] = './assets/poto/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);

			$config['upload_path'] = $this->gallerypath; // naro file ini tuh
			$config['allowed_types'] = 'gif|jpg|png';

			$CI=&get_instance();

			$CI->load->library('upload', $config);
			$CI->upload->do_upload();
			$datafile = $CI->upload->data();

			// Configurasi Prosess Images
			// Man : /user_2.1.3/libraries/image_lib.html
			$config = array(
					'source_image' => $datafile['full_path'],
					'new_image'   => $this->gallerypath .'/thumbnails',
					'maintain_ration' => TRUE,
					'width' =>  160,
					'height' => 120
			);

			$CI->load->library('image_lib',$config);
			$CI->image_lib->resize();


			$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'foto' => $this->input->post('foto'),
					'jenkel' => $this->input->post('jenkel'),
					'dob' => $this->input->post('dob'),
					'ijasah' => $this->input->post('ijasah'),
					'jenis' => $this->input->post('jenis'),
					'alamat' => $this->input->post('alamat'),
					'user_id' => $this->input->post('user_id'),
			);
		}
			
		if ($this->form_validation->run() == true && $this->perawat->insert($data, true))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Perawat berhasil ditambahkan!</div>");
			redirect('perawat/add','refresh');
		}
		else
		{
			// repopoulate user id
				
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
				
			// Buat Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] = "Module Perawat - Tambah Pengguna";
			$data['perawat'] = "perawat"; // Controller
			$data['view'] = "perawat_form"; // View
			$data['module'] = "perawat"; // Controller
				
			// Load Template->view(login)
			if($this->ion_auth->is_admin()){
				echo Modules::run('template/admin',$data);
			}
			elseif ($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer',$data);
			}
			else { echo 'You have not access';
			}
		}
	}
}
 
 
 /* End of File: temp.php */
/* Location: ../www/modules/temp.php */ 