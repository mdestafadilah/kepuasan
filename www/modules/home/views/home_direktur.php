<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Master Data</h3>
		<div class="span12">
			<ul class="pull-left dshb_icoNav tac">
				<li><a href="<?=site_url('user/direktur/profile')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
						Profile</a>
				</li>
				<li><a href="<?=site_url('perawat')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
						Perawat</a>
				</li>
				<li><a href="<?=site_url('pelanggan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
						Konsumen</a>
				</li>
				<li><a href="<?=site_url('soal')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/briefcase.png')">
						Soal</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- START BARIS 1 -->
<div class="row-fluid">
	<div class="span5">
		<h3 class="heading">
			Jenis Soal <small> Berdasar Faktor</small>
		</h3>
		<div id="fl_2">
			<?php echo $soals; ?>
		</div>
	</div>
	<div class="span7">
		<div class="heading clearfix">
			<h3 class="pull-left">Jenis Kelamin</h3>
		</div>
		<div>
			<?php echo $kelamin; ?>
		</div>
	</div>
</div>
<!-- END BARIS 1 -->

<!-- START BARIS 2 -->
<div class="row-fluid">
	<div class="span6">
		<div class="heading clearfix">
			<h3 class="pull-left">Jenis Rawat <small>Berdasarkan Merawat</small></h3>
		</div>
		<div>
		<?php echo $rawat; ?>
		</div>
	</div>
<div class="span6">
		<div class="heading clearfix">
			<h3 class="pull-left">
				Jawaban Konsumen <small> per variabel </small>
			</h3>
		</div>
		<div id="small_grid" class="wmk_grid">
		<?php echo $variabels; ?>
		</div>
	</div>
</div>
