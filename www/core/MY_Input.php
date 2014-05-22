<?php
/***************************************************************************************
 *                       			MY_Input.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	MY_Input.php
 *      Created:   		2013 - 11.26.53 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
class MY_Input extends CI_Input
{
	function save_query($query_array)
 	{
 		$CI =& get_instance();
 		$CI->db->insert('fquery', array('query_string' => http_build_query($query_array)));
 		return $CI->db->insert_id();
 	}
	
	function load_query($query_id)
	{
		$CI =& get_instance();
		$rows = $CI->db->get_where('fquery', array('id' => $query_id))->result();
		if (isset($rows[0]))
		{
			parse_str($rows[0]->query_string, $_GET);
		}
		
	}
	/*
	 * source: http://ellislab.com/forums/viewthread/163328/
	 * and call by inserting
	 * $this->input->dump_post();
	 * into your code.
	 */
	function dump_post()
	{
		$post = array();
		foreach ( array_keys($_POST) as $key )
		{
			$post[$key] = $this->post($key);
		}
		echo '<pre>'; var_dump($post); echo '</pre>';
	}		
}
 
 
 /* End of File: MY_Input.php */
/* Location: ../www/modules/MY_Input.php */ 