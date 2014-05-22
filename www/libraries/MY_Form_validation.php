<?php
/***************************************************************************************
 *                       			MY_Form_validation.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	MY_Form_validation.php
*      Created:   		2013 - 18.03.12 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
*		source:			http://aizuddinmanap.blogspot.com/2010/07/form-validation-callbacks-in-hmvc-in.html
*						Davic Connolly
*
****************************************************************************************/
class MY_Form_validation extends CI_Form_validation {

	// source: poll application @link : http://github.com/wookiemonster
	function __construct($config = array()) {
		parent::__construct($config);
	}

	/**
	 * Poll options required
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function poll_options_required($str)
	{
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}
	
	/*
	 * Callback HMVC Function
	 * 
	 * @access public
	 * @param  array
	 * @return boolean
	 */
	function run($module = '', $group = '') {
		(is_object($module)) AND $this->CI =& $module;
		return parent::run($group);
	}
}


/* End of File: MY_Form_validation.php */
/* Location: ../www/libraries/MY_Form_validation.php */