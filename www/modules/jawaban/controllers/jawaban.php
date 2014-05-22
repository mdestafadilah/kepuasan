<?php
/***************************************************************************************
 *                       			jawaban.php
***************************************************************************************
*      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
*      Website:    	http://www.twitter.com/emang_dasar
*
*      File:          	jawaban.php
*      Created:   		2013 - 11.23.47 WIB
*      Copyright:  	(c) 2012 - desta
*                  	DON'T BE A DICK PUBLIC LICENSE
* 						Version 1, December 2009
*						Copyright (C) 2009 Philip Sturgeon
*
****************************************************************************************/
class Jawaban extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('pagination','ion_auth','session','form_validation'));
		$this->load->model(array('aturan/aturan_model','jawaban/jawaban_model','soal/soal_model','user/user_model','dimensi/dimensi_model'));

		// Enable Profiler
		// $this->output->enable_profiler(TRUE);
			
	}
	
	function debuk3()
	{
		/* 
		$kecewa 	= array(0,40,65); // array[0]
		$biasa 		= array(40,65,80); // array[1]
		$puas 		= array(65,80,100); // array[2]
		
		$kb = array_intersect($kecewa, $biasa); // kecewa-biasa output: 40,65
		$bp = array_intersect($biasa, $puas); // biasa-puas output: 65,80
		dump($kb);
		dump($bp);
		 */
		
		$this->load->model('himpunan/himpunan_model');
		$id = 1;
		$data = $this->himpunan_model->get($id);
		dump($data);
		
	}
	
	function debuk2()
	{
		/* 
		$jawaban_id = 60;
		
		$data = $this->jawaban_model->as_array()->get($jawaban_id);
		
		$user_id = $data['user_id'];
		$banksoal_id = $data['banksoal_id'];
		
		$kueri = $this->db->query("  SELECT DISTINCT
				u.username,
				u.id AS user_id,
				d.dimensi_id,
				j.jawaban_id,
				b.pertanyaan,
				j.created,
				Sum(aturan.nilai) AS total_nilai,
				COUNT(aturan.nilai) AS total_soal
				FROM
				jawaban AS j
				INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
				INNER JOIN users AS u ON j.user_id = u.id
				INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
				INNER JOIN aturan ON j.aturan_id = aturan.aturan_id
				WHERE
				b.dimensi_id = 1 AND j.`status` = 1 AND u.id = $user_id
				GROUP BY
				u.username
				ORDER BY
				u.username ASC ")->row_array();
		
		dump($kueri);
		br(2);
		$dimensi_id = $kueri['dimensi_id'];
		$jawaban_id = $kueri['jawaban_id'];
		
		// Hitung
		$tot_nilai = $kueri['total_nilai'];
		$tot_soal = $kueri['total_soal'];
		*/
		
		// simpan ke muFire
		$hasil = $tot_nilai/$tot_soal; 
		
		// tentukan batasan terhadap nilai, bisa aja dinamis
		$kecewa 	= array(0,40,65); // array[0]
		$biasa 		= array(40,65,80); // array[1]
		$puas 		= array(65,80,100); // array[2]
		
		// bagi bagi nilai yang sama
		$kb = array_intersect($kecewa, $biasa); // kecewa-biasa output: 40,65
		$bp = array_intersect($biasa, $puas); // biasa-puas output: 65,80
			
		// test : http://3v4l.org/d4oiO atau http://3v4l.org/qkanO
		
		if ( $hasil >= $bp[1] && $hasil <= $bp[2] )
		{
			
			# ($hasil - $kb[1]) / ($kb[2] - $kb[1])
		    $muBiasa = ($hasil >= $bp[2]) ? "0" : ($hasil <= $bp[2] ? ($bp[2] - $hasil) / ($bp[2] - $bp[1]) : "0.5" );
			$muPuas = ($hasil - $bp[1]) / ($bp[2] - $bp[1]);
				
			$update_data = array(
					'MuBiasa' 		=> $muBiasa,
					'MuPuas'		=> $muPuas,
					'MuFire'		=> $hasil,
					'user_id'		=> $user_id,
					'banksoal_id'	=> $banksoal_id,
					'dimensi_id'	=> $dimensi_id,
			);
			
			$this->db->set($update_data);
			$this->db->insert('mu');
			
			$this->db->set('status','0')
					 ->where('jawaban_id', $jawaban_id)
					 ->update('jawaban') ;
		}
		// antara 40 - 65
		elseif ( $hasil >= $kb[1] && $hasil < $kb[2] )
		{
			$muKecewa = ($kb[2] - $hasil) / ($kb[2] - $kb[1]);
			$muBiasa = ($hasil - $kb[1]) / ($kb[2] - $kb[1]);
				
			$update_data = array(
					'MuKecewa' 		=> $muKecewa,
					'MuBiasa'		=> $muBiasa,
					'MuFire'		=> $hasil,
					'user_id'		=> $user_id,
					'banksoal_id'	=> $banksoal_id,
					'dimensi_id'	=> $dimensi_id,
			);
			
			$this->db->set($update_data);
			$this->db->insert('mu');
			
			$this->db->set('status','0')
					 ->where('jawaban_id', $jawaban_id)
					 ->update('jawaban');
		}
	}
	
	function debuk()
	{
		$dimensi = 2;
		/* 
		$data = $this->db->query("  SELECT
											u.username,
											u.id AS user_id,
											j.jawaban_id,
											b.pertanyaan,
											d.dimensi_id,
											j.created,
											j.status,
											Sum(aturan.nilai) AS total_nilai,
											COUNT(aturan.nilai) AS total_soal
											FROM
											jawaban AS j
											INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
											INNER JOIN users AS u ON j.user_id = u.id
											INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
											INNER JOIN aturan ON j.aturan_id = aturan.aturan_id
											WHERE
											b.dimensi_id = '$dimensi' 
											GROUP BY
											u.username
											ORDER BY
											j.status ASC ")->result();
		 */
		
		$id = $this->session->userdata('user_id');
		
		$data = $this->db->query("SELECT
								userkonsumen.username AS nama_konsumen,
								userperawat.username AS nama_perawat,
								userkonsumen.id
								FROM	
								rawatkonsumen AS rawat
								INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
								INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
								WHERE
								userperawat.id = $id
												
				")->row();
		echo $id;
		echo "<pre>";
		echo dump($data);
		echo "</pre>";
		dump($this->db->last_query());
		exit;
	}
	
	/*
	 * Fungsi default routes
	 * ------
	 * 
	 */
	function index()
	{		
		// jika konsumen
		if($this->ion_auth->in_group('konsumen'))
		{
			$this->soal();
		}
		
		// jika manajer
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$this->konsumen();
		}
		
		// jika perawat
		if($this->ion_auth->in_group('perawat'))
		{
			$this->hasil();
		}
	}
	/*
	 * Fungsi untuk menampilkan hasil buat perawat
	 */
	function hasil()
	{
		
		$this->load->library('pagination');
		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));

		$uri_segment = 4;
		$data['offset'] = $this->uri->segment($uri_segment);

		$config['base_url'] = base_url().'jawaban/hasil/index';
		$config['total_rows'] = $this->jawaban_model->count_all();
		$config['per_page'] = 5;
		$config['next_link'] = '<li>Selanjutnya</li>';
		$config['prev_link'] = '<li>Sebelumnya</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
		$config['cur_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();

		$data['limit'] = $config['per_page'];
		
		$id = $this->session->userdata('user_id');

		$data['pasangan'] = $this->db->query("	SELECT
												userkonsumen.last_name AS nama_konsumen,
												userperawat.username AS nama_perawat,
												userkonsumen.id
												FROM
												rawatkonsumen AS rawat
												INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
												INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
												WHERE
												userperawat.id = $id")->row();


		// Ambil dengan Faktor dirasakan
		$data['dirasakan'] = $this->db->query("SELECT
							a.aturan_id,
							a.variabel,
							a.nilai,
							a.nfuzzy,
							d.dimensi_id,
							d.nama,
							d.keterangan,
							s.banksoal_id,
							s.pertanyaan,
							s.faktor,
							s.dimensi_id,
							s.publish,
							userperawat.username AS perawat_nama,
							userkonsumen.username AS konsumen_nama,
							userkonsumen.id AS konsumen_id,
							userperawat.id AS perawat_id
							FROM
							rawatkonsumen AS rawat
							INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							WHERE
							perawat_id = $id AND
							s.faktor = 'dirasakan'
							GROUP BY
							j.jawaban_id
							ORDER BY
							s.banksoal_id ASC");
			
		// Ambil dengan Faktor diharapakan
		$data['diharapkan'] = $this->db->query("SELECT
							a.aturan_id,
							a.variabel,
							a.nilai,
							a.nfuzzy,
							d.dimensi_id,
							d.nama,
							d.keterangan,
							s.banksoal_id,
							s.pertanyaan,
							s.faktor,
							s.dimensi_id,
							s.publish,
							userperawat.username AS perawat_nama,
							userkonsumen.username AS konsumen_nama,
							userkonsumen.id AS konsumen_id,
							userperawat.id AS perawat_id
							FROM
							rawatkonsumen AS rawat
							INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							WHERE
							perawat_id = $id AND
							s.faktor = 'diharapkan'
							GROUP BY
							j.jawaban_id
							ORDER BY
							s.banksoal_id ASC");
			
			
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Module Pengguna Sistem";
		$data['jawaban'] = "hasil"; 		// Controller
		$data['view'] 	 = "hasil_perawat"; 	// View
		$data['module']  = "jawaban"; 		// Controller
			
		echo Modules::run('template/perawat',$data);
	}
	
	/*
	 * Original from: http://tutorialzine.com/2012/01/question-of-the-day-codeigniter-php-mysql/
	* ----
	* Fungsi menambah jawaban
	* ----
	* @param $id
	* @access pelanggan
	*/
	function add($banksoal_id = -1)
	{
		$soal = $this->soal_model->as_array()->get_many_by(array('banksoal_id' => "$banksoal_id"));
			
		if (empty($soal))
		{
			echo "Soal belum di Inputkan";
		}

		// validasi inputan dropdon
		$this->form_validation->set_rules('pilihan', 'Pilihan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			// populate data
			$data = array(
					'banksoal'		=> $soal[0]['pertanyaan'],
					'banksoal_id'	=> $soal[0]['banksoal_id'],
					'user_id'		=> $this->session->userdata('user_id'),
					'next'			=> $next,
			);

			// set pesan
			$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'.validation_errors().'</div>' : $this->session->flashdata('message'));

			// render template
			$data['welcome'] 	= ucfirst($this->session->userdata('email'));
			$data['title'] 	 	= "Module Jawaban - Tambah Jawaban";
			$data['jawaban']    = "jawaban"; // Controller
			$data['view'] 		= "jawaban_pilihan"; // View
			$data['module'] 	= "jawaban"; // Controller

			echo Modules::run('template/konsumen',$data);
		}
		else
		{
			$date = now();
			//populate data
			$data = array(
					'user_id'		=> $this->session->userdata('user_id'),
					'banksoal_id'   => $soal[0]['banksoal_id'],
					'created'		=> $date,
					'score'			=> $this->input->post('pilihan'),
			);

			$this->jawaban_model->insert($data) && $this->jawaban_model->update_by(array());

			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Informasi berhasil ditambahkan!</div>");
			redirect('soal/tampil/'.$soal[0]['banksoal_id']);
		}
	}
	
	/*
	 * Fungsi menampilkan seluruh jawaban konsumen berdasarkan dimensi
	 * ------
	 * 
	 * @access manajer
	 * 
	 */
	public function konsumen()
	{
		if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo "You don\'t have an access this page";
 			echo br(2); ?>
<a href="javascript:history.back()" class="back_link btn btn-small">Kembali</a>
<? 
		}

		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));

		$uri_segment = 5;
		$data['offset'] = $this->uri->segment($uri_segment);

		$config['base_url'] = base_url().'jawaban/konsumen/index/';
		$config['total_rows'] = $this->jawaban_model->count_by('status',1);
		$config['per_page'] = 50;
		$config['next_link'] = '<li>Selanjutnya</li>';
		$config['prev_link'] = '<li>Sebelumnya</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
		$config['cur_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();

		$data['limit'] = $config['per_page'];

		// njrittt, buat milih inih!
		$data['selected'] = $this->input->post('dimensi_id');
		$dimensi = $this->input->post('dimensi_id');
		//AND j.`status` = 1
		
		$data['jawa'] = $this->db->query("  SELECT
											u.username,
											u.id AS user_id,
											j.jawaban_id,
											b.pertanyaan,
											d.dimensi_id,
											j.created,
											j.status,
											Sum(aturan.nilai) AS total_nilai,
											COUNT(aturan.nilai) AS total_soal
											FROM
											jawaban AS j
											INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
											INNER JOIN users AS u ON j.user_id = u.id
											INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
											INNER JOIN aturan ON j.aturan_id = aturan.aturan_id
											WHERE
											b.dimensi_id = '$dimensi' 
											GROUP BY
											u.username
											ORDER BY
											j.status ASC ");
		
		/*
		 * Not work! 
		$data['jawa'] = $this->jawaban_model
							 ->with('banksoal')
							 ->with('users')
							 ->with('dimensi')
							 ->with('aturan')	
							 ->get_many_by('dimensi_id' ,$dimensi);
		*/
		// render template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 	 	= "Module Jawaban - Hasil Jawaban";	
		$data['jawaban']    = "jawaban"; // Controller
		$data['view'] 		= "jawaban_view"; // View
		$data['module'] 	= "jawaban"; // Controller
			
		if($this->ion_auth->is_admin()) {
			echo Modules::run('template/admin',$data);
		}
		if($this->ion_auth->in_group('manajer')) {
			echo Modules::run('template/manajer', $data);
		}
	}
	
	/*
	 * Fungsi untuk menghapus setiap jawaban, sebelum di proses ke nilai fuzzy
	 * ---
	 * @access
	 * @param $jawaban_id dan $user_id
	 * 
	 */
	function delete($jawaban_id)
	{	
		if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo "You don\'t have an access this page";
		 	echo br(2); ?>
		<a href="javascript:history.back()" class="back_link btn btn-small">Kembali</a>
		<?php
		}
			$data = $this->db->query("  SELECT DISTINCT
										u.id AS user_id,
										j.jawaban_id
										FROM
										jawaban AS j
										INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
										INNER JOIN users AS u ON j.user_id = u.id
										INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
										INNER JOIN aturan ON j.aturan_id = aturan.aturan_id
										GROUP BY
										u.username
										ORDER BY
										u.username ASC ")->row_array();
			
			$user_id = $data['user_id'];
			$user = $this->jawaban_model->as_array()->get_by('user_id',$user_id);
				
			// pake delete_by belum yakin
			$jawaban_delete = $this->jawaban_model->delete($jawaban_id);
			
			$jawaban_users = $this->db->set('jawaban','jawaban-1', FALSE)
									  ->where('id', $user_id)
									  ->update('users');
			
			if(!$jawaban_delete && !$jawaban_users)
			{
				// error brurr!!
				$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
			}
			else
			{
				$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Jawaban Pengguna berhasil dihapus!</div>");
				redirect(base_url('jawaban'));
			}
	}
	
	/*
	 * Fungsi menampilkan hasil jawaban dari soal yang terjawab oleh user/ konsumen
	 * ---
	 * @access konsumen
	 * @param
	 * 
	 */
	function soal()
	{
		if(!$this->ion_auth->in_group('konsumen'))
		{
			echo "You don\'t have an access this page";
			echo br(2); ?>
				<a href="javascript:history.back()" class="back_link btn btn-small">Kembali</a>
		<?php 
		}
						
		$id = $this->session->userdata('user_id');
		
		// paging
		$this->load->library('pagination');
		$data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>'. validation_errors(). '</div>' : $this->session->flashdata('message'));
		
		$uri_segment = 4;
		$data['offset'] = $this->uri->segment($uri_segment);
		
		$config['base_url'] = base_url().'jawaban/soal/index';
		$config['total_rows'] = $this->jawaban_model->count_all();
		$config['per_page'] = 5;
		$config['next_link'] = '<li>Selanjutnya</li>';
		$config['prev_link'] = '<li>Sebelumnya</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">..</a>';
		$config['cur_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();
		
		$data['limit'] = $config['per_page'];
		
		
		// Ambil dengan Faktor dirasakan
		$data['dirasakan'] = $this->db->query("SELECT
												s.pertanyaan,
												s.faktor,
												u.username,
												a.nilai AS nilai_min,
												a.variabel AS pilihan,
												j.status
												FROM
												jawaban AS j
												INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
												INNER JOIN users AS u ON j.user_id = u.id
												INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
												WHERE
												u.id = $id AND s.faktor = 'dirasakan'
												GROUP BY
												j.jawaban_id
												ORDER BY
												u.username ASC");
		
		// Ambil dengan Faktor diharapakan
		$data['diharapkan'] = $this->db->query("SELECT
												s.pertanyaan,
												s.faktor,
												u.username,
												a.variabel AS pilihan,
												a.nilai AS nilai_min,
												j.status
												FROM
												jawaban AS j
												INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
												INNER JOIN users AS u ON j.user_id = u.id
												INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
												WHERE
												u.id = $id AND s.faktor = 'diharapkan'
												GROUP BY
												j.jawaban_id
												ORDER BY
												u.username ASC");
		
		// render template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 	 	= "Module Jawaban - Hasil Jawaban Konsumen";
		$data['jawaban']    = "jawaban"; // Controller
		$data['view'] 		= "hasil_konsumen"; // View
		$data['module'] 	= "jawaban"; // Controller
		
		echo Modules::run('template/konsumen',$data);

	}
	
	/*
	 * Fungsi detail untuk menampilkan siapa yang menjawab, soal dan siapa yang dinilai
	 * ------
	 * PROSES DEVELOPMENT!!
	 * ------
	 */
	public function detail($jawaban_id = null)
	{
		
		$data['results'] = $this->db->query(" SELECT
							j.*,
							a.*,
							d.*,
							s.*,
							userperawat.first_name AS perawat_nama,
							userkonsumen.first_name AS konsumen_nama,
							userperawat.last_name AS perawat_last,
							userkonsumen.last_name AS konsumen_last,
							userkonsumen.email,
							userkonsumen.jawaban,
							userperawat.dob,
							userperawat.sex,
							userperawat.elderly,
							userperawat.address
							FROM
							rawatkonsumen AS rawat
							INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							WHERE
							j.jawaban_id = $jawaban_id ")->row();
				
		
		// render template
		$data['welcome'] 	= ucfirst($this->session->userdata('email'));
		$data['title'] 	 	= "Module Jawaban - Detail Jawaban";
		$data['jawaban']    = "jawaban"; // Controller
		$data['view'] 		= "jawaban_detail"; // View
		$data['module'] 	= "jawaban"; // Controller
		
		if($this->ion_auth->is_admin()) {
 			echo Modules::run('template/admin',$data);
 		}
 		if($this->ion_auth->in_group('manajer')) {
 			echo Modules::run('template/manajer', $data);
 		}
 		
	}
	
	/*
	 * Fungsi untuk mencari data jawaban
	 * ------
	 *  
	 */
	public function search()
	{
		echo "Still development";
	}
	
	/*
	 * Fungsi untuk memproses setiap jawaban ke nilai keanggotaan fuzzy tahani
	 * ------
	 * @param Id Jawaban
	 * @acces 
	 *  
	 */
	
	public function proses($jawaban_id = null)
	{
		$jawaban_id = (int) $jawaban_id;
		
		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$data 			= $this->jawaban_model->as_array()->get($jawaban_id);
			$user_id 		= $data['user_id'];
			$banksoal_id 	= $data['banksoal_id'];
			$dimensi_id 	= $data['dimensi_id'];
						
			$kueri = $this->db->query(" SELECT
											Sum(aturan.nilai) AS total_nilai,
											COUNT(aturan.nilai) AS total_soal
											FROM
											jawaban AS j
											INNER JOIN banksoal AS b ON j.banksoal_id = b.banksoal_id
											INNER JOIN users AS u ON j.user_id = u.id
											INNER JOIN dimensi AS d ON b.dimensi_id = d.dimensi_id
											INNER JOIN aturan ON j.aturan_id = aturan.aturan_id
											WHERE
											j.dimensi_id = $dimensi_id AND j.user_id = $user_id AND j.`status` = 1 
											GROUP BY
											u.username
											ORDER BY
											u.username ASC ")->row_array();				
			// Hitung
			$tot_nilai = $kueri['total_nilai'];
			$tot_soal = $kueri['total_soal'];
			
			// simpan ke muFire
			$hasil = $tot_nilai/$tot_soal;
			$hasil2 = $hasil/100;  // tricking...
			
			// tentukan batasan terhadap nilai, bisa aja dinamis
			// kalo dinamis, udah disiapin table: himpunan
			$kecewa 	= array(0,40,65); // array[0]
			$biasa 		= array(40,65,80); // array[1]
			$puas 		= array(65,80,100); // array[2]
			// atau
			// $himpunan = $this->himpunan_model->get_by(1);
			
			// bagi bagi nilai yang sama
			$kb = array_intersect($kecewa, $biasa); // kecewa-biasa output: 40,65
			$bp = array_intersect($biasa, $puas); // biasa-puas output: 65,80
				
			// test : http://3v4l.org/d4oiO atau http://3v4l.org/n4MRk
			
			if ( $hasil >= $bp[1] && $hasil <= $bp[2] )
			{
				
				# ($hasil - $kb[1]) / ($kb[2] - $kb[1])
			    $muBiasa = ($hasil >= $bp[2]) ? "0" : ($hasil <= $bp[2] ? ($bp[2] - $hasil) / ($bp[2] - $bp[1]) : "0.5" );
				$muPuas = ($hasil - $bp[1]) / ($bp[2] - $bp[1]);
				
				
				// insert data
				$update_data = array(
						'MuBiasa' 		=> round($muBiasa, 2),
						'MuPuas'		=> round($muPuas, 2),
						'MuFire'		=> round($hasil2, 3),
						'MuHasil'		=> $hasil,
						'user_id'		=> $user_id,
						'banksoal_id'	=> $banksoal_id,
						'dimensi_id'	=> $dimensi_id,
				);
				
				$this->db->set($update_data);
				$this->db->insert('mu');
				
				$this->db->set('status','0')
						 ->where('user_id', $user_id)
						 ->where('dimensi_id', $dimensi_id)
						 ->update('jawaban') ;
			}
			// antara 40 - 65
			elseif ( $hasil >= $kb[1] && $hasil < $kb[2] )
			{
				$muKecewa = ($kb[2] - $hasil) / ($kb[2] - $kb[1]);
				$muBiasa = ($hasil - $kb[1]) / ($kb[2] - $kb[1]);
					
				$update_data = array(
						'MuKecewa' 		=> round($muKecewa, 2),
						'MuBiasa'		=> round($muBiasa, 2),
						'MuFire'		=> round($hasil2, 3),
						'MuHasil'		=> $hasil,
						'user_id'		=> $user_id,
						'banksoal_id'	=> $banksoal_id,
						'dimensi_id'	=> $dimensi_id,
				);
		////-----------------------------------------------------------------------------------
				$this->db->set($update_data);
				$this->db->insert('mu');
				
				$this->db->set('status','0')
						 ->where('user_id', $user_id)
						 ->where('dimensi_id', $dimensi_id)
						 ->update('jawaban');
			}
			$this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Sukses diproses!</div>");
			redirect('jawaban','refresh');
		}	
	}
	
	function saran()
	{
		$data = $this->db->query("	SELECT
							d.dimensi_id,
							d.nama,
							s.dimensi_id,
							s.pertanyaan,
							userperawat.username AS perawat_nama,
							userkonsumen.username AS konsumen_nama,
							userkonsumen.id AS konsumen_id,
							userperawat.id AS perawat_id
							FROM
							rawatkonsumen AS rawat
							INNER JOIN jawaban AS j ON j.user_id = rawat.konsumen_id
							INNER JOIN users AS userkonsumen ON rawat.konsumen_id = userkonsumen.id
							INNER JOIN users AS userperawat ON rawat.perawat_id = userperawat.id
							INNER JOIN banksoal AS s ON j.banksoal_id = s.banksoal_id
							INNER JOIN dimensi AS d ON j.dimensi_id = d.dimensi_id AND s.dimensi_id = d.dimensi_id
							INNER JOIN aturan AS a ON j.aturan_id = a.aturan_id
							WHERE
							rawat.perawat_id = 71
							GROUP BY
							j.dimensi_id
							ORDER BY
							s.banksoal_id ASC ")->result();
		
		dump($data);
	}
}


/* End of File: jawaban.php */
/* Location: ../www/modules/jawaban/jawaban.php */