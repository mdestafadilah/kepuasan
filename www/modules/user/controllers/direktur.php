<?php
/***************************************************************************************
 *                       			direktur.php
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
class Direktur extends MX_Controller
{
	private $groups = 'direktur';
	
	function __construct()
	{
		parent::__construct();
		$data = array();
		$this->load->library(array('highcharts','form_validation','session','ion_auth'));
		$this->load->helper(array('url', 'form'));
		$this->load->model(array(
				'perawat/perawat_model',
				'pelanggan/pelanggan_model',
				'jawaban/jawaban_model',
				'group/group_model',
				'soal/soal_model',
				'user/user_model',
		));
	}
	
	function debuk()
	{
			$variabeljawaban = $this->_grafik_variabeljawaban();
										echo "<pre>";
		dump($variabeljawaban);
	}

	function index()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($this->groups))
		{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			/* 
			// some data series
			$title = "Home Direktur";
			$sub = "Sub Home direktur";
			
			$serie['data'] = array(20, 45, 60, 22, 6, 36);
			$data['charts'] = $this->highcharts
										->initialize('chart_template')
										->set_serie($serie)
										->set_title($title, $sub)
										->render();
			
			$fuzzy['y'] = array(0, 1);
			$batas['x'] = array('Mengesankan','Biasa','Kecewa');
			$data['aha'] = $this->highcharts
										->set_serie($fuzzy['y'])
										->set_serie($batas['x'])
										->set_axis_titles()
										->set_title($title, $sub)
										->render();
			 */
			
			
			
			// --------------------------------------------------------------------------------------
			// Get jenis soal
			// --------------------------------------------------------------------------------------
			$resultsoal = $this->_grafik_soal();
				
			$soal1['x_labels'] 		= 'soal'; // optionnal, set axis categories from result row
			$soal1['series'] 		= array('total'); // set values to create series, values are result rows
			$soal1['data']			= $resultsoal;
			
			$this	->highcharts
					->set_title('Soal','Jenis Soal')
					->set_axis_titles('Jenis Soal','Total')
					->set_type('bar')
					->from_result($soal1)
					->add();
					
			$data['soals'] = $this->highcharts->render();
			// --------------------------------------------------------------------------------------
			
			 					
			// --------------------------------------------------------------------------------------
			// Get jenis kelamin
			// --------------------------------------------------------------------------------------
			$resultkelamin = $this->_grafik_jenkel();
							
			$kelamin1['x_labels'] 		= 'jenkel'; // optionnal, set axis categories from result row
			$kelamin1['series'] 		= array('total'); // set values to create series, values are result rows
			$kelamin1['data']			= $resultkelamin;
				
			$this	->highcharts
					->set_title('Konsumen','Jenis Kelamin')
					->set_axis_titles('Jenis Kelamin','Total')
					->set_type('column')
					->from_result($kelamin1)
					->add();
				
			$data['kelamin'] = $this->highcharts->render();
			// --------------------------------------------------------------------------------------
			
			
			// --------------------------------------------------------------------------------------
			// Get jenis rawat
			// --------------------------------------------------------------------------------------
			$resultrawat = $this->_grafik_jenisrawat();
			
			$rawat1['x_labels'] 	= 'merawat'; // optionnal, set axis categories from result row
			$rawat1['y_labels'] 	= 'merawat'; // optionnal, set axis categories from result row
					
			$rawat1['series'] 		= array('total'); // set values to create series, values are result rows
			$rawat1['data']			= $resultrawat;
			
			$this	->highcharts
					->set_title('Konsumen','Merawat Konsumen')
					->set_axis_titles('Jenis Rawat','Total')
					->set_type('column')					
					->from_result($rawat1)
					->add();
			
			$data['rawat'] = $this->highcharts->render();
			// ---------------------------------------------------------------------------------------
			
			// --------------------------------------------------------------------------------------
			// Get jawaban soal
			// --------------------------------------------------------------------------------------
			$variabeljawaban = $this->_grafik_variabeljawaban();
				
			$var1['x_labels'] = 'variabel';
			$var1['series'] = array('total');
			$var1['data'] = $variabeljawaban;
				
			$this	->highcharts
					->set_title('Jawaban','Jawaban Konsumen')
					->set_type('pie')
					->from_result($var1)
					->add();
				
			$data['variabels'] = $this->highcharts->render();
				
			
			// --------------------------------------------------------------------------------------
						
			
			// Buat Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] = "Modul Pengguna Sistem - Direktur";
			$data['module'] = "home"; // Controller
			$data['direktur'] = "direktur"; // Controller
			$data['view'] = "home_direktur"; // View
				
			// Load Template->view(login)
			echo Modules::run('template/direktur',$data);
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
			
			// Buat Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title'] = "Modul Pengguna Sistem - Profile Direktur";
			$data['module'] = "user"; // Controller
			$data['direktur'] = "direktur"; // Controller
			$data['view'] = "gen_direktur"; // View
		
			// Load Template->view(login)
			echo Modules::run('template/direktur',$data);
		}
		else //apabila belum login
		{
			show_404();
		}
	}
	
	/*
	 * Get Count Data soal
	 */
	function _grafik_soal()
	{
		$data =	$this->db->query("	SELECT
									banksoal.faktor AS soal,
									Count(banksoal.faktor) AS total
									FROM
									banksoal
									GROUP BY
									banksoal.publish ")->result();
		
		return $data;
	}
	
	/*
	 * Get Count data Jenis Kelamin
	 */
	function _grafik_jenkel()
	{
		$data = $this->db->query("	SELECT
									sex AS 'jenkel', COUNT(sex) AS 'total'
									FROM
									users
									GROUP BY sex		
									")->result();
		
		return $data;
	}
	
	/*
	 * Get count data Jenis Rawat
	 */
	function _grafik_jenisrawat()
	{
		$data = $this->db->query("	SELECT DISTINCT
							elderly AS merawat,
							COUNT(elderly) AS total
							FROM (`users`)
							INNER JOIN `users_groups` ON `users_groups`.`user_id`=`users`.`id`
							WHERE `users_groups`.`group_id` IN ('4')
							# work for agregat sometimes
							GROUP BY elderly ")->result();
		return $data;
	}
	
	/*
	 * Get count data variabel jawaban
	 */
	function _grafik_variabeljawaban()
	{
		$data = $this->db->query("	SELECT
							aturan.variabel as variabel,
							Count(aturan.variabel) AS total
							FROM
							jawaban
							INNER JOIN banksoal ON jawaban.banksoal_id = banksoal.banksoal_id
							INNER JOIN aturan ON jawaban.aturan_id = aturan.aturan_id
							GROUP BY
							aturan.variabel ")->result();
		return $data;
	}
}
 
 
 /* End of File: konsumen.php */
/* Location: ../www/modules/user/direktur.php */ 