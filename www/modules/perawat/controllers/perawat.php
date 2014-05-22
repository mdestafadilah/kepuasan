<?php
/***************************************************************************************
 *                       			perawat.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	perawat.php
 *      Created:   		2013 - 13.12.55 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Perawat extends MX_Controller
 {
 	// jangan lupa fungsi searching
 	
 	var $data = array();
 	var $gallerypath;
 	var $gallerypath_ori;
 	
 	private $groups = array('manajer','direktur');
 	private $limit = 5;
	
 	/*
 	 * Modul Data Perawat seluruh informasi para perawat PT. Narendra Krida.
 	 * 
 	 * - Tambah data perawat
 	 * - Edit data perawat
 	 * - Hapus data perawat
 	 * 
 	 */
 	function __construct(){
 		parent::__construct();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->helper(array('form','url'));
		$this->load->model(array('user/user_model','user/rawatkonsumen_model','perawat_model'));
		
		// Enable the output profiler so you can see the db queries run.
		// $this->output->enable_profiler(TRUE);
		
		// Initialize
		$this->messages = array();
		$this->errors = array();
		
		// Upload Poto
		$this->potopath = realpath(APPPATH . '../poto');
		$this->potopath_ori = base_url().'assets/poto';
		
		// Upload Poto
		$this->potopath = realpath(APPPATH . '../ijasah');
		$this->potopath_ori = base_url().'assets/ijasah';
 	}
 	
 	function debuk()
 	{
 		
 						$session = $this->session->userdata();
 		dump($session);
 	}
 	 		
 	function index()
 	{
 		$this->_manage();
 	}
 	
 	/*
 	 * Menampilkan dalam bentuk tabel (CRUD) Function
 	 */
 	function  _manage()
 	{
 	if ($this->ion_auth->in_group(array('manajer','direktur') || $this->ion_auth->is_admin()))
		{
			//$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
			// paging
			$this->load->library('pagination');

			$uri_segment = 3;
			$data['offset'] = $this->uri->segment($uri_segment);
			$config['base_url'] = base_url().'perawat/index/';
			$config['total_rows'] = $this->ion_auth->users('4')->num_rows();
			$config['per_page'] = 10;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
			$config['cur_tag_close'] = ' </li>';
			
			// get user dengan level perawat, id perawat 4
			$data['hasil'] = $this->ion_auth->offset($this->uri->segment($uri_segment))->limit($config['per_page'])->users('4')->result();

			// run paging
			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();

			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Perawat - Daftar Perawat";
			$data['perawat']  = "perawat"; // Controller
			$data['view']   = "perawat_view"; // View
			$data['module'] = "perawat"; // Controller

			/*
			 * Run Template Module
			*
			* @param boolean
			* @array admin || manajer || direktur
			*/
			if ($this->ion_auth->is_admin()){
				echo Modules::run('template/admin',$data);
			}elseif ($this->ion_auth->in_group('direktur')){
				echo Modules::run('template/direktur',$data);
			}else{ echo Modules::run('template/manajer',$data);
			}
			}else{
				redirect(base_url().'auth/index', 'refresh');
		}
 	}
 	
 	/*
 	 * Fungsi menambah data perawat/ user dengan level sebagai perawat
 	 * ---
 	 * :)
 	 */
 	function add()
 	{
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$this->form_validation->set_rules('first_name', 'Nama Depan','required|xss_clean|alpha|min_length[5]');
			$this->form_validation->set_rules('last_name', 'Nama Belakang','required|xss_clean|alpha');
			$this->form_validation->set_rules('address', 'Alamat','required');
			$this->form_validation->set_rules('phone', 'Telephone','xss_clean');
			$this->form_validation->set_rules('dob', 'Tanggal Lahir','xss_clean');
			$this->form_validation->set_rules('sex', 'Jenis Kelamin');
			$this->form_validation->set_rules('elderly', 'Jenis Rawat','required');
					
			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('first_name');
				$password = '12345678'; // default
				$email = ''; 			// default null
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
						'elderly' => $this->input->post('elderly'),
						'active' => '0',
				);
				// default group perawat
				$group = array('4');
			}
			
			if ($this->form_validation->run() == true 
					&& $this->ion_auth->register($username, $password, $email, $additional_data, $group))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Perawat berhasil ditambahkan!</div>");
				redirect('perawat/add','refresh');
			}
			else
			{
				// repopoulate user id
			
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
			
				// Render Template
				$data['welcome'] 	= ucfirst($this->session->userdata('email'));
				$data['title'] 		= "Module Perawat - Tambah Perawat";
				$data['perawat'] 	= "perawat"; // Controller
				$data['view'] 		= "perawat_form"; // View
				$data['module'] 	= "perawat"; // Controller
					
				// Load Template->view(login)
				if($this->ion_auth->is_admin()){
					echo Modules::run('template/admin',$data);
				}
				elseif ($this->ion_auth->in_group('manajer')) {
					echo Modules::run('template/manajer',$data);
				}
				else 
				{ 
					echo 'You have not access';
				}
			}
		}
		
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo "You don't have access";
			echo br(2);
		}
			
 	}
 	 	
	function edit($id=null) 
	{
		// no funny business, force to integer
		$id = (int) $id;
		
		$data['title'] = "Edit Perawat";
		
		// still errurr, i don't know
		/*
		if (!$this->ion_auth->logged_in())
		{
			redirect('perawat', 'refresh');
		}
		
		if (!$this->ion_auth->in_group('manajer') || !$this->ion_auth->is_admin())
		{
			redirect('perawat', 'refresh');
		}
		*/
		
		$user = $this->ion_auth->user($id)->row();
		//personal
		$this->form_validation->set_rules('first_name', 'Nama Depan','required|xss_clean|alpha|min_length[5]');
		$this->form_validation->set_rules('last_name', 'Nama Belakang','required|xss_clean|alpha');
		$this->form_validation->set_rules('address', 'Alamat','required');
		$this->form_validation->set_rules('phone', 'Telephone', 'required');
		$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('elderly', 'Merawat', 'required');
		// login
		$this->form_validation->set_rules('new', 'Password Baru', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
						
		if (isset($_POST) && !empty($_POST))
		{
			// validasi inputan
			$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'address'    => $this->input->post('address'),
					'phone'      => $this->input->post('phone'),
					'dob'        => $this->input->post('dob'),
					'sex'        => $this->input->post('sex'),
					'elderly'    => $this->input->post('elderly'),
					'password'	 => $this->input->post('password'),
			);
				
			if ($this->form_validation->run() == TRUE 
					&& $this->ion_auth->update($user->id, $data))
			{
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('perawat', 'refresh');
			}
		}
		
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
		//populate the user to the view
		$data['single'] = $user;
		
		$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
		
		$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			
		$data['first_name'] = array(
				'name' => 'first_name',
				'id'   => 'first_name',
				'type' => 'first_name'
		);
		$data['last_name'] = array(
				'name' => 'last_name',
				'id'   => 'last_name',
				'type' => 'last_name'
		);
		$data['address'] = array(
				'name' => 'address',
				'id'   => 'address',
				'type' => 'address'
		);
		$data['phone'] = array(
				'name' => 'phone',
				'id'   => 'phone',
				'type' => 'phone'
		);
		$data['dob'] = array(
				'name' => 'dob',
				'id'   => 'dob',
				'type' => 'dob'
		);
		$data['sex'] = array(
				'name' => 'sex',
				'id'   => 'sex',
				'type' => 'sex'
		);
		$data['elderly'] = array(
				'name' => 'elderly',
				'id'   => 'elderly',
				'type' => 'elderly'
		);
		
		// Render template
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Admin - Update Perawat";
		$data['perawat']  = "perawat"; // Controller
		$data['view']   = "perawat_edit"; // View
		$data['module'] = "perawat"; // Controller
		
		// Load Template->view()
		if($this->ion_auth->is_admin()){
			echo Modules::run('template/admin',$data);
		}
		elseif ($this->ion_auth->in_group('manajer')) {
			echo Modules::run('template/manajer',$data);
		}
		else 
		{ 
			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('home', 'Kembali');
		}
	}
	
	function hapus($id= null) 
	{
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo 'Sorry your level is not have an access';
 			echo br(2);
 			echo anchor('home', 'Kembali');
		}
		/*
		 * Admin done
		*/
		elseif ($this->ion_auth->is_admin()
				&& $this->ion_auth->delete_user($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Perawat berhasil dihapus!</div>");
			redirect('perawat/index');
		}
		/*
		 * Manajer done
		*/
		elseif ($this->ion_auth->in_group('manajer')
				&& $this->ion_auth->delete_user($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Perawat berhasil dihapus!</div>");
			redirect('perawat/index');
		}
	}
	
	function detail($id) 
	{
		// no funnys
		$id = (int) $id;
		
		// Pengecekan role user
		if ($this->ion_auth->is_admin() || $this->ion_auth->logged_in() && $this->ion_auth->in_group(array('direktur','manajer')))
		{
			// Populate data
			// $data['rawat'] = $this->perawat->get($perawat_id);
			$data['user'] = $this->ion_auth->user($id)->row();
			$data['grup'] = $this->ion_auth->group($id)->row();
			
			// Render Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] 	 = "Module Perawat - Detail Perawat";
			$data['perawat'] = "perawat"; // Controller
			$data['view'] 	 = "perawat_detil"; // View
			$data['module']  = "perawat"; // Controller
				
			// Load Template->view(login)
			if($this->ion_auth->is_admin()){
				echo Modules::run('template/admin',$data);
			}
			elseif ($this->ion_auth->in_group('manajer')) {
				echo Modules::run('template/manajer',$data);
			}
			elseif ($this->ion_auth->in_group('direktur')) {
				echo Modules::run('template/direktur',$data);
			}
			else { echo 'You have not access';
			}
				
		}
		else //apabila belum login
		{
			show_404();
		}
	}
	
	/*
	 * Mencari data perawat
	 * -------
	 * UN-TESTED
	 * -------
	 * TESTED IN MODULE SEARCH!!
	 * 
	 */	
	function search()
	{
		// get an array
		$data['perawat']  = $this->user_model
										->searching_perawat()
										->as_array() // optional, can use as_object?? really
										->get_by(array(
												'first_name' => $this->input->post('cari'),
										));
	
		if ($data['perawat'] == null)
		{
			echo "Data yang dimasukan salah!";
			echo br(2);
			echo anchor('perawat/index', 'kembali');
		}
		else
		{
		
			dump($data['perawat']);
			exit;
		}
	}
	
	/*
	 * Fungsi update profile perawat
	* ---
	* @param $id $perawat_id
	* @void return
	*/
	function add_profile()
	{
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$this->form_validation->set_rules('foto', 'Foto','required');
			$this->form_validation->set_rules('ijasah', 'Ijasah','required');
			$this->form_validation->set_rules('user_id', 'User Login','required');
			
			if ($this->form_validation->run() == true)
			{
				// Populate
				$data = array(
						'foto' => $this->input->post('foto'),
						'ijasah' => $this->input->post('ijasah'),
						'user_id' => $this->input->post('user_id'),					
						);
			}
			
			if ($this->form_validation->run() == true
					&& $this->perawat_model->insert($data))
			{
				//dump($_POST);exit;
				$this->session->set_flashdata('message', 'Profile Perawat Berhasil Ditambahkan');
				redirect('perawat/index','refresh');
			}
			else
			{
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				
				$data['foto'] = array(
						'name'  => 'foto',
						'id'    => 'foto',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('foto'),
				);
				
				$data['ijasah'] = array(
						'name'  => 'ijasah',
						'id'    => 'ijasah',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('ijasah'),
				);
				
				$data['user_id'] = array(
						'name'  => 'user_id',
						'id'    => 'user_id',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('user_id'),
				);
				
				// render template
				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title'] = "Modul Perawat - Tambah Profile Data Perawat";
				$data['module'] = "perawat"; // module
				$data['perawat'] = "perawat"; // controller
				$data['view'] = "perawat_add_profile"; // view
					
				if($this->ion_auth->is_admin()) {
					echo Modules::run('template/admin',$data);
				}
				if($this->ion_auth->in_group('manajer')) {
					echo Modules::run('template/manajer', $data);
				}
			}
		}
		else
		{
			echo 'You don\'t have an access';
			echo br(2);
			echo anchor('auth/login', 'Login');
		}
	}
	
 	
 	/*
 	 * From Davidconnelly.com
 	 */
	
 	/*
 	function get($order_by){
 		$this->load->model('m_perawat');
 		$query = $this->m_perawat->get($order_by);
 		return $query;
 	}
 	
 	function get_with_limit($limit, $offset, $order_by) {
 		$this->load->model('m_perawat');
 		$query = $this->m_perawat->get_with_limit($limit, $offset, $order_by);
 		return $query;
 	}
 	
 	function get_where($id){
 		$this->load->model('m_perawat');
 		$query = $this->m_perawat->get_where($id);
 		return $query;
 	}
 	
 	function get_where_custom($col, $value) {
 		$this->load->model('m_perawat');
 		$query = $this->m_perawat->get_where_custom($col, $value);
 		return $query;
 	}
 	
 	function _insert($data){
 		$this->load->model('m_perawat');
 		$this->m_perawat->_insert($data);
 	}
 	
 	function _update($id, $data){
 		$this->load->model('m_perawat');
 		$this->m_perawat->_update($id, $data);
 	}
 	
 	function _delete($id){
 		$this->load->model('m_perawat');
 		$this->m_perawat->_delete($id);
 	}
 	
 	function count_where($column, $value) {
 		$this->load->model('m_perawat');
 		$count = $this->m_perawat->count_where($column, $value);
 		return $count;
 	}
 	
 	function get_max() {
 		$this->load->model('m_perawat');
 		$max_id = $this->m_perawat->get_max();
 		return $max_id;
 	}
 	
 	function _custom_query($mysql_query) {
 		$this->load->model('m_perawat');
 		$query = $this->m_perawat->_custom_query($mysql_query);
 		return $query;
 	}
 	
 	*/
 
 }
 
 
 /* End of File: perawat.php */
/* Location: ../www/modules/perawat/perawat.php */ 