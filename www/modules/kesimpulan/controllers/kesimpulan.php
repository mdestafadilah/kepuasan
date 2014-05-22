<?php
/***************************************************************************************
 *                       			kesimpulan.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	kesimpulan.php
 *      Created:   		2013 - 15.37.07 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 ****************************************************************************************/
 class Kesimpulan extends MX_Controller 
 {
 	function __construct()
 	{
 		parent::__construct();
 		// IONAuth
 		$this->load->library(array('pagination','ion_auth','session','form_validation'));
 		$this->load->helper('url');
 		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 		// Model
 		$this->load->model(array(
 					'kesimpulan/kesimpulan_model',
 					'dimensi/dimensi_model'
 				));

 	}
 	
 	function index()
 	{
 		if ( $this->ion_auth->is_admin() || $this->ion_auth->in_group(array('direktur','manajer'))){ $this->_manage(); }
 		if ( $this->ion_auth->in_group('perawat')) { $this->akhir(); }
 	}
 	
 	function _manage()
 	{
 		// paging
 		$this->load->library('pagination');
 		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
 		
 		$uri_segment = 3	;
 		$data['offset'] = $this->uri->segment($uri_segment);
 		
 		$config['base_url'] = base_url().'kesimpulan/index/';
 		$config['total_rows'] = $this->kesimpulan_model->count_all();
 		$config['per_page'] = 3;
 		$config['next_link'] = '<li>Selanjutnya</li>';
 		$config['prev_link'] = '<li>Sebelumnya</li>';
 		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a> Halaman Ke -';
 		$config['cur_tag_close'] = '</li>';
 		
 		$this->pagination->initialize($config);
 		$data['paging'] = $this->pagination->create_links();
 		
 		$data['limit'] = $config['per_page'];
 		
 		// all soal as object as object :)
 		$data['results'] = $this->kesimpulan_model
 								->as_array()
						 		->limit($data['limit'], $data['offset'])
						 		->get_all();
 			
 		// render a template
 		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 		$data['title'] 		= "Modul Kesimpulan - Daftar Kesimpulan";
 		$data['module'] 	= "kesimpulan"; // module
 		$data['kesimpulan'] = "kesimpulan"; // controller
 		$data['view'] 		= "kesimpulan_view"; // view
 			
 		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 		}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 		}
 		if($this->ion_auth->in_group('direktur')) {
 			echo Modules::run('template/direktur', $data);
 		}
 	}
 	
 	/*
 	 * Fungsi untuk menambahkan kesimpulan
 	 * --
 	 * 
 	 */
 	function add()
 	{
 		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('auth/login', 'Login');
 		}
 		
 		// Admin dan Manajer can do this
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 			// buat aturan dulu
 			$this->form_validation->set_rules('kesimpulan','Kesimpulan','required');
 			$this->form_validation->set_rules('dimensi','Dimensi','required');
 		}
 			
 		if ($this->form_validation->run() == true)
 		{
 			$data = array(
 					'kesimpulan' 	=> $this->input->post('kesimpulan'),
 					'dimensi' 		=> (implode(",",$this->input->post('dimensi'))),
 			);
 		}
 			
 		if ($this->form_validation->run() == true
 				&& $this->kesimpulan_model->insert($data))
 		{
 			//dump($_POST); exit;
 			$this->session->set_flashdata('message', "<div class=\"alert alert-success\"> <a class=\"close\" data-dismiss=\"alert\">X</a>Kesimpulan Berhasil Ditambahkan </div>");
 			redirect('kesimpulan/index','refresh');
 		}
 		else
 		{
 			// populate data
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"> <a class="close" data-dismiss="alert">X</a>'. validation_errors().'</div>' : $this->session->flashdata('message'));
 			
 			$data['kesimpulan'] = array(
 					'name'  => 'kesimpulan',
 					'id'    => 'kesimpulan',
 					'type'  => 'text',
 					'value' => $this->form_validation->set_value('kesimpulan'),
 			);
 				
 			// render template
 			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
 			$data['title'] 		= "Modul Kesimpulan - Tambah Kesimpulan";
 			$data['module'] 	= "kesimpulan"; // module
 			$data['kesimpulan']	= "kesimpulan"; // controller
 			$data['view'] 		= "kesimpulan_form"; // view
 		
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 		}
 	}
 	
 	// belum bekerja
 	function update($kesimpulan_id = null)
 	{
 		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('soal/index', 'Kembali');
 		}
 			
 		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
 		{
 				
 			$kesimpulan = $this->kesimpulan_model->get($kesimpulan_id); // an object of soal
 		
 			$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'required');
 			$this->form_validation->set_rules('dimensi', 'Dimensi', 'required');
 		
 			// cek hasil ketik
 			if (isset($_POST) && !empty($_POST))
 			{
 				$data = array(
 						'kesimpulan' => $this->input->post('kesimpulan'),
 						'dimensi' 		=> (implode(",",$this->input->post('dimensi'))),
 						);
 		
 				// jika bedul
 				if ($this->form_validation->run() == TRUE &&
 						$this->kesimpulan_model->update($kesimpulan->kesimpulan_id, $data))
 				{
 					$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Kesimpulan sudah terupdate! </div>");
 					redirect('kesimpulan/index', 'refresh');
 				}
 			}
 		
 			// Populate
 			$data['single'] = $kesimpulan;
 		
 			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));
 	
 			$data['kesimpulan'] = array(
 					'name'  => 'kesimpulan',
 					'id'    => 'kesimpulan',
 					'type'  => 'text',
 			);
 			
 			$data['dimensi'] = array(
 					'name'  => 'dimensi',
 					'id'    => 'dimensi',
 					'type'  => 'text',
 			);
 		
 			// render template
 			$data['welcome'] = ucfirst($this->session->userdata('email'));
 			$data['title'] = "Modul Kesimpulan - Ubah Data Kesimpulan";
 			$data['module'] = "kesimpulan"; // module
 			$data['kesimpulan'] = "kesimpulan"; // controller
 			$data['view'] = "kesimpulan_form"; // view
 				
 			if($this->ion_auth->is_admin()) {
 				echo Modules::run('template/admin',$data);
 			}
 			if($this->ion_auth->in_group('manajer')) {
 				echo Modules::run('template/manajer', $data);
 			}
 		}
 	}
 	
 	function delete($kesimpulan_id = null)
 	{
 		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
 		{
 			echo 'You don\'t have an access';
 			echo br(2);
 			echo anchor('kesimpulan/index','Kembali');
 		}
 			
 		/*
 		 * Admin done
 		*/
 		elseif ($this->ion_auth->is_admin()
 				&& $this->kesimpulan_model->delete($kesimpulan_id))
 		{
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Kesimpulan berhasil dihapus!</div>");
 			redirect('kesimpulan/index');
 		}
 		/*
 		 * Manajer done
 		*/
 		elseif ($this->ion_auth->in_group('manajer')
 				&& $this->kesimpulan_model->delete($kesimpulan_id))
 		{
 			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Kesimpulan berhasil dihapus!</div>");
 		
 			redirect('kesimpulan/index');
 		}
 	}
 	
 	function do_publish($kesimpulan_id)
 	{
 		// cek harus manajer yang lakukan fungsi ini
 		if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manajer'))
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 			echo anchor("kesimpulan/index", "Kembali");
 		}
 		else
 		{
 			$this->db->where("kesimpulan_id", $kesimpulan_id);
 			$this->db->set("publish", 1);
 			$this->db->update("kesimpulan");
 			$this->session->set_flashdata('message', "Kesimpulan Sudah aktif");
 			redirect("kesimpulan/index");
 		}
 	}
 	
 	function do_unpublish()
 	{
 		// cek harus manajer yang lakukan fungsi ini
 		if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manajer'))
 		{
 			echo "You don\'t have an access";
 			echo br(2);
 			echo anchor("kesimpulan/index", "Kembali");
 		}
 		else
 		{
 			$this->db->where("kesimpulan_id", $kesimpulan_id);
 			$this->db->set("publish", 0);
 			$this->db->update("kesimpulan");
 			$this->session->set_flashdata('message', "Kesimpulan Sudah tidak aktif");
 			redirect("kesimpulan/index");
 		}
 	}
 	
 	/*
 	 * Use:
 	 * $ks[] = array('0','1','2','3');
 	 * $data = $this->explode_trim($ks['kesimpulan']);
 	 */
 	function _explode_trim($str, $delimiter = ',') 
 	{
 		if ( is_string($delimiter) ) {
 			$str = trim(preg_replace('|\\s*(?:' . preg_quote($delimiter) . ')\\s*|', $delimiter, $str));
 			return explode($delimiter, $str);
 		}
 		return $str;
 	}
 	
 	function debuk()
 	{
 		/* 
 		$kesimpulan = $this->kesimpulan_model->as_array()->get_all();
 		
 		foreach ($kesimpulan as $ks)
 		{
 			//$data = array_map('trim',explode(',', $ks['kesimpulan']));
 			
 			$data = $this->_explode_trim($ks['dimensi']);
 			
 			echo $data[0];
 			dump($data);	
 		}
 		 */
 		
 		$cek_dimensi = $this->db->query(" SELECT
							 				a.nilai,
							 				userperawat.id AS perawat_id,
							 				d.nama
							 				FROM
							 				rawatkonsumen AS rawat
							 				INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							 				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							 				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							 				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							 				INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							 				INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							 				WHERE
							 				perawat_id = 69
							 				ORDER BY
							 				s.dimensi_id ASC ")->result_array();
 		
 		foreach ($cek_dimensi as $cd )
 		{
 			$test = $cd['nama'].",";
 			echo $test;
 		}
 		
 		//if (in_array("kehandalan", $test)) { echo "ada"; }
 		
 		dump($cek_dimensi);
 	}
 	
 	/*
 	 * Fungsi untuk menampilkan kesimpulan, berdasarkan teori kepuasan service quality
 	 * 
 	 */
 	function akhir()
 	{
 		$id = $this->session->userdata('user_id');
 		$kesimpulan = $this->kesimpulan_model->as_array()->get_all();

 		$data['pasangan'] = $this->db->query("SELECT
 				userkonsumen.last_name AS nama_konsumen,
 				userperawat.username AS nama_perawat,
 				userkonsumen.id
 				FROM
 				rawatkonsumen AS rawat
 				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
 				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
 				WHERE
 				userperawat.id = $id")->row();
 		
 		$detail_kesimpulan = $this->db->query(" SELECT
							 				a.nilai,
							 				userperawat.username AS perawat_nama,
							 				userkonsumen.username AS konsumen_nama,
							 				userkonsumen.id AS konsumen_id,
							 				userperawat.id AS perawat_id,
							 				s.faktor,
							 				d.nama
							 				FROM
							 				rawatkonsumen AS rawat
							 				INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							 				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							 				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							 				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							 				INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							 				INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							 				WHERE
							 				perawat_id = $id ")->result_array();

 		$hitung_faktor = $this->db->query(" SELECT
							 				Sum(a.nilai) AS total_nilai,
							 				Count(a.nilai) AS total_soal,
							 				a.nilai,
							 				userperawat.id AS perawat_id,
							 				s.faktor,
							 				d.nama
							 				FROM
							 				rawatkonsumen AS rawat
							 				INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							 				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							 				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							 				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							 				INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							 				INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							
							 				WHERE
							 				perawat_id = $id
							
							 				GROUP BY
							 				s.faktor ")->result_array();
 			
 		$cek_dimensi = $this->db->query(" SELECT
							 				a.nilai,
							 				userperawat.id AS perawat_id,
							 				d.nama
							 				FROM
							 				rawatkonsumen AS rawat
							 				INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							 				INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							 				INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							 				INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							 				INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							 				INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							 				WHERE
							 				perawat_id = $id
							 				ORDER BY
							 				s.dimensi_id ASC ")->result();
 		/*
 		 * Hitung Per Faktor
 		 * ------
 		 * Teori hitung berdasarkan journal kepuasan pelanggan
 		 * 
 		 */
 		// Faktor Dirasakan
 		$rasa_nilai = $hitung_faktor[0]['total_nilai'];
 		$rasa_soal = $hitung_faktor[0]['total_soal'];
 		
 		// Faktor Diharapkan
 		$harap_soal = $hitung_faktor[1]['total_soal'];
 		$harap_nilai= $hitung_faktor[1]['total_nilai'];
 		
 		$hasil_harap = $harap_nilai / $harap_soal;
 		$hasil_rasa = $rasa_nilai / $rasa_soal;
 		// ----------------------------------------------------
 		
 		$data['hasil_harap'] = $hasil_harap;
 		$data['hasil_rasa'] = $hasil_rasa;
 		
		// render template
 		$data['welcome'] = ucfirst($this->session->userdata('email'));
 		$data['title'] = "Modul Kesimpulan - Kesimpulan Perawat";
 		$data['module'] = "kesimpulan"; // module
 		$data['kesimpulan'] = "kesimpulan"; // controller
 		$data['view'] = "kesimpulan_perawat"; // view
 			
 		echo Modules::run('template/perawat',$data);
 	}
 }
 
 
 /* End of File: kesimpulan.php */
/* Location: ../www/modules/kesimpulan.php */ 