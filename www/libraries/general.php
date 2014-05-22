<?php
/***************************************************************************************
 *                       			general.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	general.php
 *      Created:   		2013 - 11.48.24 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class General 
 {
 	function General()
 	{
 		$this->CI =& get_instance();
 		$this->CI->load->library(array('user_agent','session'));
 		//$this->no_ie();
 	}
 	
 	/*
 	 * Show The Browser User detect
 	 * 
 	 * Original from: User Agent Library
 	 * ------------------------
 	 * How to use:
 	 * 1. Load this library to your controller or autoload file in config folder
 	 * 2. Put this to your views file like -> $agen = $this->general->showAgent(); echoing with array like $agen['agent'];
 	 * 3. It's done, more info look this -> http://ellislab.com/codeigniter/libraries/user_agent.html
 	 * 
 	 * @output TRUE
 	 * 
 	 */
 	function showAgent()
 	{
 		if ($this->CI->agent->is_browser())
 		{
 			$agent = $this->CI->agent->browser().' '.$this->CI->agent->version();
 		}
 		elseif ($this->CI->agent->is_robot())
 		{
 			$agent = $this->CI->agent->robot();
 		}
 		elseif ($this->CI->agent->is_mobile())
 		{
 			$agent = $this->CI->agent->mobile();
 		}
 		else
 		{
 			$agent = 'Not Detected';
 		}
 		
 		$data['agent'] = $agent;
 		$data['platform'] = $this->CI->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
 
 		return $data;
 	}
 	/*
 	 * @author : Anggy Trisnawan
 	 * @package: Project
 	 * @version: 0.1
 	 * @modif  : shabiki || @emang_dasar
 	 */
 	
 	/*
 	function no_ie()
 	{
 		if ($this->showAgent() == false)
 		{
 			$agen = $this->showAgent();
 			$browser = $agen['agent'];
 			if(stristr($browser,'internet') != FALSE)
 			{
 				exit('Anda tidak diperbolehkan menggunakan browser Internet Explorer');
 			}
 		}
 	}
 	*/
 	
 	function cekLingkungan() 
 	{
 		define('ENVIRONMENT', 'development');
 			
	 	if (defined('ENVIRONMENT'))
	 	{
	 		switch (ENVIRONMENT)
	 		{
	 			case 'development':
						error_reporting(E_ALL | E_STRICT);
	 					 break;
	 	
	 			case 'testing':
	 			case 'production':
						error_reporting(0);
	 					 break;
	 	
	 			default:
	 				exit('The application environment is not set correctly.');
	 		}
	 	}
 	}
 	
 	
 	/*
 	 * Show success notif with
 	 * 
 	 * @author	: shabiki || @emang_dasar
 	 * @package : Sistem Kepuasan  
 	 * @version : 0.12.1 
 	 */
 	function showSuccess()
 	{
 		// TODO ..
 	}
 	
 	/*
 	 * Show success notif with
 	*
 	* @author	: shabiki || @emang_dasar
 	* @package : Sistem Kepuasan
 	* @version : 0.12.1
 	*/
 	function showError()
 	{
 		// TODO ..
 	}
 }
 
 
 /* End of File: general.php */
/* Location: ../www/modules/general.php */ 