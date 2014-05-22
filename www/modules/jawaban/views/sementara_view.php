<?php
	// echo form_open( current_url() );
	echo form_open( 'jawaban/query/search' );
	
	// Keterangan dimensi..
	$dimensi = $this->dimensi_model->as_array()->get_all();
?>
<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Running your query..</h3>
		<div class="row-fluid sepH_c">
			<div class="span3">
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[0]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[0]['nama']);?>" data-placement="right">Dimensi
							Kehandalan</a> </span>
				</p>
					<!-- DIMENSI KEHANDALAN -->
					<?php
					$handals = array('' => '');
					foreach ($kehandalan as $handal)
					{
						$handals[$handal->aturan_id] = "Kehandalan ".ucfirst($handal->variabel);
					}
					// Keterangan dimensi..
					echo form_dropdown('kehandalan', $handals, set_value('kehandalan'), 'id="kehandalan"'); 
					echo form_dropdown('pilih_handal', $pilih_handal, set_value('pilih_kehandalan'));
					?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[1]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[1]['nama']);?>" data-placement="right">Dimensi
							Ketanggapan</a> </span>
				</p>
				<!-- DIMENSI KETANGGAPAN -->
				<?php
				$tanggaps = array('' => ''); 		
				foreach ($ketanggapan as $tanggap)
				{
					$tanggaps[$tanggap->aturan_id] = "Ketanggapan ".ucfirst($tanggap->variabel);
				}
					// Keterangan dimensi..
					echo form_dropdown('ketanggapan', $tanggaps, set_value('ketanggapan'), 'id="ketanggapan"'); 
					echo form_dropdown('pilih_tanggap', $pilih_tanggap, set_value('pilih_tanggap'));	
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[2]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[2]['nama']);?>" data-placement="right">Dimensi
							Kepastian</a> </span>
				</p>
				<!-- DIMENSI KEPASTIAN -->
				<?php
				$pastis = array('' => '');
				foreach ($kepastian as $pasti)
				{
					$pastis[$pasti->aturan_id] = "Kepastian ".ucfirst($pasti->variabel);
				}
					
					// Keterangan dimensi..
					echo form_dropdown('kepastian', $pastis, set_value('kepastian'), 'id="kepastian"'); 
					echo form_dropdown('pilih_pasti', $pilih_pasti, set_value('pilih_pasti'));		
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[3]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[3]['nama']);?>" data-placement="right">Dimensi
							Empati</a> </span>
				</p>
				<!-- DIMENSI EMPATI -->
				<?php
				$ems = array('' => '');
				foreach ($empati as $em)
				{
					$ems[$em->aturan_id] = "Empati ".ucfirst($em->variabel);
				}
				
					// Keterangan dimensi..
					echo form_dropdown('Empati', $ems, set_value('empati'), 'id="empati"'); 
					echo form_dropdown('pilih_empati', $pilih_empati, set_value('pilih_empati'));		
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[4]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[4]['nama']);?>" data-placement="right">Dimensi
							Tangible</a> </span>
				</p>
				<!-- DIMENSI BERWUJUD -->
				<?php
				$wujuds = array('' => ''); 
				foreach ($berwujud as $wujud)
				{
					$wujuds[$wujud->aturan_id] = "Berwujud ".ucfirst($wujud->variabel);
				}
					// Keterangan dimensi..
					echo form_dropdown('Berwujud', $wujuds, set_value('berwujud'), 'id="berwujud"'); 
				?>
				<div class="row-fluid">
				<?php echo br(2);?>
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Proses </button>
					<?php
						echo form_close();
						dump($_POST);
					?>
				</div>
			</div>
			<div class="span9">
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Konsumen</th>
							<th>Pertanyaan</th>
							<th>Dimensi</th>
							<th>Kecewa</th>
							<th>Biasa</th>
							<th>Puas</th>
							<th>Fire Strength</th>
						</tr>
					</thead>
					<?php $no = 0;?>
					<?php foreach ($real as $row) : ?>
						<tbody>
							<tr>
								<td style="width: 40px"><?php echo ++$no;?></td>
								<td> <?php echo $row->users->username; ?></td>
								<td> <?php echo $row->banksoal->pertanyaan; ?></td>
								<td> <?php echo $row->dimensi->nama; ?></td>
								<td> <?php echo $row->MuKecewa; ?></td>
								<td> <?php echo $row->MuBiasa; ?></td>
								<td> <?php echo $row->MuPuas; ?></td>
								<td> <?php echo $row->MuFire; ?></td>
							</tr>
						</tbody>
						<?php endforeach; ?>
				</table>
				<?php echo $this->db->last_query();?>
			</div>
		</div>
	</div>
</div>

		