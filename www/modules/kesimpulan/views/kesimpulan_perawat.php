<div class="row-fluid">
		<div class="span12">
			<h3 class="heading">
				Hasil Kepuasan :
				<?php echo  strtoupper($pasangan->nama_konsumen);?>
			</h3>
			<div class="clearfix">
				<blockquote>
					<?php 
						/*
						 * Berdasarkan Teori dari Prasurman, et all (1985)
						* Yang dipertegas dengan Jurnal penelitian dari Wykcof (2002)
						* bahwa:
						* " Kualitas pelayanan ialah tingkat yang diharapkan dan pengendalian atas
						* 	 tingkat keunggulan tersebut untuk memenuhi kebutuhan pelanggan "
						* atau
						* " Pemenuhan kebutuhan dan keinginan pelanggan serta ketepatan dalam
						* 	 penyampaiannya untuk mengimbangi harapan pelanggan "
						* atau
						* " Kualitas pelayanan diterima / dirasakan melebiah apa yang diharapkan maka baik dan memuaskan
						*   , kualitas diterima sesuai dengan diharapkan maka kualitasnya ideal, kualitas pelayanan yang
						*   diterima lebih rendah dari yang diharapkan maka kualitasnya buruk. "
						*/
				
						if ( $hasil_rasa > $hasil_harap )
						{
							echo "Baik dan Memuaskan";
							// Nothing Todo
						}
						elseif ( $hasil_rasa == $hasil_harap )
						{
							echo "Ideal";
							// some others todo
				
						}
						elseif ( $hasil_rasa < $hasil_harap )
						{
							echo "Sangat Tidak Memuaskan";
							// do some kesimpulan
						}
						?>
						
						<small>Klik For <?= anchor('jawaban/hasil','Detail Nilai');?></small>
						<small>Klik For <?= anchor('jawaban/saran','Detail Saran');?></small>
						
				</blockquote>
			</div>
		</div>
</div>
