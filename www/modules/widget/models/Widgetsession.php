<?php

/**
 * Wrapper for Codeigniter Session
 *
 * @author              Alexander Wenzel (alexander.wenzel.berlin@gmail.com)
 * @see                 https://bitbucket.org/alexwenzel/codeigniter-model
 *
 * @package             CodeIgniter Model
 * @version             1.0.0
 * @license             BSD
 *
 */
class Widgetsession {
	
	/**
	 *  Loads the Codeigniter session library and assign it to object name 'ci_session'
	 *
	 * @return		void
	 */
	public function __construct()
	{
		$CI = &get_instance();
		$CI->load->library('session','','ci_session');
	}
	
	/**
	 * Returns the Codeigniter session
	 *
	 * @return		object
	 */
	private static function get_ci_session()
	{
		$CI = &get_instance();
		
		return $CI->ci_session;
	}
	
	/**
	 * Adds Custom Session Data
	 *
	 * @param		string		$name
	 * @param		string		$value
	 * 
	 * @return		void
	 */
	public static function set($name, $value)
	{
		$ci_session = &self::get_ci_session();
		$ci_session->set_userdata($name, $value);
	}
	
	/**
	 * Returns Custom Session Data
	 *
	 * @param		string		$name
	 * 
	 * @return		mixed
	 */
	public static function get($name)
	{
		$ci_session = &self::get_ci_session();
		
		return $ci_session->userdata($name);
	}
	
	/**
	 * Removes Custom Session Data
	 *
	 * @param		string		$name
	 * 
	 * @return		void
	 */
	public static function delete($name)
	{
		$ci_session = &self::get_ci_session();
		$ci_session->unset_userdata($name);
	}
	
	/**
	 * Destroys a Custom Session
	 *
	 * @return		void
	 */
	public static function destroy()
	{
		$ci_session = &self::get_ci_session();
		$ci_session->sess_destroy();
	}
	
	/**
	 * Returns all Custom Session Data
	 * 
	 * @return		array
	 */
	public static function all()
	{
		$ci_session = &self::get_ci_session();
		
		return $ci_session->all_userdata();
	}
	
	/**
	 * Returns the Session ID (shorthand notation)
	 *
	 * @return		string
	 */
	public static function id()
	{
		return self::get('session_id');
	}
	
	/**
	 * Returns the Sessions ip_address (shorthand notation)
	 *
	 * @return		string
	 */
	public static function ip_address()
	{
		return self::get('ip_address');
	}
	
	/**
	 * Returns the Sessions user_agent (shorthand notation)
	 *
	 * @return		string
	 */
	public static function user_agent()
	{
		return self::get('user_agent');
	}
	
	/**
	 * Returns the Sessions last_activity (shorthand notation)
	 *
	 * @return		string
	 */
	public static function last_activity()
	{
		return self::get('last_activity');
	}
}