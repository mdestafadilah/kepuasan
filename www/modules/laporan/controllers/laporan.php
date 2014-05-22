<?php
/***************************************************************************************
 *                       			laporan.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	laporan.php
 *      Created:   		2013 - 04.16.08 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Laporan extends MX_Controller
 {
 	private $groups = array('manajer','direktur');
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->library('ion_auth');
 		$this->load->library('session');
 		$this->load->library('form_validation');
 		$this->load->helper('url');
 		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 		$this->load->helper(array('form','url'));
 	}
 	
 	function index()
 	{
 		// Still development...
 		
 	}
 	
 	function pdf() 
 	{
 		// Still development...
 		
 	}
 	
 	
 }
 
 
 /* End of File: laporan.php */
/* Location: ../www/modules/laporan.php */ 