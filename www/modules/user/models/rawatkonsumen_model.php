<?php
/***************************************************************************************
 *                       			rawat_konsumen.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	rawat_konsumen.php
 *      Created:   		2013 - 22.11.29 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Rawatkonsumen_model extends MY_Model
 {
 	public $_table = "rawatkonsumen";
 	public $primary_key = "id";
 	
 	protected $belongs_to = array( 'users' );
 	// protected $has_many = array();
 	
 	public function get_info()
 	{
 		/* $this->db->query("
 				SELECT
				userkonsumen.username AS `Nama Konsumen`,
				userperawat.username AS `Nama Perawat`,
				userperawat.elderly AS `Jenis Rawat`,
				userkonsumen.address AS `Alamat Konsumen`
				FROM
				rawatkonsumen AS rawat
				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id		
 				"); */
 		
 		$this->db->select('username','username','elderly','address');
 		$this->db->from('rawatkonsumen');
 		$this->db->join('users','');
 		$this->db->join('users','');
 		 		
 		return $this;
 	} 	
 }
 
 
 /* End of File: rawat_konsumen.php */
/* Location: ../www/modules/rawat_konsumen.php */ 