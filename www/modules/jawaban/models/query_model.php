<?php
	class Query_model extends CI_Model
	{
		function get_all()
		{
			$this->db->select('*')->from('mu');
			$data = $this->db->get();
			
			return $data->result();
		}
		
		function get_detail_all()
		{
			$data = $this->db->select('*')
					 ->from('mu')
					 ->join('dimensi', 'mu.dimensi_id = dimensi.dimensi_id','inner')
					 ->join('users', 'mu.user_id = users.id','inner')
					 ->join('banksoal', 'banksoal.dimensi_id = dimensi.dimensi_id','inner')
					 ->get();
			
			return $data->result();
		}
		
		function kueri_atau($dimen_handal = null, $dimen_tanggap = null, $dimen_pasti = null,  $dimen_empati = null, $dimen_wujud = null)
		{
				
			// output result
			$q = $this->db	->select('mu.MuKecewa,mu.MuBiasa,mu.MuPuas,mu.MuFire,banksoal.pertanyaan,banksoal.faktor,users.first_name,users.last_name,dimensi.nama AS dimensi')
							->from('mu')
							->join('banksoal', 'mu.banksoal_id = banksoal.banksoal_id','inner')
							->join('users', 'mu.user_id = users.id','inner')
							->join('dimensi', 'mu.dimensi_id = dimensi.dimensi_id','inner');
				
			// our condition input
			if (!empty($_POST['dimen_handal']))
			{
					$kondisi_1 = "mu.dimensi_id = '1' AND mu.MuHasil >= '$dimen_handal'";
					$q->or_where($kondisi_1)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_tanggap']))
			{
					$kondisi_2 = "mu.dimensi_id = '2' AND mu.MuHasil >= '$dimen_tanggap'";
					$q->or_where($kondisi_2)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_pasti']))
			{
					$kondisi_3 = "mu.dimensi_id = '3' AND mu.MuHasil >= '$dimen_pasti'";
					$q->or_where($kondisi_3)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_empati']))
			{
					$kondisi_4 = "mu.dimensi_id = '4' AND mu.MuHasil >= '$dimen_empati'";
					$q->or_where($kondisi_4)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_wujud']))
			{
					$kondisi_5 = "mu.dimensi_id = '5' AND mu.MuHasil >= '$dimen_wujud'";
					$q->or_where($kondisi_5)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			$ret['rows'] = $q->get()->result();
				
			$q = $this->db	->select('COUNT(*) as count', FALSE)
							->from('mu');
				
			// our condition input
			if (!empty($_POST['dimen_handal']))
			{
					$kondisi_1 = "mu.dimensi_id = '1' AND mu.MuHasil >= '$dimen_handal'";
					$q->or_where($kondisi_1)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_tanggap']))
			{
					$kondisi_2 = "mu.dimensi_id = '2' AND mu.MuHasil >= '$dimen_tanggap'";
					$q->or_where($kondisi_2)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_pasti']))
			{
					$kondisi_3 = "mu.dimensi_id = '3' AND mu.MuHasil >= '$dimen_pasti'";
					$q->or_where($kondisi_3)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_empati']))
			{
					$kondisi_4 = "mu.dimensi_id = '4' AND mu.MuHasil >= '$dimen_empati'";
					$q->or_where($kondisi_4)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			if (!empty($_POST['dimen_wujud']))
			{
					$kondisi_5 = "mu.dimensi_id = '5' AND mu.MuHasil >= '$dimen_wujud'";
					$q->or_where($kondisi_5)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("max(MuFire)","DESC");
			}
				
			// our condition input
				
			$tmp = $q->get()->result();
			$ret['num_rows'] = $tmp[0]->count;
				
				
			return $ret;
		}
		
		function kueri_dan($dimen_handal = null, $dimen_tanggap = null, $dimen_pasti = null,  $dimen_empati = null, $dimen_wujud = null)
		{
			
			// output result
			$q = $this->db	->select('mu.MuKecewa,mu.MuBiasa,mu.MuPuas,mu.MuFire,banksoal.pertanyaan,banksoal.faktor,users.first_name,users.last_name,dimensi.nama AS dimensi')
							->from('mu')
							->join('banksoal', 'mu.banksoal_id = banksoal.banksoal_id','inner')
							->join('users', 'mu.user_id = users.id','inner')
							->join('dimensi', 'mu.dimensi_id = dimensi.dimensi_id','inner');
					
			// our condition input
			if (!empty($_POST['dimen_handal']))
			{			
				$kondisi_1 = "mu.dimensi_id = '1' AND mu.MuHasil >= '$dimen_handal'";				
				$q->where($kondisi_1)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_tanggap']))
			{
				$kondisi_2 = "mu.dimensi_id = '2' AND mu.MuHasil >= '$dimen_tanggap'";
				$q->or_where($kondisi_2)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_pasti']))
			{
				$kondisi_3 = "mu.dimensi_id = '3' AND mu.MuHasil >= '$dimen_pasti'";
				$q->or_where($kondisi_3)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_empati']))
			{
				$kondisi_4 = "mu.dimensi_id = '4' AND mu.MuHasil >= '$dimen_empati'";
				$q->or_where($kondisi_4)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_wujud']))
			{
				$kondisi_5 = "mu.dimensi_id = '5' AND mu.MuHasil >= '$dimen_wujud'";
				$q->or_where($kondisi_5)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			$ret['rows'] = $q->get()->result();
			
			//------ COUNT -----
			
			$q = $this->db	->select('COUNT(*) as count', FALSE)
							->from('mu');
			
			// our condition input
			if (!empty($_POST['dimen_handal']))
			{			
				$kondisi_1 = "mu.dimensi_id = '1' AND mu.MuHasil >= '$dimen_handal'";				
				$q->where($kondisi_1)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_tanggap']))
			{
				$kondisi_2 = "mu.dimensi_id = '2' AND mu.MuHasil >= '$dimen_tanggap'";
				$q->or_where($kondisi_2)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_pasti']))
			{
				$kondisi_3 = "mu.dimensi_id = '3' AND mu.MuHasil >= '$dimen_pasti'";
				$q->or_where($kondisi_3)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_empati']))
			{
				$kondisi_4 = "mu.dimensi_id = '4' AND mu.MuHasil >= '$dimen_empati'";
				$q->or_where($kondisi_4)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			if (!empty($_POST['dimen_wujud']))
			{
				$kondisi_5 = "mu.dimensi_id = '5' AND mu.MuHasil >= '$dimen_wujud'";
				$q->or_where($kondisi_5)->group_by(array('mu.dimensi_id','mu.banksoal_id'))->order_by("min(MuFire)","DESC");
			}
			
			$tmp = $q->get()->result();
			$ret['num_rows'] = $tmp[0]->count;
			 
			
			return $ret;
		}
	}
