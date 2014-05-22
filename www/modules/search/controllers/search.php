<?php
/***************************************************************************************
 *                       			search.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	search.php
*      Created:   		2013 - 13.13.23 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/
class Search extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
				'search/jawaban_konsumen',
				'search/pengguna',
				'search/pengguna_konsumen',
				'search/pengguna_perawat',
				'search/soal_publish',
				'search/search_model',
				'search/mu_model',
		));
	}
	
	function debuk()
	{
		
	}
	
	/*
	 * TODO:
	 */
	function mu() 
	{
		
		// render a template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 		= "Modul Searching - Daftar Mu Keanggotaan";
		$data['module'] 	= "search"; // module
		$data['search'] 	= "mu"; // controller
		$data['view'] 		= "search_mu"; // view
		
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
	 * TODO:
	 */
	function kesimpulan()
	{
		
		
		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Searching - Daftar Kesimpulan";
 		$data['module'] 	= "search"; // module
 		$data['search'] 	= "kesimpulan"; // controller
 		$data['view'] 		= "search_kesimpulan"; // view
 			
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
	 * TODO:
	 * 
	 */
	function aturan()
	{
		
		// render a template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 		= "Modul Searching - Daftar Aturan";
		$data['module'] 	= "search"; // module
		$data['search'] 	= "aturan"; // controller
		$data['view'] 		= "search_aturan"; // view
		
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
	 * TODO:
	 * 
	 */
	function dimensi()
	{
		
		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Searching - Daftar Dimensi";
 		$data['module'] 	= "search"; // module
 		$data['search'] 	= "dimensi"; // controller
 		$data['view'] 		= "search_dimensi"; // view
 			
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
	 * TODO:
	 */
	function jawaban()
	{
		
		// render a template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 		= "Modul Searching - Daftar Jawaban";
		$data['module'] 	= "search"; // module
		$data['search'] 	= "jawaban"; // controller
		$data['view'] 		= "search_jawaban"; // view
		
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
	 * TODO:
	 */
	function pelanggan()
	{
		$data['tampil']=$this->pengguna_konsumen->caridata();
	
		if($data['tampil']==null) {
			echo 'maaf data yang anda cari tidak ada atau keywordnya salah';
			echo br(2);
			echo anchor('pelanggan','kembali');
		}
		else {
			
			// render a template
	 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
	 		$data['title'] 		= "Modul Searching - Daftar Pelanggan";
	 		$data['module'] 	= "search"; // module
	 		$data['search'] 	= "pelanggan"; // controller
	 		$data['view'] 		= "search_pelanggan"; // view
	 			
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
	}
	
	/*
	 * TODO:
	 */
	function perawat()
	{
		
		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Searching - Daftar Perawat";
 		$data['module'] 	= "search"; // module
 		$data['search'] 	= "perawat"; // controller
 		$data['view'] 		= "search_perawat"; // view
 			
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
	 * TODO:
	 * 
	 */
	function soal()
	{
		
		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Searching - Daftar Soal";
 		$data['module'] 	= "search"; // module
 		$data['search'] 	= "soal"; // controller
 		$data['view'] 		= "search_soal"; // view
 			
 		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 		}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 		}
 		if($this->ion_auth->in_group('direktur')) {
 			echo Modules::run('template/direktur', $data);
 		}
		
		/*
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
	*/
	}
	
}


/* End of File: search.php */
/* Location: ../www/modules/search.php */