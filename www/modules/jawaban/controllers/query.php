<?php
/**
 * File: noname.php
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @date       17-07-2013 12:45
 * @category   AksiIDE
 * @package    AksiIDE
 * @subpackage
 * @copyright  Copyright (c) 2013-endless AksiIDE
 * @license
 * @version    $version$
 * @link       http://aksiide.com
 * @since
 */

class Query extends MX_Controller
{
	/*
	 * http://stackoverflow.com/questions/3737139/reference-what-does-this-symbol-mean-in-php
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('ion_auth','session','form_validation'));
		$this->load->helper('url');
		$this->load->model(array( 	
					'mu/mu_model',
				  	'dimensi/dimensi_model',
					'user/user_model',
					'jawaban/jawaban_model',
					'aturan/aturan_model',
					'soal/soal_model',
					'jawaban/query_model'));
	}
	
	function index()
	{
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$this->display2();
		}
		else
		{
			echo "Login Dulu";
			echo br(2);
			echo anchor('auth/login','Kembali');
		}		
	}
	
	
	
	function display($query_id = 0)
	{
		$dim = $this->dimensi_model->as_array()->get_all();
		$dimensi_option = array(
				$kehandalan  = $dim[0]['dimensi_id'],
				$ketanggapan = $dim[1]['dimensi_id'],
				$kepastian 	 = $dim[2]['dimensi_id'],
				$empati 	 = $dim[3]['dimensi_id'],
				$berwujud 	 = $dim[4]['dimensi_id'],
				);
		
		
		//--- KEHANDALAN ----//
		$data['kehandalan'] = $this->aturan_model->get_all();
		$data['pilih_handal'] = array(
				' ' => ' ',
				'and'  => 'DAN',
				'or'    => 'ATAU',
		);
			
		$OR_NOT = array('and', 'or');
		//---- END KEHANDALAN ----//
		
		//---- KETANGGAPAN ----//
		$data['ketanggapan'] = $this->aturan_model->get_all();
		$data['pilih_tanggap'] = array(
				' ' => ' ',
				'and'  => 'DAN',
				'or'    => 'ATAU',
		);
		
		$OR_NOT = array('and', 'or');
		//---- END KETANGGAPAN ---//
		
		//--- KEPASTIAN ----//
		$data['kepastian'] = $this->aturan_model->get_all();
		
		$data['pilih_pasti'] = array(
				' ' => ' ',
				'and'  => 'DAN',
				'or'    => 'ATAU',
		);
		
		$OR_NOT = array('and', 'or');
		//--- END KEPASTIAN ---//
		
		//---- EMPATI ---//
		$data['empati'] = $this->aturan_model->get_all();
			
		$data['pilih_empati'] = array(
				' ' => ' ',
				'&&'  => 'DAN',
				'//'    => 'ATAU',
		);
		
		$OR_NOT = array('and', 'or');
		//--- END EMPATI ---//
		
		//---- BERWUJUD ----//
		$data['berwujud'] = $this->aturan_model->get_all();
		//---- END BERWUJUD ---//
		
		$this->input->load_query($query_id);
		
		$query_array = array(
				'pilih_handal' => $this->input->get('pilih_handal'),
				'pilih_tanggap' => $this->input->get('pilih_tanggap'),
				'pilih_pasti' => $this->input->get('pilih_pasti'),
				'pilih_empati' => $this->input->get('pilih_empati'),
				'kehandalan' => $this->input->get('kehandalan'),
				'ketanggapan' => $this->input->get('ketanggapan'),
				'kepastian' => $this->input->get('kepastian'),
				'empati' => $this->input->get('empati'),
				'berwujud' => $this->input->get('berwujud'),
		);
		// Paging here
		
		$data['real'] = $this->mu_model
							 ->with('users')
							 ->with('dimensi')
							 ->with('banksoal')
							 ->get_all();
		
		// Template
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Fuzzy Tahani - Pilih Query Fuzzy Standard";
		$data['jawaban']  = "query"; // Controller
		$data['view']   = "fuzzy_pilihan"; // View
		$data['module'] = "jawaban"; // Controller
		
		echo Modules::run('template/manajer',$data);
	}
	
	function search()
	{
		
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
		{
			echo 'You don\'t have an access';
			echo br(2);
			echo anchor('auth/login', 'Login');
		}
		
		// cek input post
		if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
		{
			$this->form_validation->set_rules('pilih_handal', 'Pilihan Kehandalan');
			$this->form_validation->set_rules('pilih_tanggap', 'Pilihan Ketanggapan');
			$this->form_validation->set_rules('pilih_pasti', 'Pilihan Kepastian');
			$this->form_validation->set_rules('pilih_empati', 'Pilihan Empati');
			$this->form_validation->set_rules('kehandalan', 'Kehandalan');
			$this->form_validation->set_rules('ketanggapan', 'Ketanggapan');
			$this->form_validation->set_rules('kepastian', 'Kepastian');
			$this->form_validation->set_rules('empati', 'Empati');
			$this->form_validation->set_rules('berwujud', 'Berwujud');
		}
			
		$query_array = array(
					'pilih_handal' => $this->input->post('pilih_handal'),
					'pilih_tanggap' => $this->input->post('pilih_tanggap'),
					'pilih_pasti' => $this->input->post('pilih_pasti'),
					'pilih_empati' => $this->input->post('pilih_empati'),
					'kehandalan' => $this->input->post('kehandalan'),
					'ketanggapan' => $this->input->post('ketanggapan'),
					'kepastian' => $this->input->post('kepastian'),
					'empati' => $this->input->post('empati'),
					'berwujud' => $this->input->post('berwujud'),
			);
			
			$query_id = $this->input->save_query($query_array);
			
			redirect("jawaban/query/display/$query_id");
		}
		
	
	
	function display2()
	{
		
		// render template
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title']  = "Module Fuzzy Tahani - Pilih Query Fuzzy Tahani";
		$data['jawaban']  = "query"; // Controller
		$data['view']   = "fuzzy_pilihan"; // View
		$data['module'] = "jawaban"; // Controller
	
		echo Modules::run('template/manajer',$data);
	}
	
		
		function debuk()
		{
			/* TEST
			
			$dimensi_1 = 1;
			$dimensi_2 = 2;
			$dimensi_3 = 3;
			$dimensi_4 = 4;
			$dimensi_5 = 5;
				
			$pilihan_1 = 'MuBiasa';
			$pilihan_2 = 'MuKecewa';
			$pilihan_3 = 'MuPuas';
				
			$ornot_1 = 'AND';
			$ornot_2 = 'OR';
			
			END TEST */
			/* 
			$dim = $this->dimensi_model->as_array()->get_all();
						
			$data['dimensi_options'] = array(
					'' => '',
					'kehandalan'  => $dim[0]['dimensi_id'],
					'ketanggapan' => $dim[1]['dimensi_id'],
					'kepastian'   => $dim[2]['dimensi_id'],
					'empati' 	  => $dim[3]['dimensi_id'],
					'berwujud' 	  => $dim[4]['dimensi_id'],
			);
				
			$data['pilih_options'] = array(
					'' => '',
					'Kecewa' => 'MuKecewa',
					'Biasa'  => 'MuBiasa',
					'Puas'	 => 'MuPuas');
			$this->load->model('jawaban/query_model');
				
			$results = $this->query_model->pencarian(); */
			
