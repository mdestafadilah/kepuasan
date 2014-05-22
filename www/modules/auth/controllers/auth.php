<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {
	
	/* Simple Auth with Ion Auth Library
	 * Author: Much. D. Fadilah
	 * modification from controller auth.php from original resource https://github.com/benedmunds/CodeIgniter-Ion-Auth
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session','ion_auth','form_validation'));
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}
	
	/* BERIKUT FUNGSI-FUNGSI UNTUK MENAMPILKAN HALAMAN
	 * - function index() untuk menampilkan halaman beranda
	 * - function login() untuk menampilkan halaman login
	 * - function forgot_password() untuk menampilkan halaman form lupa password
	 * - function change_password() untuk mengubah password masuk ke sistem
	 * - function admin() untuk menampilkan halaman dengan role user
	 * - function konsumen() untuk menampilkan halaman dengan role administrator
	 * - function 
	 */

	//redirect if needed, otherwise display the user list
	function index()
	{
	if ($this->ion_auth->logged_in())
		{
			/*
			 * setting groups yang ada di tabel
			 * require settings: config/routes.php
			 */
			if ($this->ion_auth->is_admin()){
				redirect('user/admin','refresh');
			}elseif ($this->ion_auth->in_group('direktur')){
				redirect('user/direktur','refresh');
			}elseif ($this->ion_auth->in_group('manajer')){
				redirect('user/manajer','refresh');
			}elseif ($this->ion_auth->in_group('konsumen')){
				redirect('user/konsumen','refresh');
			}elseif ($this->ion_auth->in_group('perawat')){
				redirect('user/perawat','refresh');
			}elseif ($this->ion_auth->in_group('members')){
				redirect('auth/members','refresh');
			}
		}
		else
		{
			redirect('auth/login','refresh');
			/*
			$data['login'] = "login";
			$data['view'] = "login";
			$data['module'] = "auth";
			$data['message'] = "";
			echo Modules::run('template/login',$data);
			*/
		}
	}
	
	function members()
	{
		echo "STATUS AKUN ANDA NON-AKTIF/ BELUM AKTIVASI";
		echo br(2);
		echo "Segera lakukan pendaftaran ulang ke Bagian Elderly Information";
		echo br(1);
		echo anchor('auth/logout','Kembali');
	}

	//log the user in
	function login()
	{
		$data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{ 
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{ 
				//if the login is successful, redirect them back to the home page
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-login">'.$this->ion_auth->messages().'</div>');
				redirect('auth', 'refresh');
			}
			else
			{ 
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-login">'.$this->ion_auth->errors().'</div>');
				
				//use redirects instead of loading views for compatibility with MY_Controller libraries
				redirect('auth/login', 'refresh'); 
			
			}
		}
		else
		{  
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);
			
			// Buat Template
			$data['login'] = "auth";
			$data['view'] = "login";
			$data['module'] = "auth";
			
			// Load Template->view(login)
			echo Modules::run('template/login',$data);
			//$this->load->view('auth/login', $data);
		}
	}

	//log the user out
	function logout()
	{
		$data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message','<div class="alert alert-info alert-login">'.$this->ion_auth->messages().'</div>');
		redirect('auth/login', 'refresh');
	}	

	//change password
	function change_password()
	{
		// form validation rules
		$this->form_validation->set_rules('old','Password Lama', 'required');
		$this->form_validation->set_rules('new', 'Password Baru', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');
		
		// jika tidak ada login
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		// populate user ke objek
		$user = $this->ion_auth->user()->row();
		
		// jika validasi salah
		if ($this->form_validation->run() == false)
		{ 
			// display the form
			// set the flash data error message if there is one
			
			// $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['message'] = (validation_errors()) ? '<div class="alert alert-info">'.validation_errors().'</div>' : $this->session->flashdata('message');		
			// $this->session->set_flashdata('message', '<div class="alert alert-info alert-login">'.$this->ion_auth->messages().'</div>');
				
			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Authentikasi - Ubah Password";
			$data['auth']  = "auth"; // Controller
			$data['view']   = "change_password"; // View
			$data['module'] = "auth"; // Controller
			
			/*
			 * Run Template Module
			 *
			 * @param boolean
			 * @array admin || manajer || direktur || perawat || pelanggan
			 */
			
				if ($this->ion_auth->is_admin()){
					echo Modules::run('template/admin',$data);
				}
				elseif ($this->ion_auth->in_group('direktur')){
					echo Modules::run('template/direktur',$data);
				}
				elseif ($this->ion_auth->in_group('perawat')){
					echo Modules::run('template/perawat',$data);
				}
				elseif ($this->ion_auth->in_group('konsumen')){
					echo Modules::run('template/konsumen', $data);
				}
				else{ 
					echo Modules::run('template/manajer',$data);
			}
		}
		else
		{
			// Jika validasi benar
			
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
			
			// Jika ada perubahan arahkan ke halaman terentu
			if ($change)
			{ 
				//if the password was successfully changed
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-login">'.$this->ion_auth->messages().'</div>');
				// arahkan langsung keluar
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert">'. $this->ion_auth->errors().'</div>');
				redirect('auth/change_password', 'refresh');
			}
		}
	}
	
	function change_profile()
	{
		$data['title'] = "Edit Profile";
			
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		
		$user = $this->ion_auth->user()->row();
				
		if (isset($_POST) && !empty($_POST))
		{
			// validasi inputan
			$data = array(
					'username' => $this->input->post('username'),
					'email'  => $this->input->post('email'),
			);
				
			if ($this->form_validation->run() == TRUE 
					&& $this->ion_auth->update($user->id, $data))
			{
		
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Data sudah terupdate! </div>");
				redirect('user', 'refresh');
			}
		}
						
		//set the flash data error message if there is one
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
		
			// render
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Pengguna - Change Login Information";
			$data['auth']  = "auth"; // Controller
			$data['view']   = "change_profile"; // View
			$data['module'] = "auth"; // Controller
			
			/*
			 * Run Template Module
			 *
			 * @param boolean
			 * @array admin || manajer || direktur || perawat || pelanggan
			 */
			
				if ($this->ion_auth->is_admin()){
					echo Modules::run('template/admin',$data);
				}
				elseif ($this->ion_auth->in_group('direktur')){
					echo Modules::run('template/direktur',$data);
				}
				elseif ($this->ion_auth->in_group('perawat')){
					echo Modules::run('template/perawat',$data);
				}
				elseif ($this->ion_auth->in_group('konsumen')){
					echo Modules::run('template/konsumen', $data);
				}
				else{ 
					echo Modules::run('template/manajer',$data);
			}
	}

	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("user", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		
		$id = (int) $id;
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->user($id)->row();
			
			// render
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Deactivate User";
			$data['auth']  = "auth"; // Controller
			$data['view']   = "deactivate_user"; // View
			$data['module'] = "auth"; // Controller
			
			echo Modules::run('template/admin', $data);
					
			//$this->load->view('auth/deactivate_user', $data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{				
					show_error('This form post did not pass our security checks.');
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('user/nonaktif/', 'refresh');
		}
	}
	
	/* ION Auth Heart
	 * --------------
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

}
