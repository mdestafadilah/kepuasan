<?php
/***************************************************************************************
 *                       			user_model.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	user_model.php
*      Created:   		2013 - 11.06.47 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/
class User_model extends MY_Model
{
	public $_table = "users";
	public $primary_key = "id";
	
	public function rawat_konsumen()
	{
		$this->db->query();
		return ($this);
	}
	
	
	public function searching()
	{
		// sql : SELECT * FROM (`users`) WHERE  `username` LIKE '%admin%'
		// ar  : $this->db->like('username', $field);
		
		$field = $this->input->post('cari');
		$this->db->query("SELECT * FROM (`users`) WHERE  `username` LIKE '%$field%'");
		
// 		$this->db->like("username", $field);
// 		$this->db->or_like("email", $field);
// 		$this->db->or_like("active", $field);
// 		$this->db->or_like("address", $field);
// 		$this->db->or_like("dob", $field);
// 		$this->db->or_like("jawaban", $field);
// 		$this->db->get("users");
		
		return $this;
	}
	
	public function searching_perawat()
	{
		// sql : SELECT * FROM (`users`) WHERE  `username` LIKE '%admin%'
		// ar  : $this->db->like('username', $field);
	
		$field = $this->input->post('cari');
		$this->db->query("SELECT * FROM (`users`) WHERE  `first_name` LIKE '%$field%'");
		return $this;
	}
	
	public function searching_konsumen()
	{
		// sql : SELECT * FROM (`users`) WHERE  `username` LIKE '%admin%'
		// ar  : $this->db->like('username', $field);
	
		$field = $this->input->post('cari');
		$this->db->query("SELECT * FROM (`users`) WHERE  `first_name` LIKE '%$field%'");
		return $this;
	}
	
	
	
	
	
		
	/*
	 * Get Active user in AR Codeigniter, so we don't use it. :)
	* same as like:
	* $this->user_model->get_many_by('active',1);
	
	public function active_user()
	{
	// "SELECT * FROM (`users`) WHERE `active` = 1";
	$this->db->where('active', 1);
	return $this;
	}
	*/
		
	/*
	function getLastInserted() {
    	return $this->db->insert_id();
	}
	
	function getLastInserted() {
		$query ="SELECT $id as maxID from info where $id = LAST_INSERT_ID()";
		return $query; //line 69
	}
	*/
	
	//$this->table = 'groups';	
	/*
	function get_groups($options = array())
	{
		$query = $this->db->get($this->table);
		foreach ($query->result() as $row) {
			$options[$row->id] = $row->name;
		}
		return $options;
	}
	*/
}


/* End of File: user.php */
/* Location: ../www/modules/user_model.php */