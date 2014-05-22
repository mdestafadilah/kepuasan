<?php
/***************************************************************************************
 *                       			mu_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	mu_model.php
 *      Created:   		2013 - 14.16.37 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 
 class Mu_model extends MY_Model
 {
 	public $_table = 'mu';
 	  	
 	public $belongs_to = array( 'dimensi' => array( 'model' => 'dimensi_model', 
 													'primary_key' => 'dimensi_id' ) , 
 								'users' => array( 'model' => 'user_model', 
 													'primary_key' => 'user_id' ) , 
 								'banksoal' => array( 'model' => 'soal_model', 
 													'primary_key' => 'banksoal_id' ) );
 	
 	/*
 	public function choice($dimensi_id, $pilihan)
 	{
 		$this->db->where('dimensi_id', $dimensi);
 		$this->db->where('type', 'news');
 		$this->db->where('', '');
 		return $this;
 	}
 	
 	public function joss()
 	{
 		$this->db->where('dimensi_id', '1');
		$this->db->where('MuKecewa', '0');
		// Produces: WHERE name != 'Joe' OR id > 50
		return $this;
 	}
 	*/
 	
 }
 
 /* End of File: mu_model.php */
/* Location: ../www/modules/mu_model.php */ 