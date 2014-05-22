<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This get from STIKES Inventory Stock App
 * 
 */
Class Simpliparse
{
	function Simpliparse()
	{
		$this->SP =& get_instance();
		$this->SP->load->library('form_validation');		
	}
	
	function build_select_common($name,$data,$value,$mid,$title,$tamb='',$delimiter=' - ')
	{
		$result='';
		if(is_array($mid))
		{
			foreach($data->result() as $row)
			{	
			    $str = array();
			    foreach($mid as $val)
    		    {
    		      if($row->$val != '')
    		          $str[] = $row->$val;
    		    }
    		    $str_jadi = implode($delimiter,$str);
    			$opt='<option value=\''.$row->$value.'\' '.$this->SP->validation->set_select($name,$row->$value).' >'.$str_jadi.'</option>';
    			$result = $result.$opt;
			}
		}else{
			foreach($data->result() as $row)
			{	
				$opt='<option value=\''.$row->$value.'\' '.$this->SP->form_validation->set_select($name,$row->$value).'>'.$row->$mid.'</option>';
				$result=$result.$opt;
			}
		}
		return '<select name=\''.$name.'\' '.$tamb.' ><option value=\'\'>'.$title.'</option>'
			.$result.
			'</select>';
	}
    
    function build_select_day($name)
	{
		$result='';
		for($i=1;$i<=31;$i++)
		{
			$lebar=strlen($i);
			switch($lebar)
			{
			case 1:
			{
				$day="0".$i;
				break;
			}
			case 2:
			{
				$day=$i;
				break;
			}
			}
			$opt='<option value=\''.$day.'\' '
			.$this->SP->form_validation->set_select($name,$day).'>'.$day.'</option>';
			$result=$result.$opt;
		}
		echo '<select name=\''.$name.'\' class="day_select"><option value=\'00\'>:: Tgl ::</option>'
			.$result.
			'</select>';
	}
	function build_select_month($name,$tamb='')
	{	
		$result='';
		$namabulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus",
				"September","Oktober","November","Desember");
		for($j=1;$j<=12;$j++)
		{
			$lebar=strlen($j);
			switch($lebar)
			{
			case 1:
			{
				$mon="0".$j;
				break;
			}
			case 2:
			{
				$mon=$j;
				break;
			}
			}
			$opt='<option value=\''.$mon.'\' '
			.$this->SP->form_validation->set_select($name,$mon).'>'.$namabulan[$j].'</option>';
			$result=$result.$opt;
		}
		echo '<select name=\''.$name.'\' class="month_select"  '.$tamb.' ><option value=\'00\'>:: Bulan ::</option>'
			.$result.
			'</select>';
	} 
	function build_select_year($name)
	{
		$result='';
		for($k = date("Y") - 50; $k <= date("Y") - 16; $k++)
		{			   
			$opt='<option value=\''.$k.'\' '
			.$this->SP->form_validation->set_select($name,$k).'>'.$k.'</option>';
			$result=$result.$opt;
		}	  
		echo '<select name=\''.$name.'\' class="year_select"><option value=\'00\'>:: Tahun ::</option>'
			.$result.
			'</select>';
	}
}
