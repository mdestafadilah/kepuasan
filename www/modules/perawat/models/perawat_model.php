<?php
/***************************************************************************************
 *                       			perawat_model.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	perawat_model.php
 *      Created:   		2013 - 06.12.41 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
class Perawat_model extends MY_Model 
{
	public $_table = "perawat";
	public $primary_key = "perawat_id";

	public $belongs_to = array( 'users' );
	
	
	/*
	public $validate = array(
			array(
					'field' => 'first_name',
					'label' => 'Nama Depan',
					'rules'   => 'required'
			),
			array(
					'field' => 'last_name',
					'label' => 'Nama Belakang',
					'rules'   => 'required'
			),
			array(
					'field' => 'jenkel',
					'label' => 'Jenis Kelamin',
					'rules'   => 'required'
			),
			array(
					'field' => 'dob',
					'label' => 'Tanggal Lahir',
					'rules'   => 'required'
			),
			array(
					'field' => 'jenis',
					'label' => 'Jenis Merawat',
					'rules'   => 'required'
			),
			array(
					'field' => 'alamat',
					'label' => 'Alamat Asal',
					'rules'   => 'required'
			),
			array(
					'field' => 'user_id',
					'label' => 'ID Login',
					'rules'   => 'required'
			),
			array(
					'field' => 'foto',
					'label' => 'Foto Perawat',
					'rules'   => 'required'
			),
			array(
					'field' => 'ijasah',
					'label' => 'Ijasah Perawat',
					'rules'   => 'required'
			),	
		);
	*/
		
	/*
	 * Perfect Model by David Connely

	function get_table() {
		$table = 'perawat';
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

	function get_where($id){
		$table = $this->get_table();
		$this->db->where('id', $id);
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

	function _update($id, $data){
		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}

	function _delete($id){
		$table = $this->get_table();
		$this->db->where('id', $id);
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
		$this->db->select_max('id');
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
 
 /* End of File: perawat_model.php */
/* Location: ../www/modules/perawat_model.php */ 