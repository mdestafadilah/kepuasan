	<?php echo $message;?>
<div class="row-fluid">
		<h3 class="heading">Pilihan Jawaban</h3>
			<div class="accordion-group">
				<div class="span12">
				<?php echo form_open('');?>
					<table class="table">
						<thead>
							<tr>
								<th>
									<label class="radio inline"> <input type="radio" value="40" name="pilihan" /> Kecewa </label> 
									<label class="radio inline"> <input type="radio" value="65" name="pilihan" /> Biasa </label> 
									<label class="radio inline"> <input type="radio" value="80" name="pilihan" /> Mengesankan</label>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php echo form_submit();?>
									<?php echo anchor("jawaban/add/$banksoal_id",'<i class="splashy-comment_question"></i> Pilih','class="btn btn-inverse"');?> atau
									<?php echo anchor("soal/tampil/$banksoal_id",'<i class="splashy"></i> Kembali Ke Soal','class="btn btn-inverse"');?>
								</td>								
							</tr>
						</tbody>
						<?php 
							$data = array(
									'banksoal_id' => $banksoal_id,
									'user_id' 	=> $this->session->userdata('user_id'),
									);
							echo form_hidden($data);
						?>						
					</table>
				<?php echo form_close();?>
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
