<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="title">
   <div class='information'>INFORMATION</div>
</div>
<img class="foto_simpeg" src="http://simpeg.unnes.ac.id/index.php/gen_xml/load_photo/<?php echo from_session('nip')?>" />
<br />
		<? 
		$loginCount=$this->session->userdata('login_ke');
		$nama = $this->session->userdata('nama');
		if($nama !='')
		{
			// menampilkan counter login
			echo 'Selamat datang, <br /><b>'.$nama.'.</b>
					<br />Ini login Anda yang ke-'.$loginCount.'<br /><br />';
		}
		// mendeteksi user agent
		$agen=$this->widget_library->showAgent();
		echo 'Anda menggunakan <br /><b>'.$agen['agent'].'</b><br />
				dengan OS <b>'.$agen['platform'].'</b><br />';
   
   	?>  
   	<?
   	// menampilkan informasi IP Address
		$domain = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
		 ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		echo "IP Anda : <strong>$domain</strong>";
		?> 
		
		<?
		// menampilkan informasi user online
		//$guestOnline = $this->widgetmodel->getGuestOnline();
		$userOnline = $this->widgetmodel->getUserOnline();
		echo '<br />Sekarang ini ada '.$userOnline.' user online.';
		?>
