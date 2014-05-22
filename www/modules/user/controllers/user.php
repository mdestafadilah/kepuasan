<?php
/***************************************************************************************
 *                       			user.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	user.php
*      Created:   		2013 - 09.40.45 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/
class User extends MX_Controller
{
	/*
	* Class User yang digunakan untuk mengatur seluruh proses CRUD Pengguna Sistem
	* ----------------------------------------------------------------------------
	* Fungsi:
	* 			1. Daftar Seluruh Pengguna
	* 			2. Membuat Pengguna Baru
	* 			3. Mengupdate Pengguna
	* 			4. Menghapus Pengguna
	* 			5. Melihat Pengguna Aktif
	* 			6. Melihat Pengguna Tidak Aktif
	* 			7. Melihat Detail pengguna
	*
	* Original source: - Library ionauth with some modification
	*/

	// Daftar group
	private $groups = array('perawat','konsumen','direktur','manajer');

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->model('user_model');
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		// Enable the output profiler so you can see the db queries run.
		// $this->output->enable_profiler(TRUE);
	}
	
	/*
	 * Ionauth additional support
	 */
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);
	
		return array($key => $value);
	}
	
	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/*
	 * Fungsi untuk menampilkan seluruh pengguna sistem
	*
	* @param @array
	*/
	function index()
	{
		if ($this->ion_auth->is_admin())
		{
			//$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
			// paging
			$this->load->library('pagination');

			$uri_segment = 3;
			$data['offset'] = $this->uri->segment($uri_segment);

			$config['base_url'] = base_url().'user/index/';
			$config['total_rows'] = $this->ion_auth->users()->num_rows();
			$config['per_page'] = 18;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
			$config['cur_tag_close'] = ' </li>';
			
			// I don't know how this work! i found it in ellislab.com sharing forum
			$data['users'] = $this->ion_auth->offset(
							 $this->uri->segment($uri_segment))
									   ->limit($config['per_page'])
									   ->order_by('created_on') //active
								       ->users()
									   ->result();	
			
			//$data['users'] = $this->ion_auth->users()->limit($config['per_page'])->offset($this->uri->segment($uri_segment))->result();
			
			// get user group of
			foreach ($data['users'] as $k => $user)
			{
				// cek groups user
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			// run paging
			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();

			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Modul Pengguna - Daftar Pengguna Sistem";
			$data['admin']  = "admin"; // Controller
			$data['view']   = "user_all"; // View
			$data['module'] = "user"; // Controller

			echo Modules::run('template/admin',$data);

		}else{
			redirect('auth','refresh');
		}
	}
	
	function debuk(){
		
		// get a user not plural.
		// $user = $this->ion_auth->user(10)->row();
		// echo $user->email;
		
		// $config['total_rows'] = $this->ion_auth->users()->num_rows(); // count all user
		// $data['users'] = $this->ion_auth->users()->result(); // list all user
		
		/*
		$data['users'] = $this->ion_auth->users()->result();
		foreach ($data['users'] as $k => $user)
		{
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		*/
		// $data = $this->ion_auth->get_users_groups($user->id)->result();
		// $data = $this->ion_auth->groups()->result();
		// $data = $this->ion_auth->get_users_groups()->result();
			
		//$data = $this->ion_auth->get_inactive_users()->result();
		//dump($data);
		
		// $group_id = 4
		// $groups = $this->ion_auth->group($group_id)->result();
		// dump($group);
		// exit;

		
		
		//$data['groups'] = $this->ion_auth->groups()->row();
		//$data['groups'] = $this->ion_auth->groups()->result();
		//dump($data['groups']);
		
		/*
		// populate group
				$group = array('');
				$groups = $this->ion_auth->groups()->result();
				foreach ($groups as $gr)
				{
					$group[$gr->id] = $gr->name;
				}
				// ----------------
				
				$data['group'] = $group;
		*/
		
		
		
		//$data["group"] = $this->grouplist();
		//dump($data);
		//exit;
		
		/*
		$username = 'Benbenten';
		$password = '12345678';
		$email = '';
		$additional_data = array(
				'first_name' => 'Ben',
				'last_name' => 'Manajer6',
				'address' => 'Jakarta',
				'phone' => '09898989',
				'dob' => '1989-12-12',
				'sex' => 'L',
		);
		$group = array('25'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
		
		$data = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
		*/
		
		// $users = $this->ion_auth->users(array('4','25'))->result();
	 	            
		// $sess_user = $this->session->userdata("user_id");
		
		// $data = $this->user_model->total_sex();
		
		// $data = $this->user_model->active_user()->get_all();
		// $data = $this->user_model->get_many_by('active',0);
		
		/*
				$group = array();
				
				$groups = $this->ion_auth->groups()->result();
				foreach ($groups as $gr)
				{
					$group[] = $gr->name;
				}
		*/
/* 		// populate group
			$group = array();
			$groups = $this->ion_auth->groups()->result();
			foreach ($groups as $gr)
			{
				$group[$gr->id] = $gr->name;
			}
			// ----------------
			$data['group'] = $group;
 */
		// $id = '64';
		// $user = $this->ion_auth->user($id)->row(); // get an object user
		// $groups=$this->ion_auth->groups()->result_array(); // get an array groups
		// $currentGroups = $this->ion_auth->get_users_groups($id)->result(); // get group of user
		$user = $this->user_model->get_all();
	
	
							
		dump($user);
		dump($this->user_model->_database->last_query());
		dump($this->db->insert_id());
		exit;
	}
	
	/*
	 * Get groups in tables
	 * source
	 * http://stackoverflow.com/questions/11098339/add-user-to-groups-when-creating-user-in-ion-auth-using-form-dropdown
	 *  
	 */
	public function grouplist()
	{
		$query = $this->db->get('groups');
	
		foreach ($query->result() as $row)
		{
			$listArray[$row->id] = $row->name;
		}
	
		return $listArray;
	}
	
	/*
	 * Get groups in table/ populate
	 * 
	 * emang_dasar
	 * 
	 */
		/*
		 	// populate group
			$group = array();
			$groups = $this->ion_auth->groups()->result();
			foreach ($groups as $gr)
			{
				$group[$gr->id] = $gr->name;
			}
			// ----------------
			$data['group'] = $group;
		*/
	
	function new_user()
	{
		$data['title'] = "Tambah Pengguna Sebagai Members";
		
		if ($this->ion_auth->is_admin())
		{
			// Profile
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean|alpha');
			$this->form_validation->set_rules('last_name', 'Nama Akhir', 'required|xss_clean|alpha');
			$this->form_validation->set_rules('address', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Nomor Telp.', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required|xss_clean');
			$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|xss_clean');
		
			// Login
			$this->form_validation->set_rules('username', 'Username','required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . 
			$this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . 
			$this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		
			/*
			 * Cek validasi inputan user
			*/
			if ($this->form_validation->run() === true)
			{
				/*
				 * Field utama yang akan di simpan di tabel users
				*/
		
				// This is like user login pages
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
		
				// This is like profile pages
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
				);
					
			}
		
			/*
			 * Lakukan pengecekan regeister
			*/
			if ($this->form_validation->run() == true
					&& $this->ion_auth->register($username, $password, $email, $additional_data))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Admin berhasil ditambahkan!</div>");
				redirect('user/index','refresh');
			}else{
		
					
				//set flashdata untuk kesalahan input jika ada, dan pesan berhasil ditambahkan
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
				//buat array untuk membuat field form
				
				$data['first_name'] = array(
						'type' => 'text',
						'name' => 'first_name',
						'class'=> 'span4',
						'id' => 'first_name',
						'value' => $this->form_validation->set_value('first_name'),
				);
				
				$data['last_name'] = array(
						'type' => 'text',
						'name' => 'last_name',
						'class'=> 'span4',
						'id' => 'last_name',
						'value' => $this->form_validation->set_value('last_name'),
				);
		
				$data['address'] = array(
						'name' => 'address',
						'id' => 'address',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('address'),
				);
				
				$data['phone'] = array(
						'type' => 'text',
						'name' => 'phone',
						'class'=> 'input-medium',
						'id' => 'phone',
						'value' => $this->form_validation->set_value('phone'),
				);
		
				$data['dob'] = array(
						'type' => 'text',
						'name' => 'dob',
						'class'=> 'input-medium',
						'id'  => 'dp2',	
						'value' => $this->form_validation->set_value('dob'),
				);
				$data['sex'] = array(
						'name' => 'sex',
						'id' => 'sex',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('sex'),
				);
					
				$data['username'] = array(
						'type' => 'text',
						'name' => 'username',
						'class'=> 'span4',
						'id' => 'username',	
						'value' => $this->form_validation->set_value('username'),
				);
				$data['email'] = array(
						'type' => 'text',
						'name' => 'email',
						'class'=> 'span4',
						'id' => 'email',
						'value' => $this->form_validation->set_value('email'),
				);
		
				$data['password'] = array(
						'type' => 'password',
						'name' => 'password',
						'class'=> 'span4',
						'id' => 'password',
						'value' => $this->form_validation->set_value('password'),
				);
				$data['password_confirm'] = array(
						'type' => 'password',
						'name' => 'password_confirm',
						'class'=> 'span4',
						'id' => 'password_confirm',
						'value' => $this->form_validation->set_value('password_confirm'),
				);
					
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title']   = "Module Admin - Tambah Admin Pengguna";
				$data['user']    = "user"; // Controller
				$data['view']    = "user_new"; // View
				$data['module']  = "user"; // Controller
		
				echo Modules::run('template/admin',$data);
			}
		}else{
			echo 'You don\'t have an access';
		}
	}
	
	/*
	 * Fungsi ini digunakan untuk membuat admin baru
	* secara default, fungsi ini ada juga di module ionauth
	*
	* Jika user berhasil dibuat, maka akan diarahkan ke profile/ update user page
	*
	*/
	function new_admin()
	{
		$data['title'] = "Tambah Administrator";
	
		if ($this->ion_auth->is_admin())
		{
			// Profile
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Nama Akhir', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Nomor Telp.', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required|xss_clean');
			$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|xss_clean');
	
			// Login
			$this->form_validation->set_rules('username', 'Username','required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
	
			/*
			 * Cek validasi inputan user
			*/
			if ($this->form_validation->run() === true)
			{
				/*
				 * Field utama yang akan di simpan di tabel users
				*/
	
				// This is like user login pages
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$group = array('1'); // admin default
	
				// This is like profile pages
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
				);
					
			}
	
			/*
			 * Lakukan pengecekan regeister
			*/
			if ($this->form_validation->run() === true
					&& $this->ion_auth->register($username, $password, $email, $additional_data, $group))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Admin berhasil ditambahkan!</div>");
				redirect('user/index','refresh');
			}else{
	
					
				//set flashdata untuk kesalahan input jika ada, dan pesan berhasil ditambahkan
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
	
				//buat array untuk membuat field form
	
				$data['first_name'] = array(
						'name' => 'first_name',
						'id' => 'first_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('first_name'),
				);
				$data['last_name'] = array(
						'name' => 'last_name',
						'id' => 'last_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('last_name'),
				);
	
				$data['address'] = array(
						'name' => 'address',
						'id' => 'address',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('address'),
				);
	
				$data['phone'] = array(
						'name' => 'phone',
						'id' => 'phone',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('phone'),
				);
	
				$data['dob'] = array(
						'name' => 'dob',
						'id' => 'dob',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('dob'),
				);
				$data['sex'] = array(
						'name' => 'sex',
						'id' => 'sex',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('sex'),
				);
					
				$data['username'] = array(
						'name' => 'username',
						'id' => 'username',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Username Yang Unik',
						'value' => $this->form_validation->set_value('username'),
				);
				$data['email'] = array(
						'name' => 'email',
						'id' => 'email',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Alamat Email Yang Valid',
						'value' => $this->form_validation->set_value('email'),
				);
	
				$data['password'] = array(
						'name' => 'password',
						'id' => 'password',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Masukkan Password Yang Valid',
						'value' => $this->form_validation->set_value('password'),
				);
				$data['password_confirm'] = array(
						'name' => 'password_confirm',
						'id' => 'password_confirm',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Ulangi Password',
						'value' => $this->form_validation->set_value('password_confirm'),
				);
					
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title']   = "Module Admin - Tambah Admin Pengguna";
				$data['user']    = "user"; // Controller
				$data['view']    = "user_admin"; // View
				$data['module']  = "user"; // Controller
	
				echo Modules::run('template/admin',$data);
			}
		}else{
			echo 'You don\'t have an access';
		}
	}

	/*
	 * Fungsi ini digunakan untuk membuat direktur baru
	* secara default, fungsi ini ada juga di module ionauth
	*
	* Jika user berhasil dibuat, maka akan diarahkan ke profile/ update user page
	*
	*/
	function new_direktur()
	{
		$data['title'] = "Tambah Direktur";
	
		if ($this->ion_auth->is_admin())
		{
			// Profile
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Nama Akhir', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Nomor Telp.', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required|xss_clean');
			$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|xss_clean');
	
			// Login
			$this->form_validation->set_rules('username', 'Username','required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
	
			/*
			 * Cek validasi inputan user
			*/
			if ($this->form_validation->run() === true)
			{
				/*
				 * Field utama yang akan di simpan di tabel users
				*/
	
				// This is like user login pages
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$group = array('6'); // direktur default
	
				// This is like profile pages
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
				);
					
			}
	
			/*
			 * Lakukan pengecekan regeister
			*/
			if ($this->form_validation->run() === true
					&& $this->ion_auth->register($username, $password, $email, $additional_data, $group))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Direktur berhasil ditambahkan!</div>");
				redirect('user/index','refresh');
			}else{
	
					
				//set flashdata untuk kesalahan input jika ada, dan pesan berhasil ditambahkan
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
	
				//buat array untuk membuat field form
	
				$data['first_name'] = array(
						'name' => 'first_name',
						'id' => 'first_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('first_name'),
				);
				$data['last_name'] = array(
						'name' => 'last_name',
						'id' => 'last_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('last_name'),
				);
	
				$data['address'] = array(
						'name' => 'address',
						'id' => 'address',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('address'),
				);
	
				$data['phone'] = array(
						'name' => 'phone',
						'id' => 'phone',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('phone'),
				);
	
				$data['dob'] = array(
						'name' => 'dob',
						'id' => 'dob',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('dob'),
				);
				$data['sex'] = array(
						'name' => 'sex',
						'id' => 'sex',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('sex'),
				);
					
				$data['username'] = array(
						'name' => 'username',
						'id' => 'username',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Username Yang Unik',
						'value' => $this->form_validation->set_value('username'),
				);
				$data['email'] = array(
						'name' => 'email',
						'id' => 'email',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Alamat Email Yang Valid',
						'value' => $this->form_validation->set_value('email'),
				);
	
				$data['password'] = array(
						'name' => 'password',
						'id' => 'password',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Masukkan Password Yang Valid',
						'value' => $this->form_validation->set_value('password'),
				);
				$data['password_confirm'] = array(
						'name' => 'password_confirm',
						'id' => 'password_confirm',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Ulangi Password',
						'value' => $this->form_validation->set_value('password_confirm'),
				);
					
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title']   = "Module Admin - Tambah Direktur Pengguna";
				$data['user']    = "user"; // Controller
				$data['view']    = "user_direktur"; // View
				$data['module']  = "user"; // Controller
	
				echo Modules::run('template/admin',$data);
			}
		}else{
			echo 'You don\'t have an access';
		}
	}
	
	/*
	 * Fungsi ini digunakan untuk membuat manajer baru
	 * secara default, fungsi ini ada juga di module ionauth
	 * 
	 * Jika user berhasil dibuat, maka akan diarahkan ke profile/ update user page
	 *
	 */
	function new_manajer()
	{
		$data['title'] = "Tambah Manajer";
		
		if ($this->ion_auth->is_admin())
		{
			// Profile
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Nama Akhir', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Alamat', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Nomor Telp.', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required|xss_clean');
			$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|xss_clean');
				
			// Login
			$this->form_validation->set_rules('username', 'Username','required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');

			/*
			 * Cek validasi inputan user
			*/
			if ($this->form_validation->run() === true)
			{
				/*
				 * Field utama yang akan di simpan di tabel users
				*/
				
				// This is like user login pages
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$group = array('25');
				
				// This is like profile pages
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
				);	
			
			}

			/*
			 * Lakukan pengecekan regeister
			*/
			if ($this->form_validation->run() === true
				&& $this->ion_auth->register($username, $password, $email, $additional_data, $group))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Manajer berhasil ditambahkan!</div>");
				redirect('user/index','refresh');
			}else{
				
			
				//set flashdata untuk kesalahan input jika ada, dan pesan berhasil ditambahkan
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
								
				//buat array untuk membuat field form
				
				$data['first_name'] = array(
						'name' => 'first_name',
						'id' => 'first_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('first_name'),
				);
				$data['last_name'] = array(
						'name' => 'last_name',
						'id' => 'last_name',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('last_name'),
				);
				
				$data['address'] = array(
						'name' => 'address',
						'id' => 'address',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('address'),
				);
				
				$data['phone'] = array(
						'name' => 'phone',
						'id' => 'phone',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('phone'),
				);
				
				$data['dob'] = array(
						'name' => 'dob',
						'id' => 'dob',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('dob'),
				);
				$data['sex'] = array(
						'name' => 'sex',
						'id' => 'sex',
						'type' => 'text',
						'class' => 'ttip_t',
						'value' => $this->form_validation->set_value('sex'),
				);
			
				$data['username'] = array(
						'name' => 'username',
						'id' => 'username',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Username Yang Unik',
						'value' => $this->form_validation->set_value('username'),
				);
				$data['email'] = array(
						'name' => 'email',
						'id' => 'email',
						'type' => 'text',
						'class' => 'ttip_t',
						'title' => 'Masukan Alamat Email Yang Valid',
						'value' => $this->form_validation->set_value('email'),
				);

				$data['password'] = array(
						'name' => 'password',
						'id' => 'password',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Masukkan Password Yang Valid',
						'value' => $this->form_validation->set_value('password'),
				);
				$data['password_confirm'] = array(
						'name' => 'password_confirm',
						'id' => 'password_confirm',
						'type' => 'password',
						'class' => 'ttip_t',
						'title' => 'Ulangi Password',
						'value' => $this->form_validation->set_value('password_confirm'),
				);
													
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title']   = "Module Admin - Tambah Manajer Pengguna";
				$data['user']    = "user"; // Controller
				$data['view']    = "user_manajer"; // View
				$data['module']  = "user"; // Controller

				echo Modules::run('template/admin',$data);
			}
		}else{
			echo 'You don\'t have an access';
		}
	}

	/*
	 * Fungsi ini digunakan untuk menghapus user/ perawat/ pelanggan
	*
	* @param array id
	*/
	function hapus_user($id = null)
	{
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer')) 
		{
			echo 'You don\'t have an access';
		}
		/*
		 * Admin done
		 */
		elseif ($this->ion_auth->is_admin()
					&& $this->ion_auth->delete_user($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pengguna berhasil dihapus!</div>");
			redirect('user/index');
		}
		/*
		 * Manajer done
		 */
		elseif ($this->ion_auth->in_group('manajer')
					&& $this->ion_auth->delete_user($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pengguna berhasil dihapus!</div>");
			redirect('pelanggan/index');
		}
	}
	
 	/*
	 * Fungsi ini digunakan untuk mengubah/ update users
	 * original from: ionauth
	 */
	function edit_user($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;
		
		$data['title'] = "Edit Pengguna";
			
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user', 'refresh');
		}
		
		$user = $this->ion_auth->user($id)->row();
		
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			// and make me errorrrss
			/* if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			} 
			*/
				
			// validasi inputan
			$data = array(
					'username' => $this->input->post('username'),
					'email'  => $this->input->post('email'),
			);
			
			//Update the groups user belongs to
			$groupData = $this->input->post('groups');
			
			if (isset($groupData) && !empty($groupData)) {
			
				$this->ion_auth->remove_from_group('', $id);
			
				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id);
				}
			
			}
					
			if ($this->form_validation->run() == TRUE && $this->ion_auth->update($user->id, $data))
			{ 
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('user', 'refresh');
			}
		}
		$data['csrf'] = $this->_get_csrf_nonce();
		
		$data['users'] = $this->ion_auth->users()->result();
	
		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['single'] = $user;
		$data['groups'] = $groups;
		$data['currentGroups'] = $currentGroups;

		$data['username'] = array(
				'name' => 'username',
				'id'   => 'username',
				'type' => 'username'
		);
		
		$data['email'] = array(
				'name' => 'email',
				'id'   => 'email',
				'type' => 'email'
		);
	
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Admin - Update Pengguna";
		$data['admin']  = "admin"; // Controller
		$data['view']   = "user_edit"; // View
		$data['module'] = "user"; // Controller
		echo Modules::run('template/admin',$data);
	}
	
	function detail_user($id)
	{
		// no funny id
		$id = (int) $id;

		// get id of direktur default
		$this->load->model('group/group_model');
		$data['direktur'] = $this->group_model->get_many_by(array('id'=>6));
		
		if (!$this->ion_auth->logged_in() || ($this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			// if true
			$data['user'] = $this->ion_auth->user($id)->row();
			
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Admin - Detail Pengguna";
			$data['admin']  = "admin"; // Controller
			$data['view']   = "detail"; // View
			$data['module'] = "user"; // Controller
			echo Modules::run('template/admin',$data);
		}
		else
		{
			show_404("Error Page Detail");
		}
	}

	
	/*
	 * Fungsi ini digunakan untuk melihat user yang aktif
	*/
	function aktif()
	{
	if ($this->ion_auth->is_admin())
		{
			//$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
			// paging
			$this->load->library('pagination');
		
			$uri_segment = 4;
			$data['offset'] = $this->uri->segment($uri_segment);
		
			$config['base_url'] = base_url().'user/aktif/index';
			$config['total_rows'] = $this->user_model->count_by('active',1);
			$config['per_page'] = 30;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
			$config['cur_tag_close'] = ' </li>';
			
			// get active user
			// $data = $this->ion_auth->get_inactive_users()->result();
			// $data['users'] = $this->ion_auth->offset($this->uri->segment($uri_segment))->limit($config['per_page'])->get_active_users()->result();
			// $data['users'] = $this->ion_auth->users()->limit($config['per_page'])->offset($this->uri->segment($uri_segment))->result();
			$data['users'] = $this->user_model->get_many_by('active',1);
			
			// get user group of
			foreach ($data['users'] as $k => $user)
			{
				// cek groups user
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
		
			// run paging
			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();
		
			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Admin - Pengguna Aktif";
			$data['admin']  = "admin"; // Controller
			$data['view']   = "user_all"; // View
			$data['module'] = "user"; // Controller
		
			echo Modules::run('template/admin',$data);
		
		}else{
			redirect('auth','refresh');
		}
	}
	
	/*
	 * Fungsi ini digunakan untuk melihat user yang tidak aktif
	*/
	function nonaktif()
	{
		if ($this->ion_auth->is_admin())
		{
			//$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
			// paging
			$this->load->library('pagination');
		
			$uri_segment = 4;
			$data['offset'] = $this->uri->segment($uri_segment);
		
			$config['base_url'] = base_url().'user/nonaktif/index';
			//$config['total_rows'] = $this->ion_auth->users()->num_rows();
			$config['total_rows'] = $this->user_model->count_by('active',0);
			$config['per_page'] = 5;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
			$config['cur_tag_close'] = ' </li>';
			
			// get inactive kueri
			// $data = $this->ion_auth->get_inactive_users()->result();
			// $data['users'] = $this->ion_auth->offset($this->uri->segment($uri_segment))->limit($config['per_page'])->get_inactive_users()->result();
			// $data['users'] = $this->ion_auth->users()->limit($config['per_page'])->offset($this->uri->segment($uri_segment))->result();
			
			$data['users'] = $this->user_model->get_many_by('active',0);
			
			// get user group of
			foreach ($data['users'] as $k => $user)
			{
				// cek groups user
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
		
			// run paging
			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();
		
			// render Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Admin - Pengguna Non-Aktif";
			$data['admin']  = "admin"; // Controller
			$data['view']   = "user_all"; // View
			$data['module'] = "user"; // Controller
		
			echo Modules::run('template/admin',$data);
		
		}else{
			redirect('auth','refresh');
		}
	}
	
	function add_to_admin()
	{
		// $id = (int) $id;
		
		// get group object
		$this->load->model('group/group_model','gr');
		$group = $this->gr->get_by(array('id'=>1));
		
		echo $group->name;

		// get user object
		$user = $this->ion_auth->user()->row();
		echo $user->id;
		
		exit;
	}
	
	function add_to_perawat()
	{
		// $id = (int) $id;
		
		// get group object
		$this->load->model('group/group_model','gr');
		$group = $this->gr->get_by(array('id'=>4));
		
		echo $group->name;
		// get user object
		$user = $this->ion_auth->user()->row();
		echo $user->id;
	}
	
	function add_to_konsumen()
	{
		// $id = (int) $id;
		
		// get group object
		$this->load->model('group/group_model','gr');
		$group = $this->gr->get_by(array('id'=>3));
		
		echo $group->name;
		// get user object
		$user = $this->ion_auth->user()->row();
		echo $user->id;
	}
	
	function add_to_direktur()
	{
		// $id = (int) $id;
		
		// get group object
		$this->load->model('group/group_model','gr');
		$group = $this->gr->get_by(array('id'=>6));
		
		echo $group->name;
		// get user object
		$user = $this->ion_auth->user()->row();
		echo $user->id;
	}
	
	/*
	 * source: http://melciorseisura.blogspot.com/2012/06/searching-sederhana-dengan-codeigniter.html
	 * ---
	 */
	function search()
	{
		// get an array
		$data['users']  = $this->user_model
									->searching()
									->as_array() // optional, can use as_object?? really
									->get_by(array(
											'username' => $this->input->post('cari'),
												)
											);
		
		if ($data['users'] == null)
		{
			echo "Data yang dimasukan salah!";
			echo br(2);
			echo anchor('user/index', 'kembali');
		}
		else
		{
						
		dump($data['users']);
		exit;
		
			// Render Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Admin - Daftar Pengguna Sistem";
			$data['admin']  = "admin"; // Controller
			$data['view']   = "user_all"; // View
			$data['module'] = "user"; // Controller

			echo Modules::run('template/admin',$data);
				
		}
	}
}


/* End of File: user.php */
/* Location: ../www/modules/user/user.php */