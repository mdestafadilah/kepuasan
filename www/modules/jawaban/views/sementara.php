<!-- 
<div class="heading clearfix">
	<h3 class="pull-left">Pilih Query Fuzzy Tahani</h3>

</div>
<table>
	<p>
		<a href="<?php echo site_url('jawaban/query/dan');?>"
			class="btn btn-inverse"><i class="splashy-zoom"></i> Query "DAN" </a>
	
		<a href="<?php echo site_url('jawaban/query/atau');?>"
			class="btn btn-inverse"><i class="splashy-zoom"></i> Query "OR" </a>
	</p>
</table>
-->
<?php
// Dropdown choice..
$aturan = array( '- Pilih -' );
$aturs = $this->aturan_model->get_all();
foreach ($aturs as $atur)
{
	$aturan[$atur->aturan_id] = ucfirst($atur->variabel);
}
$data['aturan_id'] = array(
		'name'  => 'aturan_id',
		'id'    => 'aturan',
		'type'  => 'text',
		'value' => $aturs
);
// Keterangan dimensi..
$dimensi = $this->dimensi_model->as_array()->get_all();

$options = array(
		'and'  => 'DAN',
		'or'    => 'ATAU',
);

$OR_NOT = array('and', 'or');


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
					echo form_dropdown('aturan_id', $aturan,'aturan'); 
					echo form_dropdown('pilihan', $options, 'and');
					?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[1]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[1]['nama']);?>" data-placement="right">Dimensi
							Ketanggapan</a> </span>
				</p>
				<!-- DIMENSI KETANGGAPAN -->
				<?php 		
					echo form_dropdown('aturan_id', $aturan, 'aturan');
					echo form_dropdown('pilihan', $options, 'and');
						
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[2]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[2]['nama']);?>" data-placement="right">Dimensi
							Kepastian</a> </span>
				</p>
				<!-- DIMENSI KEPASTIAN -->
				<?php 		
					echo form_dropdown('aturan_id', $aturan, 'aturan');
					echo form_dropdown('pilihan', $options, 'and');
						
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[3]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[3]['nama']);?>" data-placement="right">Dimensi
							Empati</a> </span>
				</p>
				<!-- DIMENSI EMPATI -->
				<?php 		
					echo form_dropdown('aturan_id', $aturan, 'aturan');
					echo form_dropdown('pilihan', $options, 'and');
						
				?>
				<p>
					<span class="label label-gebo"><a href="#" class="pop_over"
						data-content="<?php echo ucwords($dimensi[4]['keterangan']);?>"
						data-original-title="<?php echo 'Dimensi' . ucwords($dimensi[4]['nama']);?>" data-placement="right">Dimensi
							Tangible</a> </span>
				</p>
				<!-- DIMENSI BERWUJUD -->
				<?php 		
					echo form_dropdown('aturan_id', $aturan, 'aturan'); 
					echo form_dropdown('pilihan', $options, 'and');
						
				?>
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
					<tbody>
						<tr>
							<td>Data</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<?php
		echo form_open('jawaban/query/');
		?>
			<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Proses </button> |
			<a href="<?=site_url('jawaban/query/atau');?>" class="btn">Cancel</a>
	<?php
		echo form_close();
	?>
</div>

		