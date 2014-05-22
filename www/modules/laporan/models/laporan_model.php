<?php
/***************************************************************************************
 *                       			laporan_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	laporan_model.php
 *      Created:   		2013 - 13.18.43 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Laporan_model extends CI_Model
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 				'aturan/aturan_model',
 				'soal/soal_model',
 				'dimensi/dimensi_model',
 				'group/group_model',
 				'kesimpulan/kesimpulan_model',
 				'konsumen/konsumen_model',
 				'mu/mu_model',
 				'perawat/perawat_model',
 				'users/user_model',
 				'himpunan/himpunan_model',
 				'jawaban/jawaban_model'
 		));
 	}
 }
 
 
 /* End of File: laporan_model.php */
/* Location: ../www/modules/laporan_model.php */ 