			$hasil = 70;
			
			$array = array('mu.dimensi_id' => '2', 'MuHasil >' => $hasil);
			$array2 = array('mu.dimensi_id' => '1', 'MuHasil >' => $hasil);
				
			$data = $this->db	->select('mu.MuKecewa,mu.MuBiasa,mu.MuPuas,mu.MuFire,banksoal.pertanyaan,banksoal.faktor,users.first_name,users.last_name,dimensi.nama AS dimensi')
								->from('mu')
								->join('banksoal', 'mu.banksoal_id = banksoal.banksoal_id','inner')
								->join('users', 'mu.user_id = users.id','inner')
								->join('dimensi', 'mu.dimensi_id = dimensi.dimensi_id','inner')
								->order_by("MuFire","DESC")
								
								->where($array)
								
								->or_where($array2)
								
								->get()->result();
			
			
			dump($data);
			echo "<pre>";
			print_r($this->db->last_query());
		}
		
		function debuk2()
		{
			$dim = $this->dimensi_model->as_array()->get_all();
			$kehandalan = $dim[0]['dimensi_id'];
			$ketanggapan = $dim[1]['dimensi_id'];
			$kepastian = $dim[2]['dimensi_id'];
			$empati = $dim[3]['dimensi_id'];
			$berwujud = $dim[4]['dimensi_id'];
			
			$dimensi_option = array(
					'kehandalan'  => $dim[0]['dimensi_id'],
					'ketanggapan' => $dim[1]['dimensi_id'],
					'kepastian'   => $dim[2]['dimensi_id'],
					'empati' 	  => $dim[3]['dimensi_id'],
					'berwujud' 	  => $dim[4]['dimensi_id'],
			);
				
			// Pilihan Derajat Anggota
			$MuKecewa = "MuKecewa";
			$MuBiasa = "MuBiasa";
			$MuPuas = "MuPuas";
		
			// Pilihan Tahani Proses
			$and = "AND";
			$or = "OR";
		
			$data = $this->db->query("
					SELECT
					mu.user_id,
					mu.id,
					mu.MuKecewa,
					mu.MuBiasa,
					mu.MuPuas,
					ROUND(mu.MuFire),
					mu.MuFire,
					mu.dimensi_id,
					mu.banksoal_id
					FROM
					mu
					INNER JOIN dimensi ON mu.dimensi_id = dimensi.dimensi_id
		
					WHERE
		
					(dimensi.dimensi_id = $kehandalan AND $option_variabel > 0)
					$and
					(dimensi.dimensi_id = $empati AND $MuPuas > 0)
					$or
					(dimensi.dimensi_id = $ketanggapan AND $MuKecewa > 0)
					$and
					(dimensi.dimensi_id = $kepastian AND $MuPuas > 0)
					$and
					(dimensi.dimensi_id = $berwujud AND $MuKecewa > 0)
		
					GROUP BY mu.user_id
					ORDER BY mu.MuFire DESC
		
					")->result();
		
					dump($data);
					var_dump($this->db->last_query());
		}
	
		function dan()
		{
			if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
			{
				
			// Rumus: min(sA[x], sB[x])
		
			$dimen_handal = $this->input->post('dimen_handal');
			$dimen_tanggap = $this->input->post('dimen_tanggap');
			$dimen_pasti = $this->input->post('dimen_pasti');
			$dimen_empati = $this->input->post('dimen_empati');
			$dimen_wujud = $this->input->post('dimen_wujud');
						
			
			//--- KEHANDALAN ----//
			$data['dimen_handal'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- KETANGGAPAN ----//
			$data['dimen_tanggap'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- KEPASTIAN ----//
			$data['dimen_pasti'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- EMPATI ----//
			$data['dimen_empati'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- BERWUJUD ----//
			$data['dimen_wujud'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			/* 
			//--- KEHANDALAN ----//
			$data['dimen_handal'] = $dimen_handal;
			//--- KETANGGAPAN ----//
			$data['dimen_tanggap'] = $dimen_tanggap;
			//--- KEPASTIAN ----//
			$data['dimen_pasti'] = $dimen_pasti;
			//--- EMPATI ----//
			$data['dimen_empati'] = $dimen_empati;
			//--- BERWUJUD ----//
			$data['dimen_wujud'] = $dimen_wujud;
			 */
			
			// output the results
			$results = $this->query_model->kueri_dan($dimen_handal, $dimen_tanggap, $dimen_pasti, $dimen_empati, $dimen_wujud);
			$data['koloms'] = $results['rows'];
			$data['totals'] = $results['num_rows'];
		
			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Fuzzy Tahani - Pilih Dan Query";
			$data['jawaban']  = "query"; // Controller
			$data['view']   = "fuzzy_dan"; // View
			$data['module'] = "jawaban"; // Controller
		
			echo Modules::run('template/manajer',$data);
			}
				else
			{
				echo "Restricted Area!!";
				echo br(2);
				echo anchor('auth/login','Kembali');
			}
		}
		
		function atau()
		{
			if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer'))
			{
					
			// Rumus: max(sA[x], sB[x])
		
			$dimen_handal = $this->input->post('dimen_handal');
			$dimen_tanggap = $this->input->post('dimen_tanggap');
			$dimen_pasti = $this->input->post('dimen_pasti');
			$dimen_empati = $this->input->post('dimen_empati');
			$dimen_wujud = $this->input->post('dimen_wujud');
						
			
			//--- KEHANDALAN ----//
			$data['dimen_handal'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- KETANGGAPAN ----//
			$data['dimen_tanggap'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- KEPASTIAN ----//
			$data['dimen_pasti'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- EMPATI ----//
			$data['dimen_empati'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			//--- BERWUJUD ----//
			$data['dimen_wujud'] = array(
					'' => '',
					'80' => 'Puas',
					'65' => 'Biasa',
					'40' => 'Kecewa',
			);
			
			/* 
			//--- KEHANDALAN ----//
			$data['dimen_handal'] = $dimen_handal;
			//--- KETANGGAPAN ----//
			$data['dimen_tanggap'] = $dimen_tanggap;
			//--- KEPASTIAN ----//
			$data['dimen_pasti'] = $dimen_pasti;
			//--- EMPATI ----//
			$data['dimen_empati'] = $dimen_empati;
			//--- BERWUJUD ----//
			$data['dimen_wujud'] = $dimen_wujud;
			 */
			
			// output the results
			$results = $this->query_model->kueri_atau($dimen_handal, $dimen_tanggap, $dimen_pasti, $dimen_empati, $dimen_wujud);
			$data['koloms'] = $results['rows'];
			$data['totals'] = $results['num_rows'];
		
			// Template
			$data['welcome'] = ucfirst($this->session->userdata('email'));
			$data['title']  = "Module Fuzzy Tahani - Pilih Dan Query";
			$data['jawaban']  = "query"; // Controller
			$data['view']   = "fuzzy_atau"; // View
			$data['module'] = "jawaban"; // Controller
		
			echo Modules::run('template/manajer',$data);
			}
				else
			{
				echo "Restricted Area!!";
				echo br(2);
				echo anchor('auth/login','Kembali');
			}
		}
}
	

	




