<?php
/***************************************************************************************
 *                       			soal.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	soal.php
 *      Created:   		2013 - 18.22.30 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Soal extends MX_Controller 
 {
 	function __construct() {
 		parent::__construct();
 		$this->load->library(array('ion_auth','session','form_validation'));
 		$this->load->helper('url');
 		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 		// load some model
 		$this->load->model(array(
 				'soal_model','dimensi/dimensi_model',
 				'user/user_model',
 				'jawaban/jawaban_model',
 				'aturan/aturan_model'));
 			
 		// Enable Profiler
 		// $this->output->enable_profiler(TRUE);
 	}
 	
 	function debuk()
 	{
 		$banksoal_id = 2;
 		/* $res = $this->db->select_min('banksoal_id')
				 		->get_where('banksoal', "banksoal_id > $banksoal_id")
				 		->result_array(); */
 		/* $res = $this->db->query("SELECT MIN(`banksoal_id`) AS banksoal_id
								FROM (`banksoal`)
								WHERE `banksoal_id` > $banksoal_id AND publish = 1;")->row(); */
 		
 		//$soal = $this->soal_model->as_array()->get_many_by(array('publish' => 0,'banksoal_id' => "$banksoal_id"));
 		
 		/* $atur = $this->aturan_model->as_array()->get_all();
 			
 		 	$pilihan = array();
			foreach ($atur as $ar)
				{
					$pilihan[$ar['aturan_id']] = $ar['variabel'];
				}		
			
			for ($i=0; $i < count($atur); $i++)
			{
				echo $atur['3']['aturan_id'];
			} */
		
 		// $maxsoal = $this->soal_model->count_by('publish','1');
		$user_id = 73;
 		$cekjawaban = $this->user_model->get_by('id',$user_id);
 		$jawaban_isi =  $cekjawaban->jawaban;
 		$maksimal_jawab = 10;
 		
 		if ($jawaban_isi == 0 || $jawaban_isi != $maksimal_jawab)
 		{
 			echo "silahkan jawab lagi";
 			echo "Jawaban sementara " . $jawaban_isi;
 			
 		}elseif ($jawaban_isi != 0)
 		{
 			echo "anda sudah menjawab";
 			echo "Jawaban sementara " . $jawaban_isi;
 		}
	dump($cekjawaban);
 		
 		dump($this->db->last_query());
 		exit;
 	}
 	
 	/*
 	 * Fungsi default in soal routes
 	 * ------
 	 * @access public
 	 * @param admin dan konsumen
 	 */
 	function index() 
 	{
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('manajer','direktur')))
 		{
 			$this->_manage();
 		}
 		elseif ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('konsumen')))
 		{
 			$this->tampil();
 		}
 		else
 		{
	 		echo 'You not have access';
	 		echo br(2);
	 		echo anchor('auth/login','Kembali');
 		}
 	}
 	
 	/*
 	 * Fungsi menampilkan daftar soal dalam bentuk tabel tabel
 	 * ------
 	 * @access private
 	 * @param
 	 */
 	function _manage()
 	{
 			// paging
 			$this->load->library('pagination');
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
 			
 			$uri_segment = 3	;
 			$data['offset'] = $this->uri->segment($uri_segment);
 			
 			$config['base_url'] = base_url().'soal/index/';
 			$config['total_rows'] = $this->soal_model->count_all();
 			$config['per_page'] = 20;
 			$config['next_link'] = '<li>Selanjutnya</li>';
 			$config['prev_link'] = '<li>Sebelumnya</li>';
 			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> Halaman Ke -';
 			$config['cur_tag_close'] = '</li>';
 			
 			$this->pagination->initialize($config);
 			$data['paging'] = $this->pagination->create_links();
 			
 			$data['limit'] = $config['per_page'];
 			
 			// all soal as object as object :)
 			$data['results'] = $this->soal_model
 										->with('dimensi')
 										->limit($data['limit'], $data['offset'])
 										->get_all();
			
 			// render a template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] 	= "Modul Soal - Daftar Soal";
 			$data['module'] = "soal"; // module
 			$data['soal'] 	= "soal"; // controller
 			$data['view'] 	= "display"; // view
 		
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 			if($this->ion_auth->in_group('direktur')) {
 				echo Modules::run('template/direktur', $data);
 			}
 	}
 	
 	/*
 	 * Fungsi untuk menambah data soal
 	 * ------
 	 * @access public
 	 * @param 
 	 */
 	function add()
 	{
 		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('auth/login', 'Login');
 		}
 		
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			$this->form_validation->set_rules('pertanyaan', 'Soal', 'required');
 			$this->form_validation->set_rules('faktor', 'Faktor', 'required');
 			$this->form_validation->set_rules('dimensi', 'Dimensi', 'required');
 			$this->form_validation->set_rules('publish', 'Status', 'required');
 		}
 		
 		if ($this->form_validation->run() == true)
 		{
 			$data = array(
 				'pertanyaan' => $this->input->post('pertanyaan'),
 				'faktor' => $this->input->post('faktor'),
 				'dimensi_id' => $this->input->post('dimensi'),
 				'publish' => $this->input->post('publish'),
 				);
 		}
 		
 		if ($this->form_validation->run() == true
 				&& $this->soal_model->insert($data))
 		{
 			//dump($_POST);exit;
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Soal berhasil ditambahkan!</div>");
 			redirect('soal/index','refresh');
 		}
 		else
 		{
 			
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
 			 			
 			$data['pertanyaan'] = array(
				'name'  => 'pertanyaan',
				'id'    => 'pertanyaan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pertanyaan'),
			);
 			$data['faktor'] = array(
 					'name'  => 'faktor',
 					'id'    => 'faktor',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('faktor'),
 			);
 			
 			$data['publish'] = array(
 					'name'  => 'publish',
 					'id'    => 'publish',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('publish'),
 			);
		
 			// render template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] = "Modul Soal - Tambah Data Soal";
 			$data['module'] = "soal"; // module
 			$data['soal'] = "soal"; // controller
 			$data['view'] = "soal_form"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 		}
 	}
 	
 	/*
 	 * Fungsi untuk mengubah data soal
 	 * ------
 	 * @param $id
 	 * @acces public
 	 */
 	function update($banksoal_id)
 	{
 		if (!$this->ion_auth->is_admin() || !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('soal/index', 'Kembali');
 		}
 		
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 		
 			$soal = $this->soal_model->get($banksoal_id); // an object of soal
 			$dimensi = $this->dimensi_model->as_array()->get_all(); // an array of dimensi
 			$soalDimensi = $this->soal_model
 									->with( 'dimensi' )
 									->get_all();
 			
 			$this->form_validation->set_rules('pertanyaan', 'Soal', 'required');
 			$this->form_validation->set_rules('faktor', 'Faktor', 'required');
 			$this->form_validation->set_rules('dimensi', 'Dimensi', 'required');
 			$this->form_validation->set_rules('publish', 'Status', 'required');
 			
 			// cek hasil ketik
 			if (isset($_POST) && !empty($_POST))
 			{
 				$data = array(
 						'pertanyaan' => $this->input->post('pertanyaan'),
 						'faktor' => $this->input->post('faktor'),
 						'dimensi_id' => $this->input->post('dimensi'),
 						'publish' => $this->input->post('publish'),
 						);
 			
	 			// jika bedul
	 			if ($this->form_validation->run() == TRUE && 
	 					$this->soal_model->update($soal->banksoal_id, $data))
	 			{
					$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Soal sudah terupdate! </div>");
	 				redirect('soal/index', 'refresh');
	 			}
 			}
 			
 			// Populate
 			$data['single'] = $soal;
 			$data['dimensi'] = $dimensi;
 			$data['soaldimensi'] = $soalDimensi;
 			
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));

 			$data['pertanyaan'] = array(
 					'name'  => 'pertanyaan',
 					'id'    => 'pertanyaan',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('pertanyaan', $soal->pertanyaan),
 					);
 			$data['faktor'] = array(
 					'name'  => 'faktor',
 					'id'    => 'faktor',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('faktor', $soal->faktor),
 					);
 			
 			$data['publish'] = array(
 					'name'  => 'publish',
 					'id'    => 'publish',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('publish', $soal->publish),	
 					);
 			
 			// render template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] = "Modul Soal - Ubah Data Soal";
 			$data['module'] = "soal"; // module
 			$data['soal'] = "soal"; // controller
 			$data['view'] = "soal_edit"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 		}
 	}
 	
 	/*
 	 * Fungsi untuk menghapus data soal
 	 * ------
 	 * @param $id
 	 * @access public
 	 */
 	function delete($banksoal_id)
 	{
 		
 		$dat = $this->input->post('banksoal_id');
 		
 		for ($i = 0; $i=sizeof($dat); $i++) 
 		{
 			if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 			{
	 			echo 'You don\'t have an access';
	 			echo br(2);
	 			echo anchor('soal/index','Kembali');
 			}
 		
	 		/*
			 * Admin done
			 */
			elseif ($this->ion_auth->is_admin()
						&& $this->soal_model->delete_by(array('banksoal_id' => $dat[$i])))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Soal berhasil dihapus!</div>");
				redirect('soal/index');
			}
			/*
			 * Manajer done
			 */
			elseif ($this->ion_auth->in_group('manajer')
						&& $this->soal_model->delete_many($banksoal_id, $dat[$i]))
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Soal berhasil dihapus!</div>");
				redirect('soal/index');
			}
 		}
 		
 	}
 	
 	/*
 	 * Fungsi menampilkan soal secara lebih detail
 	 * ------
 	 * @access public 
 	 * @param $id
 	 */
 	function detail($banksoal_id = null)
 	{
 		
 		$banksoal_id = (int) $banksoal_id;
 			
 		if ($this->ion_auth->is_admin() || $this->ion_auth->logged_in() && $this->ion_auth->in_group('manajer'))
 		{
 			/*
 			 * STILL NOT WORKING!!!
 			 */
 			$data['soal']	=  $this->soal_model
 										->with('dimensi')
 										->get_by('banksoal_id', $banksoal_id);
 			//////////////////////////////////////////////////////////////////
 			
 			// Render Template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] 	 = "Module Soal - Detail Soal";
 			$data['soal'] 	 = "soal"; // Controller
 			$data['view'] 	 = "soal_detail"; // View
 			$data['module']  = "soal"; // Controller
 			
 			// Load Template->view(login)
 			if($this->ion_auth->is_admin()){
 				echo Modules::run('template/admin',$data);
 			}
 			elseif ($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer',$data);
 			}
 			else 
 			{ 
 				echo "You don\'t have an access this page";
 				echo br(2);
 			?>
	 			<!-- Balikin kalo gak ada akses -->
	 			<a href="javascript:history.back()" class="back_link btn btn-small">Kembali</a>
	 		<?php 
 			}
 		}
 		else
 		{
 			show_404();
 		}
 	}
 	
 	/*
 	 * Original source: http://tutorialzine.com/2012/01/question-of-the-day-codeigniter-php-mysql/
 	 * -----
 	 * Fungsi menampilkan soal dan menjawabnya
 	 * -----
 	 * @access public
 	 * @param $id
 	 * @user Pelanggan
 	 
 	function tampil($banksoal_id = 1)
 	{
 		if(!$this->ion_auth->in_group('konsumen'))
 		{
 			echo "You don\'t have an access this page";
 			echo br(2);
 			echo anchor('auth/login','Kembali');
 		}else{
 		
 		// No funny here (bY Ben Edmunds)
 		$banksoal_id = (int) $banksoal_id;
 		$user_id 	 = $this->session->userdata('user_id');
 		$id = $this->session->userdata('user_id');
 		
 		
 		// Cek keberadaan soal yang aktif
 		$soal = $this->soal_model->as_array()->get_many_by(array('publish' => 1,'banksoal_id' => "$banksoal_id"));
 		if (empty($soal))
 		{
 			echo "Soal belum di Inputkan";
 		}
 		// Paging awal
 		$next = 0;
 		
 		// SQL : SELECT MIN(`banksoal_id`) AS banksoal_id FROM (`banksoal`) WHERE `banksoal_id` > 1
 		// $res = $this->soal_model->as_array()->dirasakan_min($banksoal_id)->get_all();
 		$res = $this->db->query("SELECT MIN(`banksoal_id`) AS banksoal_id
								FROM (`banksoal`)
								WHERE `banksoal_id` > $banksoal_id AND publish = 1")->result_array();
 		
 		
 	
 		if(!empty($res)){
 			$next = $res[0]['banksoal_id'];
 			
 		}
 		
 		// Form wajib di isi
 		$this->form_validation->set_rules('pilihan', 'Pilihan', 'required');
 		
 		if ($this->form_validation->run() == FALSE)
 		{
 			// populate data
 			$data = array(
 					'banksoal'		=> $soal[0]['pertanyaan'],
 					'banksoal_id'	=> $soal[0]['banksoal_id'],
 					'user_id'		=> $user_id,
 					'next'			=> $next,
 			);
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
 			
 			$data['soal1'] 		= $soal[0]['pertanyaan'];
 			$data['dim'] 		= $soal[0]['dimensi_id'];
 			$data['faktor'] 	= $soal[0]['faktor'];
 			$data['next'] 		= $next;
 			$data['total'] 		= $this->soal_model->count_by(array("publish" => 1));
 			$data['banksoal_id']= $banksoal_id;
 			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 			$data['title'] 	 	= "Module Soal -Daftar Soal";
 			$data['soal']  		= "soal"; // Controller
 			$data['view'] 		= "papan_soal"; // View
 			$data['module'] 	= "soal"; // Controller
 				
 			echo Modules::run('template/konsumen', $data);
 		}
 		else
 		{
 			// lakukan insert data jika dijawab
 			$data = array(
 						'banksoal_id' 	=> $soal[0]['banksoal_id'],
 						'user_id'		=> $user_id,
 						'created'		=> time(),
 						'score'			=> $this->input->post('pilihan'),
 					);
 		
 			// Tambah data ke tabel jawaban
 			$this->db->insert('jawaban', $data);
 			// Update data user menjawab ke tabel users
 			$this->db->set('jawaban','jawaban+1', FALSE)
 					 ->where('id', $user_id)
 					 ->update('users');
  			
 			// arahkan next soal
 			redirect('soal/tampil/'. $res[0]['banksoal_id']);
 		}
 	}
 }
 */
 	// ----------- TEST ---------
 	
 	/*
 	 * Original source: http://tutorialzine.com/2012/01/question-of-the-day-codeigniter-php-mysql/
 	* -----
 	* Fungsi menampilkan soal dan menjawabnya
 	* -----
 	* @access public
 	* @param $user_id, $banksoal_id, $aturan_id
 	* @user Pelanggan
 	* 
 	*/
 	function tampil($banksoal_id = 1)
 	{
 		 		
 		// -----------------------
 		if(!$this->ion_auth->in_group('konsumen'))
 		{
 			echo "You don\'t have an access this page";
 			echo br(2);
 			echo anchor('auth/login','Kembali');
 		}
 		else
 		{
 			// No funny here (by Ben Edmunds)
 			$banksoal_id = (int) $banksoal_id;
 			$user_id 	 = $this->session->userdata('user_id');
 			// cek jawaban
 			$cekjawaban = $this->user_model->get_by('id',$user_id);
 			$jawaban_isi = $cekjawaban->jawaban;
 			$maksimal_jawab = 10;
 			
 		 				
 			// Cek keberadaan soal yang aktif
 			$soal = $this->soal_model->as_array()->get_many_by(array('publish' => 1,'banksoal_id' => "$banksoal_id"));
 			if (empty($soal))
 			{
 				echo "Soal berstatus unpublish/ belum aktif";
 			}
 			
 			// Paging awal
 			$next = 0;
 			$maxsoal = $this->soal_model->count_by('publish','1');
 				
 			// SQL : SELECT MIN(`banksoal_id`) AS banksoal_id FROM (`banksoal`) WHERE `banksoal_id` > 1
 			// $res = $this->soal_model->as_array()->dirasakan_min($banksoal_id)->get_all();
 			$res = $this->db->query("SELECT MIN(`banksoal_id`) AS banksoal_id
				 					 FROM (`banksoal`)
				 					 WHERE `banksoal_id` > $banksoal_id AND publish = 1")->result_array();

 			// Idea from "UDA a.k.a RIFKI" Topidesta.wordpress.com author.
 			for ($i = 0; $i <= $maxsoal; $i++)
 			{
 				if(!empty($res) || $jawaban_isi != 0)
 				{
 					$next = $res[0]['banksoal_id'];
 				}
 					
 				if ($next == $maxsoal)
 				{
 					$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Terima Kasih Atas Partisipasinya!</div>");
 					redirect('home');
 				}
 			}
 			
 			// Form wajib di isi
 			$this->form_validation->set_rules('pilihan', 'Pilihan', 'required');
 				
 			if ($this->form_validation->run() == FALSE)
 			{
 				if ($jawaban_isi == 0 || $jawaban_isi != $maksimal_jawab)
 					{
	 				// populate data pertanyaan
	 				$data = array(
	 						'banksoal'		=> $soal[0]['pertanyaan'],
	 						'banksoal_id'	=> $soal[0]['banksoal_id'],
	 						'dimensi_id'	=> $soal[0]['dimensi_id'],
	 						'user_id'		=> $user_id,
	 						'next'			=> $next,
	 				);
	 				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
	
	 				$data['soal1'] 		= $soal[0]['pertanyaan'];
	 				$data['dim'] 		= $soal[0]['dimensi_id'];
	 				$data['faktor'] 	= $soal[0]['faktor'];
	 				$data['next'] 		= $next;
	 				$data['total'] 		= $this->soal_model->count_by("publish","1");
	 				$data['banksoal_id']= $banksoal_id;
	
	 				// render template
	 				$data['welcome'] 	= ucfirst($this->session->userdata('email'));
	 				$data['title'] 	 	= "Module Soal -Daftar Soal";
	 				$data['soal']  		= "soal"; // Controller
	 				$data['view'] 		= "papan_soal"; // View
	 				$data['module'] 	= "soal"; // Controller
	 					
 					echo Modules::run('template/konsumen', $data);
 				}
 				elseif ($jawaban_isi != 0)
 				{
 					$data['message'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a> Maaf, Anda Sudah Menjawab Questioner Kami! </div>';
 					
 					// render template
	 				$data['welcome'] 	= ucfirst($this->session->userdata('email'));
	 				$data['title'] 	 	= "Module Soal -Daftar Soal";
	 				$data['soal']  		= "soal"; // Controller
	 				$data['view'] 		= "sudah_jawab_soal"; // View
	 				$data['module'] 	= "soal"; // Controller
	 					
 				echo Modules::run('template/konsumen', $data);
 				}
 			}
 			else
 			{
 				// lakukan insert data jika dijawab
 				$data = array(
 						'banksoal_id' 	=> $soal[0]['banksoal_id'],
 						'user_id'		=> $user_id,
 						'dimensi_id'	=> $soal[0]['dimensi_id'],
 						'created'		=> time(),
 						'aturan_id'		=> $this->input->post('pilihan'),
 						//'score'			=> $this->input->post('pilihan'),
 				);

 				// Tambah data ke tabel jawaban
 				$this->db->insert('jawaban', $data);
 				// Update data user menjawab ke tabel users
 				$this->db->set('jawaban','jawaban+1', FALSE)
		 				 ->where('id', $user_id)
		 				 ->update('users');
 					
 				// arahkan next soal
 				redirect('soal/tampil/'. $res[0]['banksoal_id']);
 			}
 		}
 	}
 	
 	// ----------- END TEST ------
 
 /*
  * Fungsi menampilkan soal yang aktif
  * ------
  * @param
  * @acces
  * 
  */
 function publish()
 	{
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			// paging
 			$this->load->library('pagination');
 		
 			$uri_segment = 4;
 			$data['offset'] = $this->uri->segment($uri_segment);
 		
 			$config['base_url'] = base_url().'soal/publish/index/';
 			$config['total_rows'] = $this->soal_model->count_by('publish','1');
 			$config['per_page'] = 10;
 			$config['next_link'] = '<li>Selanjutnya</li>';
 			$config['prev_link'] = '<li>Sebelumnya</li>';
 			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
 			$config['cur_tag_close'] = '</li>';
 		
 			$this->pagination->initialize($config);
 			$data['paging'] = $this->pagination->create_links();
 		
 			$data['limit'] = $config['per_page'];
 			
 			// Get aktif soal
 			$data['results'] = $this->soal_model
							 			->with('dimensi')
							 			->limit($data['limit'], $data['offset'])
 										->get_many_by('publish','1');
 			
 			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
 			
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] 	= "Modul Questioner - Daftar Soal Yang Tampil";
 			$data['module'] = "soal"; // module
 			$data['soal'] 	= "soal"; // controller
 			$data['view'] 	= "display"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 				
 		}else{
 			echo 'You not have access';
 		}
 	}
 	
 	/*
 	 * Fungsi untuk Menampilkan soal yang tidak aktif
 	 * ------
 	 * @param
 	 * @acces
 	 * 
 	 */
 	function unpublish()
 	{
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			// paging
 			$this->load->library('pagination');
 				
 			$uri_segment = 4;
 			$data['offset'] = $this->uri->segment($uri_segment);
 				
 			$config['base_url'] = base_url().'soal/unpublish/index/';
 			$config['total_rows'] = $this->soal_model->count_all();
 			$config['per_page'] = 10;
 			$config['next_link'] = '<li>Selanjutnya</li>';
 			$config['prev_link'] = '<li>Sebelumnya</li>';
 			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
 			$config['cur_tag_close'] = '</li>';
 				
 			$this->pagination->initialize($config);
 			$data['paging'] = $this->pagination->create_links();
 				
 			$data['limit'] = $config['per_page'];
 		
 			// Get aktif soal
 			$data['results'] = $this->soal_model
							 			->with('dimensi')
							 			->limit($data['limit'], $data['offset'])
							 			->get_many_by(array('publish' => 0));
 			
 			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
 			
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] 	= "Modul Soal - Daftar Soal Yang Unpublish";
 			$data['module'] = "soal"; // module
 			$data['soal'] 	= "soal"; // controller
 			$data['view'] 	= "display"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 				
 		}else{
 			echo 'You not have access';
 		}
 	}
 	
 	// still errur
 	function search()
 	{
 			$this->load->library('pagination');
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
 			
 			$uri_segment = 4;
 			$data['offset'] = $this->uri->segment($uri_segment);
 			
 			$config['base_url'] = base_url().'soal/search/index/';
 			$config['total_rows'] = $this->soal_model->count_all();
 			$config['per_page'] = 20;
 			$config['next_link'] = '<li>Selanjutnya</li>';
 			$config['prev_link'] = '<li>Sebelumnya</li>';
 			$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
 			$config['cur_tag_close'] = '</li>';
 			
 			$this->pagination->initialize($config);
 			$data['paging'] = $this->pagination->create_links();
 			
 			$data['limit'] = $config['per_page'];
 			 		
 			$data['hasil']  = $this->soal_model
							 		->searching()
							 		->limit($data['limit'], $data['offset'])
							 		->as_object() // optional, can use as_object?? really
							 		->get_by(array(
							 				'faktor' => $this->input->post('cari'),
							 		));
							 		
 		if ($data['hasil'] == null)
 		{
 			echo "Data yang dimasukan salah!";
 			echo br(2);
 			echo anchor('soal/index', 'kembali');
 		}
 		else
 		{
 			
 			dump($_POST); exit;
 			
 			// Render Template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] 	= "Modul Soal - Hasil Pencarian";
 			$data['module'] = "soal"; // module
 			$data['soal'] 	= "soal"; // controller
 			$data['view'] 	= "display"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}

 		}
 	}
 	/*
 	 * Fungsi untuk melakukan publish soal
 	 * ----
 	 * inspired from heryCMS
 	 * ----
 	 * @access $manajer
 	 */
 	function do_publish($banksoal_id)
 	{
 		// cek harus manajer yang lakukan fungsi ini
 		if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manajer'))
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 			echo anchor("soal/index", "Kembali");
 		}
 		else 
 		{
 			$this->db->where("banksoal_id", $banksoal_id);
 			$this->db->set("publish", 1);
 			$this->db->update("banksoal");
 			$this->session->set_flashdata('message', "Pertanyaan Sudah aktif");
 			redirect("soal/index");		
 		}
 	}
 	
 	/*
 	 * Fungsi untuk tidak menampilkan soal
 	 * ----
 	 * inspired from heryCMS
 	 * ----
 	 * @access $manajer
 	 */
 	function do_unpublish($banksoal_id)
 	{
 		// cek harus manajer
 		if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manajer'))
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 			echo anchor("soal/index", "Kembali");
 		}
 		else 
 		{
 			$this->db->where("banksoal_id", $banksoal_id);
 			$this->db->set("publish", 0);
 			$this->db->update("banksoal");
 			$this->session->set_flashdata('message', "Pertanyaan Sudah tidak aktif");
 			redirect("soal/index");		
 		}
 	}
 }
 
 
 /* End of File: soal.php */
/* Location: ../www/modules/soal/soal.php */ 