<?php
/***************************************************************************************
 *                       			template.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	template.php
 *      Created:   		2012 - 17.24.46 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *		
 *		source: 		www.davidconnelly.com/hmvcstuff
 *						www.dcradionnetwork.com
 *
 ****************************************************************************************/
class Template extends MX_Controller
{
	function login($data)
	{
		$this->load->view('login', $data);
	}
	
	function admin($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('admin',$data);
		//$this->load->view('side_admin');
	}

	function konsumen($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('konsumen',$data);
	}
	
	function perawat($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('perawat',$data);
	}
	
	function manajer($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('manajer', $data);
	}
	
	function direktur($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('direktur', $data);
	}
	
	// Default Templates
	function members($data)
	{
		// Additional information
		$data['agen'] = $this->general->showAgent();
		$data['version'] = $this->config->item('sytem_version');
		$data['lisensi'] = $this->config->item('lisensi_app');
		$data['perusahaan'] = $this->config->item('nama_perusahaan');
		$data['programmer'] = $this->config->item('programmer');
		
		$this->load->view('members',$data);
	}

}
 
 
 /* End of File: template.php */
/* Location: ../www/modules/template.php */ 