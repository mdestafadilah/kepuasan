<?php
/***************************************************************************************
 *                       			pengguna_konsumen.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	pengguna_konsumen.php
 *      Created:   		2013 - 17.26.34 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Pengguna_konsumen extends CI_Model
 {
 	function __construct()
 	{
 		parent::__construct();
 	}
 	
 	function caridata(){
 		$c = $this->input->post('cari');
 		$this->db->like('username', $c);
 		/* 
 		$this->db->or_like('first_name', $c);
 		$this->db->or_like('last_name', $c);
 		$this->db->or_like('phone', $c);
 		$this->db->or_like('address', $c);
 		$this->db->or_like('sex', $c);
 		$this->db->or_like('email', $c);
 		 */
 		$query = $this->db->get('pengguna_konsumen');
 		return $query->result();
 	}
 }
 
 
 /* End of File: pengguna_konsumen.php */
/* Location: ../www/modules/pengguna_konsumen.php */ 