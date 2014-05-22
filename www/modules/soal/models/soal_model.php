<?php
/***************************************************************************************
 *                       			soal_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	soal_model.php
 *      Created:   		2013 - 09.57.52 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Soal_model extends MY_Model
 {
 	public $_table = 'banksoal';
 	public $primary_key = 'banksoal_id';
 	
 	public $belongs_to = array( 'dimensi' );
 	 	
 	public function countsoal()
 	{
 		$this->db->query("SELECT
							faktor as 'Jenis Soal',
							COUNT(faktor) as 'Jumlah'
							FROM
							banksoal
							GROUP BY faktor");
 		return $this;
 	}
 	
 	
 	public function dirasakan_max($banksoal_id = 1)
 	{
 		$data = $this->db->select_max('banksoal_id')
 						 ->where("banksoal_id < {$banksoal_id}")
 				 		 ->get('banksoal');
 		return $this;
 	}
 	
 	public function dirasakan_min($banksoal_id = 1)
 	{
 		$data = $this->db->select_min('banksoal_id')
 							->where("banksoal_id > {$banksoal_id}")
 							->get('banksoal');
 		return $this;
 	}
 	
 	public function searching()
 	{
 		// sql : SELECT * FROM (`banksoal`) WHERE  `pertanyaan` LIKE '%....%'
 		// ar  : $this->db->like('pertanyaan', $field);
 	
 		$field = $this->input->post('cari');
 		$this->db->query("SELECT * FROM (`banksoal`) WHERE  `faktor` LIKE '%$field%'")->result();
 		return $this;
 	}
 	
 }
 
 
 /* End of File: soal_model.php */
/* Location: ../www/modules/soal_model.php */ 