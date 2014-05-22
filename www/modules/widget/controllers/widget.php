<?php
/***************************************************************************************
 *                       			widget.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	widget.php
 *      Created:   		2013 - 07.19.16 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Widget extends MX_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		// IONAuth Library Default
 		$this->load->library(array('ion_auth','session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 		// Enable the output profiler so you can see the db queries run.
 		// $this->output->enable_profiler(TRUE);
 		$this->load->model('widget/widgetmodel');
 			
 		
 	}
 	
 	function debuk()
 	{
 		$this->load->model('widget/widgetsession');
 		
 		$data = $this->widgetsession->id();
 		
 		dump($data);
 	}
 	
 	function index()
 	{
 		if(!$this->ion_auth->is_admin())
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 		}
 		
 		if ($this->ion_auth->logged_in())
 		{
 			echo "This is only ADMIN PAGE USING";
 			echo br(2);
 			echo anchor('home', 'Kembali');
 		}
 	}
 	
 	/**
 	 * @author : Gede Lumbung
 	 * @source : http://gedelumbung.com
 	 * -----------------------------
 	 * @author	: shabiki || @emang_dasar
 	 * @keterangan : Method untuk melakukan backup database
 	 **/
 	function backup()
 	{
 		$this->load->helper(array('download','url','form'));
 			
 		if (!$this->ion_auth->is_admin())
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 			echo anchor('auth/login','Kembali');
 		}
 		else
 		{
 			$this->load->database();
 			
			$this->widgetmodel->manualQuery("TRUNCATE TABLE ci_sessions");
			// nama file
			$nama_file = 'backup-'.date('d-m-Y').'.txt.zip';
			// load database utility
			// see : 
			$this->load->dbutil();
			// simpan dalam variabel data
			$data =& $this->dbutil->backup();
			force_download($nama_file, $data);
			redirect(base_url().'home');
 		}
 	}
 	
 	
 	/**
 	 * @original : Gede Lumbung
 	 * @web : http://gedelumbung.com
 	 * -----------------------------
 	 * @author : shabiki || @emang_dasar
 	 * @keterangan : Method untuk manajemen restore data ke database
 	 **/
 	function restore()
 	{
 		$data['title'] = "Form Restore Data";
 		
 		if ($this->ion_auth->is_admin())
 		{
 			if ( ! $this->upload->do_upload())
 			{
 				$data['welcome'] = ucfirst($this->session->userdata('email'));
				$data['title']   = "Module Widget - Update Data";
				$data['widget']    = "widget"; // Controller
				$data['view']    = "restore_view"; // View
				$data['module']  = "widget"; // Controller
		
				echo Modules::run('template/admin',$data);
 			}
 			
 			$acak = rand(00000000000,99999999999);
 			$bersih = $_FILES['userfile']['name'];
 			$nm = str_replace(" ","_","$bersih");
 			
 			// 
 			$pisah = explode(".",$nm);
			$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
 			$nama_murni = date('Ymd-His');
 			$ekstensi_kotor = $pisah[1];

			$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
			$file_type_baru = strtolower($file_type);
			
			// tipe tanpa ekstensi
			$ubah = $acak;
			$n_baru = $ubah.'.'.$file_type_baru;
			
			//
			$in['gbr'] = $n_baru;
			
			// upload class standart codeigniter
			$config['upload_path'] = './assets/db_temp/';
			$config['allowed_types'] = 'txt';
			$config['max_size'] = '1000000';
			$config['max_width'] = '100';
			$config['max_height'] = '100';
			$config['file_name'] = $n_baru;
			$this->load->library('upload', $config);
			
			// jika tidak diupload tampilkan errur
			if(!$this->upload->do_upload())
			{
				echo $this->upload->display_errors();
			}
			else
			{
				// kondisikan dengan tabel di database!!
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE ci_sessions");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE users");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE groups");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE user_group");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE tbl_login");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE tbl_pelanggan");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE tbl_pesanan_detail");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE tbl_pesanan_header");
				$this->Widgetmodel->manualQuery("TRUNCATE TABLE tbl_surat_jalan");
				
				session_start();
				session_destroy();
				
				//
				$direktori = "./assets/db_temp/".$config['file_name'];
				$isi_file = file_get_contents($direktori);
				// hilangkan spasi di isifile
				$string_query = rtrim($isi_file, "\n;");
				$array_query = explode(";", $string_query);
				
				foreach ($array_query as $query)
				{
					$this->db->query($query);
				}
				// delete and back to site
				unlink($direktori);
				header('location:'.base_url().'user');
			}
			
  		}
 		else
 		{
 			echo 'Please dont do this';
 		}	
 	}
 	
 	function whoisonline()
 	{
 		echo "Still development";
 		echo br(2);
 		echo anchor('home','Kembali');
 	}
 }
 
 
 /* End of File: widget.php */
/* Location: ../www/modules/widget/widget.php */ 