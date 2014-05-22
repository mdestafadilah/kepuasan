<?php
//	echo form_open( current_url() );
echo form_open( 'jawaban/query/atau' );
// 	echo dump($_POST);
// 	echo "<pre>";
// 	print_r($this->db->last_query());
// 	echo "</pre>";
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
					echo form_dropdown('dimen_handal', $dimen_handal, set_value('dimen_handal'), 'id="kehandalan"'); 
					?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[1]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[1]['nama']);?>" data-placement="right">Dimensi
							Ketanggapan</a> </span>
				</p>
				<!-- DIMENSI KETANGGAPAN -->
				<?php
					// Keterangan dimensi..
					echo form_dropdown('dimen_tanggap', $dimen_tanggap, set_value('dimen_tanggap'), 'id="ketanggapan"'); 
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[2]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[2]['nama']);?>" data-placement="right">Dimensi
							Kepastian</a> </span>
				</p>
				<!-- DIMENSI KEPASTIAN -->
				<?php
					// Keterangan dimensi..
					echo form_dropdown('dimen_pasti', $dimen_pasti, set_value('dimen_pasti'), 'id="kepastian"'); 
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[3]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[3]['nama']);?>" data-placement="right">Dimensi
							Empati</a> </span>
				</p>
				<!-- DIMENSI EMPATI -->
				<?php
					// Keterangan dimensi..
					echo form_dropdown('dimen_empati', $dimen_empati, set_value('dimen_empati'), 'id="empati"'); 
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[4]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[4]['nama']);?>" data-placement="right">Dimensi
							Tangible</a> </span>
				</p>
				<!-- DIMENSI BERWUJUD -->
				<?php
					// Keterangan dimensi..
					echo form_dropdown('dimen_wujud', $dimen_wujud, set_value('dimen_wujud'), 'id="berwujud"'); 
				?>
				<div class="row-fluid">
				<?php echo br(2);?>
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Proses </button>
					<?php
						echo form_close();
					?>
				</div>
			</div>
			
			<div class="span9">
			<div class="alert alert-block alert-error fade in">
			<a href="#" data-dismiss="alert" class="close">X</a>
				Find: <strong><?php echo $totals; ?> Data Procesed </strong>
			</div>
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>No</th>
							<th>Konsumen</th>
							<th>Pertanyaan</th>
							<th>Dimensi</th>
							<th>Kecewa</th>
							<th>Biasa</th>
							<th>Puas</th>
							<th>Strength</th>
						</tr>
					</thead>
					<?php $no = 0;?>
					<?php foreach ($koloms as $row) : ?>
						<tbody>
							<tr>
								<td style="width: 40px"><?php echo ++$no;?></td>
								<td> <?php echo ucwords($row->first_name." ".$row->last_name); ?></td>
								<td> <?php echo $row->pertanyaan; ?></td>
								<td> <?php echo ucfirst($row->dimensi); ?></td>
								<td> <?php echo $row->MuKecewa; ?></td>
								<td> <?php echo $row->MuBiasa; ?></td>
								<td> <?php echo $row->MuPuas; ?></td>
								<td> <?php echo $row->MuFire; ?></td>
							</tr>
						</tbody>
						<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>

		