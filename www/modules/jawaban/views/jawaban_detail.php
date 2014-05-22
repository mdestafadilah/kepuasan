<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Detail Jawaban No: <?php echo $results->jawaban_id?></h3>
		<div class="row-fluid">
			<div class="span12">
				<div class="vcard">
					<ul>
						<li class="v-heading">Detail Konsumen</li>
						
						<li><span class="item-key">Nama</span>
							<div class="vcard-item">
								<?php echo ucfirst($results->konsumen_nama);?> <?php echo $results->konsumen_last?>
							</div>
						</li>
						<li><span class="item-key">Email</span>
							<div class="vcard-item">
							<?php
									echo $results->email;
							?>
							</div>
						</li>
						<li><span class="item-key">Total</span>
							<div class="vcard-item">
								<?php
									echo $results->jawaban. " Soal Terjawab";
								?>								
							</div>
						</li>
						<li><span class="item-key">Access</span>
							<div class="vcard-item">
								<?php
									echo $results->created;
								?>								
							</div>
						</li>
				
						<li class="v-heading">Detail Perawat</li>
						<li>
						<?php	
							echo "<span class='item-key'>Nama</span>
					 		<div class='vcard-item'>".ucfirst($results->perawat_nama). "</div>";
					 		echo "<li><span class='item-key'>Tanggal Lahir</span>
					 		<div class='vcard-item'>".ucfirst($results->dob)."</div></li>";
					 		echo "<li><span class='item-key'>Jenis Kelamin</span>
					 		<div class='vcard-item'>".ucfirst($results->sex)."</div></li>";
					 		echo "<li><span class='item-key'>Ijasah</span>
					 		<div class='vcard-item'>".'Ok';"</div></li>";
					 		echo "<li><span class='item-key'>Jenis</span>
					 		<div class='vcard-item'>".ucfirst($results->elderly)."</div></li>";
					 		echo "<li><span class='item-key'>Alamat</span>
					 		<div class='vcard-item'>".ucfirst($results->address)."</div></li>";
					 		?>
						</li>
						<li class="v-heading">Detail Pertanyaan</li>
						<li>
						<?php	
							echo "<span class='item-key'>Pertanyaan</span>
					 		<div class='vcard-item'>".ucfirst($results->pertanyaan). "</div>";
					 		echo "<li><span class='item-key'>Dimensi</span>
					 		<div class='vcard-item'>".ucfirst($results->dob)."</div></li>";
					 		echo "<li><span class='item-key'>Nilai</span>
					 		<div class='vcard-item'>".ucfirst($results->sex)."</div></li>";
					 		echo "<li><span class='item-key'>Variabel</span>
					 		<div class='vcard-item'>".'Ok';"</div></li>";
					 		echo "<li><span class='item-key'>Keterangan</span>
					 		<div class='vcard-item'>".ucfirst($results->elderly)."</div></li>";
					 		
					 		?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
