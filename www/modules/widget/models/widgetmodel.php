<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Widgetmodel extends CI_Model
{
	function manualQuery($q)
	{
		$this->db->query($q);
		return $this;
	}
	
	function getGuestOnline()
	{
		return $this->db->count_all('ci_sessions');
	}
	
	
	
	/*
	function Widgetmodel()
	{
		parent::Model();
		$this->updateLastActivity();
	}
	
	
	function getGuestOnline()
	{
		return $this->db->count_all('ci_sessions');
	}
	function getUserOnline()
	{
		$now = time();
		$data = $this->db->get('online');
		$all = $data->num_rows();
		$not_ol = 0;
		foreach($data->result() as $row)
		{
			$user_id = $row->user_id;
			$old = $row->last_activity;
			if($this->isNotOnline($old,$now))
			{
				$not_ol += 1;
			}
		}
		return $all-$not_ol;
	}
	function whosonline()
	{
		$now = time();
		$data = $this->db->get('online');
		$all = $data->num_rows();
		$arr = array();
		foreach($data->result() as $row)
		{
			$user_id = $row->user_id;
			$old = $row->last_activity;
			if(!$this->isNotOnline($old,$now) && $user_id != from_session('user_id'))
			{
				$arr[] = $user_id;
			}
		}
		return $arr;
	}
	function updateLastActivity()
	{
		$user_id = $this->session->userdata('user_id');
		if($user_id !='')
		{
			$this->db->where('user_id',$user_id);
			$this->db->update('online',array('last_activity'=>time()));
		}
	}	
	function isNotOnline($old,$now)
	{
	    if($old == '' OR $now == '')
	    {
	       return TRUE;
	    }
		$old_y = date('Y',$old);
		$old_m = date('n',$old);
		$old_d = date('j',$old);
		$old_g = date('G',$old);
		$old_i = date('i',$old);
		//$old_s = date('s',$old);
		$now_y = date('Y',$now);
		$now_m = date('n',$now);
		$now_d = date('j',$now);
		$now_g = date('G',$now);
		$now_i = date('i',$now);
		//$now_s = date('s',$now);
		//start checking
		if($now_y!=$old_y){return TRUE;}
		if($now_m!=$old_m){return TRUE;}
		if($now_d!=$old_d){return TRUE;}
		if($now_g!=$old_g){return TRUE;}
		// ignore second
		$diff_minute = $now_i - $old_i;
		if($diff_minute >= 10)
		{ 
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function getMessage($id)
	{
		// private
		$user = $this->session->userdata('user_id');
		$this->db->select('message_status');
		$this->db->from('message');
		$this->db->where('message_for',$id);
		$res = $this->db->get();
		$arr = array();
		$count = 0;
		foreach($res->result() as $row)
		{
		$stat = $row->message_status;
		$arr = explode(',',$stat);
		if(!in_array($user,$arr))
		{   
		    $count += 1;
		}
		}
		// public
		$user = $this->session->userdata('user_id');
		$this->db->select('message_status');
		$this->db->from('message');
		$this->db->where('message_for',0);
		$res = $this->db->get();
		$arr = array();
		$count2 = 0;
		foreach($res->result() as $row)
		{
			$stat = $row->message_status;
			$arr = explode(',',$stat);
			if(!in_array($user,$arr))
			{   
			    $count2 += 1;
			}
		}
		$data[] = $count;
		$data[] = $count2;
		if($count+$count2>0)
		{
			return ("Ada ".($count+$count2)." pesan untuk Anda.<br />Cek di Tools->Pesan...");
		}
		else
		{
			return false;
		}
		//return $data;
	}
	function getSpecific($id,$primary,$key,$table,$as='')
	{
		$this->db->select($key);
		$this->db->from($table);
		$this->db->where($primary,$id);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
			$row=$res->row();
			if($as != '')
				$key = $as;
			return $row->$key;
		}
	}
	function get_info_user()
	{
		$level = $this->getSpecific(from_session('level'),'level_id','level_nama','level');
		$unit = $this->getSpecific(from_session('unit'),'unit_id','unit_nama','tk_unit');
		return 'Anda login sebagai <b>'.strtoupper(str_replace('_',' ',$level)).'</b> Unit Kerja <b>'.$unit.'</b>';
	}
	
	*/
}
