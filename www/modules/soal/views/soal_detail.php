<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Detail soal: <?php echo $soal->banksoal_id; ?></h3>
		<div class="row-fluid">
			<div class="span12">
				<div class="vcard">
					<ul>
						<li class="v-heading">Detail Information</li>
						
						<li><span class="item-key">Pertanyaan</span>
							<div class="vcard-item">
								<?php 
									echo ucfirst($soal->pertanyaan);
								?>
							</div>
						</li>
						<li><span class="item-key">Faktor</span>
							<div class="vcard-item">
							<?php
									echo $soal->faktor;
								
							?>
							</div>
						</li>
						<li><span class="item-key">Dimensi</span>
							<div class="vcard-item">
								<?php
									echo $soal->dimensi->nama;
								?>								</div>
						</li>
						<li><span class="item-key">Status:</span>
							<div class="vcard-item">
								<?php
									echo $soal->publish;
								?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
