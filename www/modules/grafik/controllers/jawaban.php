<?php
/***************************************************************************************
 *                       			jawaban.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	jawaban.php
 *      Created:   		2013 - 16.38.19 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 
 class Jawaban extends MX_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->library('highcharts');
 	}
 	
 	/*
 	 * Total masing masing perasaan konsumen
 	 */
 	function _total_kepuasan()
 	{
 		$puas = $this->db->query("SELECT
					 				aturan.variabel,
					 				Count(aturan.variabel) AS TOTAL_KEPUASAN
					 				FROM
					 				jawaban
					 				INNER JOIN banksoal ON jawaban.banksoal_id = banksoal.banksoal_id
					 				INNER JOIN aturan ON jawaban.aturan_id = aturan.aturan_id
					 				GROUP BY
					 				aturan.variabel
					 			")->result();
 		
 		return $puas;
 	}
 	
 	/*
 	 * Total jenis kelamin pria dan wanita
 	 */
 	function _total_jenkel()
 	{
 		$sex = $this->db->query("SELECT
									sex AS 'Jenis Kelamin', COUNT(sex) AS 'Jumlah'
									FROM
									users
									# work for agregat sometimes
									GROUP BY sex
 								")->result();
 		return $sex;
 	}
 	
 	/*
 	 * Total soal berdasar faktor kepuasan
 	 */
 	function _total_soal()
 	{
 		$soal = $this->db->query("SELECT
									faktor,
									COUNT(faktor) as jumlah
									FROM
									banksoal
									GROUP BY banksoal.publish
								  ")->result();
 		
 		return $soal;
 	}
 	
 	
 	
 	function index()
 	{
 		// object result
 		$datas = $this->_total_soal();
 		
 		$dat1['x_labels'] 	= 'faktor'; // optionnal, set axis categories from result row
 		$dat1['series']		= array('Faktor' => 'jumlah');
 		$dat1['data']		= $datas;
 		
 		$this->highcharts
 			 ->set_type('bar')
 			 ->from_result($dat1)
 			 ->add();
 		
 		$data['charts'] = $this->highcharts->render();
 		
 		// render template
 		$data['welcome'] = ucfirst($this->session->userdata('email'));
 		$data['title'] 	 = "Charts";
 		$data['grafik']  = "grafik"; // Controller
 		$data['view'] 	 = "charts"; // View
 		$data['module']  = "grafik"; // Controller
 		
 		echo Modules::run('template/direktur',$data);
 		
 		dump($datas);
 	}
 }
 /* End of File: jawaban.php */
/* Location: ../www/modules/jawaban.php */ 