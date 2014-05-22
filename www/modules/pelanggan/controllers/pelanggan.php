<?php
/***************************************************************************************
 *                       			pelanggan.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	pelanggan.php
*      Created:   		2013 - 21.06.52 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/

class Pelanggan extends MX_Controller
{
	private $groups = array('direktur','manajer');
	private $limit = 5;

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper(array('form','file','url'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->model(array('user/user_model','user/rawatkonsumen_model','pelanggan_model'));
		
		// Enable the output profiler so you can see the db queries run.
		// $this->output->enable_profiler(TRUE);

	}
	
	function index()
	{
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group($this->groups))
		{
			$this->_manage();
		}
		else
		{
			echo "Resctricted area";
			echo br(2);
			echo anchor('home','Kembali');
		}
	}
	
	/*
	 * Fungsi untuk menmbahkan data pelanggan
	 * ------
	 * @access public
	 * @params
	 * 
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
			
			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('first_name');
				$password = '12345678'; // default password
				$email = ''; // default email
				$additional_data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'sex' => $this->input->post('sex'),
				);
				// default group pelanggan
				$group = array('3');
			}
				
			if ($this->form_validation->run() == true
					&& $this->ion_auth->register($username, $password, $email, $additional_data, $group))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pelanggan berhasil ditambahkan!</div>");
				redirect('pelanggan/add','refresh');
			}
			else
			{
				// repopoulate user id
					
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
					
				// Buat Template
				$data['welcome'] 	= ucfirst($this->session->userdata('email'));
				$data['title'] 	 	= "Module Pelanggan - Tambah Pelanggan";
				$data['pelanggan']  = "pelanggan"; // Controller
				$data['view'] 		= "pelanggan_form"; // View
				$data['module'] 	= "pelanggan"; // Controller
					
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
		
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo 'You don\'t have an access';
			echo br(2);
			echo anchor('auth/login', 'Login');
		}
	}

	/*
	 * Fungsi Mengatur CRUD Pelanggan
	 * ------
	 * @access private
	 * @params 
	 * 
	*/
	function _manage()
	{
	if ($this->ion_auth->in_group(array('manajer','direktur') || $this->ion_auth->is_admin()))
		{
			//$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
			// paging
			$this->load->library('pagination');

			$uri_segment = 3;
			$data['offset'] = $this->uri->segment($uri_segment);
			$config['base_url'] = base_url().'pelanggan/index/';
			$config['total_rows'] = $this->ion_auth->users('3')->num_rows();
			$config['per_page'] = 10;
			$config['next_link'] = '<li>Selanjutnya</li>';
			$config['prev_link'] = '<li>Sebelumnya</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
			$config['cur_tag_close'] = ' </li>';
			
			// get user dengan level perawat, id pelanggan 3
			$data['hasil'] = $this->ion_auth->offset($this->uri->segment($uri_segment))->limit($config['per_page'])->users('3')->result();

			// run paging
			$this->pagination->initialize($config);
			$data['paging'] = $this->pagination->create_links();
			
			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Pelanggan - Daftar Pelanggan";
			$data['pelanggan']  = "pelanggan"; // Controller
			$data['view']   = "pelanggan_view"; // View
			$data['module'] = "pelanggan"; // Controller
			
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
	* Fungsi untuk menghapus
	* -------
	* @param id
	* @acces public
	*/
	function hapus($id=null)
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
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pelanggan berhasil dihapus!</div>");
			redirect('pelanggan/index');
		}
		/*
		 * Manajer done
		*/
		elseif ($this->ion_auth->in_group('manajer')
				&& $this->ion_auth->delete_user($id))
		{
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pelanggan berhasil dihapus!</div>");
			redirect('pelanggan/index');
		}
	}

	/*
	* Fungsi untuk melihat details
	* ------
	* @access public
	* @params
	* 
	*/
	function detail($id = NULL)
	{
		// no funnys
		$id = (int) $id;
		
		// Pengecekan role user
		if ($this->ion_auth->is_admin() || $this->ion_auth->logged_in() && $this->ion_auth->in_group(array('manajer','direktur')))
		{
			// Populate data
			// $data['rawat'] = $this->perawat->get($perawat_id);
			$data['user'] = $this->ion_auth->user($id)->row();
			$data['grup'] = $this->ion_auth->group($id)->row();
			
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
		
			// Render Template
			$data['welcome']  = ucfirst($this->session->userdata('email'));
			$data['title'] 	  = "Module Pelanggan - Detail Pelanggan";
			$data['pelanggan'] = "pelanggan"; // Controller
			$data['view'] 	 = "pelanggan_detil"; // View
			$data['module']  = "pelanggan"; // Controller
		
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
	 * Fungsi untuk mengubah data pelanggan
	 * ------
	 * @access public
	 * @params id
	 * 
	 */
	function edit($id = null)
	{
		$id = (int) $id;
		
		$data['title'] = "Edit Pelanggan";
		
		$user = $this->ion_auth->user($id)->row();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'Nama Depan','required|xss_clean|alpha|min_length[5]');
		$this->form_validation->set_rules('last_name', 'Nama Belakang','required|xss_clean|alpha');
		$this->form_validation->set_rules('address', 'Alamat', 'required');
		$this->form_validation->set_rules('phone', 'Telephone', 'required');
		$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required');
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
					'password'	 => $this->input->post('password'),
						
			);
		
			if ($this->form_validation->run() == TRUE && $this->ion_auth->update($user->id, $data))
			{
		
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('pelanggan', 'refresh');
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
			
		// Render template
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Pelanggan - Update Pelanggan";
		$data['pelanggan']  = "pelanggan"; // Controller
		$data['view']   = "pelanggan_edit"; // View
		$data['module'] = "pelanggan"; // Controller
		
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
	
	/*
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
		)
		);
		
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
	 * Fungsi untuk update data profile 
	 * -----
	 * STILL DEVELOPMENT!!
	 * 
	 */
	function add_profile($id = null)
	{
		$id = (int) $id;
		
		$data['title'] = "Update Profile";
				
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
				
			$this->form_validation->set_rules('foto', 'Foto','required');
			$this->form_validation->set_rules('user_id', 'User Login','required');
			
			$foto = $_FILES['userfile']['name'];
				
			if ($this->form_validation->run() == true && !empty($foto))
			{
				$config = array(
						'allowed_types' => 'jpg|jpeg|gif|png|bmp',
						'upload_path' => $CI->gallerypath
				);
				$CI->load->library('upload',$config);
				$CI->upload->do_upload();
				$datafile = $CI->upload->data();
				
				$config = array(
						'source_image' => $datafile['full_path'],
						'new_image'   => $this->gallerypath .'/thumbnails',
						'maintain_ration' => TRUE,
						'width' =>  160,
						'height' => 120
				);
				
				$CI->load->library('image_lib', $config);
				$CI->image_lib->resize();
				
				// Populate			
				$data = array(
						'foto' => $this->input->post('foto'),
						'user_id' => $this->input->post('user_id'),
				);
			}
				
			if ($this->form_validation->run() == true
					&& $this->pelanggan_model->insert($data))
			{
				//dump($_POST);exit;
				$this->session->set_flashdata('message', 'Profile Perawat Berhasil Ditambahkan');
				redirect('pelanggan/index','refresh');
			}
			else
			{
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		
				$data['single'] = $this->ion_auth->user($id)->row();
				
				$data['foto'] = array(
						'name'  => 'foto',
						'id'    => 'foto',
						'type'  => 'text',
						'value' => $userfile,
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
				$data['title'] = "Modul Pelanggan - Tambah Profile Data Perawat";
				$data['module'] = "pelanggan"; // module
				$data['pelanggan'] = "pelanggan"; // controller
				$data['view'] = "pelanggan_add_profile"; // view
					
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
}


/* End of File: pelanggan.php */
/* Location: ../www/modules/pelanggan/pelanggan.php */
