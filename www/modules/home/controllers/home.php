<?php
/***************************************************************************************
 *                       			home.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	home.php
 *      Created:   		2012 - 10.58.10 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/

/*
 * Default Template for routes all user in system
 * 
 * @access: Public
 * @role: admin,perawat,konsumen,direktur dan manajer or non-members
 */

class Home extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		
	}
	
	/*
	 * Handle some routes user
	 * -----------------------
	 */
	public function index()
	{
		if ($this->ion_auth->logged_in())
		{
			// pengecekan session user with ion_auth 
			if($this->ion_auth->is_admin()) { redirect(base_url().'user/admin'); }
			if($this->ion_auth->in_group('manajer')) { redirect(base_url().'user/manajer');}
			if($this->ion_auth->in_group('direktur')) { redirect(base_url().'user/direktur');}
			if($this->ion_auth->in_group('perawat')) { redirect(base_url().'user/perawat');}
			if($this->ion_auth->in_group('konsumen')) { redirect(base_url().'user/konsumen'); }	
		}
		else
		{
			// tampilkan default error page
			show_404();
		}
	}
	
	
}
 
 /* End of File: home.php */
/* Location: ../www/modules/home.php */ 