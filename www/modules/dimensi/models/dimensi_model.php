<?php
/***************************************************************************************
 *                       			dimensi_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	dimensi_model.php
 *      Created:   		2013 - 11.31.02 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Dimensi_model extends MY_Model
 {
 	public $_table = "dimensi";
	public $primary_key = "dimensi_id";
	
	public $belongs_to = array( 'banksoal' );
	
	public function searching()
	{
		$field = $this->input->post('cari');
		$this->db->query("SELECT * FROM (`dimensi`) WHERE  `variabel` LIKE '%$field%'");
		return $this;
	}
	
	function get_options( $options = array() ) 
	{
		$query = $this->db->get($this->table());
		foreach ($query->result() as $row) {
			$options[$row->dimensi_id] = $row->nama;
		}
	
		return $this;
	}
 }
 
 
 /* End of File: dimensi_model.php */
/* Location: ../www/modules/dimensi_model.php */ 