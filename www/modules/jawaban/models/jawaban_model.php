<?php
/***************************************************************************************
 *                       			jawaban_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	jawaban_model.php
 *      Created:   		2013 - 08.48.20 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Jawaban_model extends MY_Model
 {
 	public $_table = 'jawaban';
 	public $primary_key = "jawaban_id";
 	
 	public $belongs_to = array( 'banksoal' => array( 'model' => 'soal_model', 
 													 'primary_key' => 'banksoal_id' ),
 								'dimensi' => array( 'model' => 'dimensi_model',
 													'primary_key' => 'dimensi_id' ),
 								'aturan' => array( 'model' => 'aturan_model',
 												   'primary_key' => 'aturan_id'),
 								'users' => array( 'model' => 'user_model', 
 												  'primary_key' => 'user_id' )
 								);
 	
  	//public $has_many = array( 'users' => array( 'model' => 'user_model' ));
  	
  	
  	
  	public function diharapkan()
  	{
  		$this->db->query("SELECT
  				s.pertanyaan,s.faktor,j.score,u.username,u.id,j.jawaban_id
  				FROM  jawaban AS j
  				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
  				INNER JOIN users AS u ON j.user_id = u.id
  				WHERE u.id = $id AND s.faktor = 'diharapkan'
  				GROUP BY j.jawaban_id
  				ORDER BY u.username ASC
  				")->result();
  		
  		return $this;
  	}
  	
  	public function dirasakan()
  	{
  		$this->db->query("SELECT
  				s.pertanyaan,s.faktor,j.score,u.username,u.id,j.jawaban_id
  				FROM  jawaban AS j
  				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
  				INNER JOIN users AS u ON j.user_id = u.id
  				WHERE u.id = $id AND s.faktor = 'dirasakan'
  				GROUP BY j.jawaban_id
  				ORDER BY u.username ASC
  				")->result();
  		
  		return $this;
  	}
  	/*
  	public function konsumen()
  	{
  		$q = $this->db->query("SELECT
  				j.jawaban_id,j.created,	j.score AS nilai,
  				u.username AS konsumen,
  				b.pertanyaan AS soal,
  				d.nama AS dimensi,	
  				b.faktor
  				FROM jawaban AS j
  				INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
  				INNER JOIN users AS u ON j.user_id = u.id
  				INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
  				ORDER BY b.faktor ASC	"); 		
  		return $this;
  	}
  	*/
 }
 
 
 /* End of File: jawaban_model.php */
/* Location: ../www/modules/jawaban_model.php */ 
