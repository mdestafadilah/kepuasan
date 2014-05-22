<?php echo $message;?>
<div class="row-fluid">
		<h3 class="heading">Soal</h3>
			<div class="accordion-group">
				<div class="span12">
					<table class="table">
						<thead>
							<tr>
								<th>Total soal: <?php echo $total;?>
								> Dimensi: <?php echo $dim;?>
								<br /> <h4> Faktor : <?php echo strtoupper($faktor);?></h4>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $soal1; ?>?</td>								
							</tr>
							<tr>
								<td>
								<?php echo form_open('');?>
								<?php
								
								$atur = $this->aturan_model->as_array()->get_all();
								
								foreach ($atur as $ar)
								{
									$data = array(
											'name' => 'pilihan',
											'id' => $ar['aturan_id'],
											'value' => $ar['aturan_id'],
											);
									echo " | ".form_radio( $data ).ucfirst($ar['variabel']);
									
								}
								?>
								<!-- 
									USE IT IF not PROBLEM!!
									<label class="radio inline"> <input type="radio" value="00-40" name="pilihan" /> Kecewa </label> 
									<label class="radio inline"> <input type="radio" value="40-65" name="pilihan" /> Biasa </label> 
									<label class="radio inline"> <input type="radio" value="65-80" name="pilihan" /> Mengesankan</label> 
								-->
								<br /><br />
								<?php echo form_submit('subm', 'Jawab','class="btn"'); ?>
								<?php //if($next) echo anchor("soal/tampil/$next",'<i class="splashy-arrow_state_blue_right"></i>Next','class="btn"');?>
								<?php echo form_close();?>
								</td>
							</tr>
						</tbody>						
					</table>
				</div>
			</div>
			<?php //if($previous) echo anchor("soal/tampil/$previous",'&laquo;','class="btn btn-primary left"');?>			
<!-- 		<div id="accordion1" class="accordion"> -->
<!-- 			<div class="accordion-group"> -->
<!-- 				<div class="accordion-heading"> -->
<!-- 					<a href="#collapseOne1" data-parent="#accordion1" -->
<!-- 						data-toggle="collapse" class="accordion-toggle">Total Soal: </a> -->
<!-- 				</div> -->
<!-- 				<div class="accordion-body collapse" id="collapseOne1"> -->
<!-- 					<div class="accordion-inner"> -->
<!-- 						<div class="span12"> -->
<!-- 							<label class="radio inline"> <input type="radio" value="option6" -->
<!-- 								name="gender" /> Male </label> <label class="radio inline"> <input -->
<!-- 								type="radio" value="option7" name="gender" /> Female </label> -->

							
<!-- 						</div> -->
						<!-- End span12 -->
<!-- 					</div> -->
					<!-- End Accordioan-inner -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</div> -->
</div>
