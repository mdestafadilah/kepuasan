<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">
			Report hasil jawaban untuk :
			<?php echo strtoupper($this->session->userdata('username'));?>
		</h3>
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_l1" data-toggle="tab">Dirasakan</a>
				</li>
				<li><a href="#tab_l2" data-toggle="tab">Diharapkan</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_l1">
					<p>
					<div class="span12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Pertanyaan</th>
									<th>Penilaian Manual</th>
									<th>Penilaian Fuzzy</th>
								</tr>
							</thead>
							<?php $no = 0 + $offset;?>
							<?php 
							if ($dirasakan->num_rows() > 0) {
								foreach ($dirasakan->result() as $rasa) { 
							?>
							<tbody>
								<tr>
									<td><?php echo ++$no;?></td>
									<td><?php echo $rasa->pertanyaan;?>?</td>
									<td><?php echo $rasa->nilai_min.' / '.ucfirst($rasa->pilihan);?></td>
									<td><?php echo ($rasa->status) ? '<i class="splashy-remove"></i> Unprocess ' : '<i class="splashy-check"></i> Procesed ';?> </td>
								</tr>
							</tbody>
							<?php 
								}
							}else{
								echo "<tr><td colspan='8' align='center'>Maaf, Anda Belum Menjawab " . anchor(site_url('soal'),'Silahkan Isi Questioner'). " </td></tr>";
								}
							?>
						</table>
					</div>
					</p>
				</div>
				<div class="tab-pane" id="tab_l2">
					<p>
					<div class="span12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Pertanyaan</th>
									<th>Penilaian Manual</th>
									<th>Penilaian Fuzzy</th>
								</tr>
							</thead>
							<?php $no = 0 + $offset;?>
							<?php 
							if ($diharapkan->num_rows() > 0) {
								foreach ($diharapkan->result() as $harap) {
							?>
							<tbody>
								<tr>
									<td><?php echo ++$no;?></td>
									<td><?php echo $harap->pertanyaan;?>?</td>
									<td><?php echo $harap->nilai_min.' / '.ucfirst($harap->pilihan);?></td>
									<td><?php echo ($harap->status) ? '<i class="splashy-remove"></i> Unprocess ' : '<i class="splashy-check"></i> Procesed ';?> </td>
								</tr>
							</tbody>
							<?php 
								}
							}else{
								echo "<tr><td colspan='8' align='center'>Maaf, Anda Belum Menjawab " . anchor(site_url('soal'),'Silahkan Isi Questioner'). " </td></tr>";
							}
							?>
						</table>
					</div>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
