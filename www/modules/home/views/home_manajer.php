<div class="row-fluid">
<div class="span12">
<h3 class="heading">Master Umum</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('perawat')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_perawat;?></span> Perawat</a></li>
			<li><a href="<?=site_url('pelanggan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_konsumen;?></span>Konsumen</a></li>
			<li><a href="<?=site_url('user/manajer/list_rawat_konsumen')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/multi-agents.png')">
				Informasi</a></li>
			<li><a href="<?=site_url('mu')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/database.png')">
				Keanggotaan</a></li>
			<li><a href="<?=site_url('aturan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/processing.png')">
				Rule's</a></li>
		</ul>
	</div>
	
	<h3 class="heading">Master Kepuasan</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('soal/publish')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/network-pc.png')">
				<span class="label label-important"><?php echo $total_soal; //ada di user/manajer ?></span>Soal</a></li>
			<li><a href="<?=site_url('jawaban/konsumen')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/addressbook.png')">
				Jawaban</a></li>
			<li><a href="<?=site_url('kesimpulan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/email.png')">
				Kesimpulan</a></li>
			<li><a href="<?=site_url('dimensi')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/edit.png')">
				Dimensi</a></li>
			<li><a href="<?=site_url('jawaban/query')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/search.png')">
				Fuzzy</a></li>
		</ul>
	</div>
	<!-- 
	<h3 class="heading">Laporan Kepuasan</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('grafik/soal')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/bar-chart.png')">
				Soal</a></li>
			<li><a href="<?=site_url('grafik/perawat')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/bar-chart.png')">
				Perawat</a></li>
			<li><a href="<?=site_url('grafik/pelanggan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/bar-chart-02.png')">
				Konsumen</a></li>
			<li><a href="<?=site_url('jawaban/query')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/search.png')">
				Fuzzy</a></li>
		</ul>
	</div>
	-->
</div>
</div>