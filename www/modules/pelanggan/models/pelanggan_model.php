<?php
/***************************************************************************************
 *                       			pelanggan_model.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	pelanggan_model.php
*      Created:   		2013 - 21.07.11 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/

class Pelanggan_model extends MY_Model
{
	public $_table = 'konsumen';
	public $primary_key = 'konsumen_id';
	
	public $belongs_to = array( 'users' => array( 'model' => 'user_model' ) );
	public $has_many = array( 'perawat' => array( 'model' => 'perawat_model' ) );
	
	var $gallerypath;
	var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallerypath = realpath(APPPATH . '../assets/poto');
		$this->gallery_path_url = base_url().'@riset-kepuasan/assets/poto/';
	}
	
	
	
	/*
	 * Perfect Model by David Connely
	 *
	
	function get_table() {
		$table = "konsumen";
		return $table;
	}
		
	function get($order_by){
		$table = $this->get_table();
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		return $query;
	}
	
	function get_with_limit($limit, $offset, $order_by) {
		$table = $this->get_table();
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		return $query;
	}
	
	function get_where($konsumen_id){
		$table = $this->get_table();
		$this->db->where('konsumen_id', $konsumen_id);
		$query=$this->db->get($table);
		return $query;
	}
	
	function get_where_custom($col, $value) {
		$table = $this->get_table();
		$this->db->where($col, $value);
		$query=$this->db->get($table);
		return $query;
	}
	
	function _insert($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}
	
	function _update($konsumen_id, $data){
		$table = $this->get_table();
		$this->db->where('konsumen_id', $konsumen_id);
		$this->db->update($table, $data);
	}
	
	function _delete($konsumen_id){
		$table = $this->get_table();
		$this->db->where('konsumen_id', $konsumen_id);
		$this->db->delete($table);
	}
	
	function count_where($column, $value) {
		$table = $this->get_table();
		$this->db->where($column, $value);
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all() {
		$table = $this->get_table();
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max() {
		$table = $this->get_table();
		$this->db->select_max('konsumen_id');
		$query = $this->db->get($table);
		$row=$query->row();
		$id=$row->id;
		return $id;
	}
	
	function _custom_query($mysql_query) {
		$query = $this->db->query($mysql_query);
		return $query;
	}
	*/
}


/* End of File: pelanggan_model.php */
/* Location: ../www/modules/pelanggan_model.php */