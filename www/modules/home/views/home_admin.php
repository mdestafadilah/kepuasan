
<div class="row-fluid">
<div class="span12">
	<h3 class="heading">Pengaturan Umum</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('user')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_pengguna;?></span> Pengguna</a></li>
			<li><a href="<?=site_url('perawat')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_perawat;?></span> Perawat</a></li>
			<li><a href="<?=site_url('pelanggan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_konsumen;?></span>Konsumen</a></li>
			<li><a href="<?=site_url('#')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_manajer;?></span>Manajer</a></li>
			<li><a href="<?=site_url('#')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				<span class="label label-info"><?php echo $total_direktur;?></span>Direktur</a></li>
			<li><a href="<?=site_url('group')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/multi-agents.png')">
				Level</a></li>
		</ul>
	</div>
</div>
</div>
<!-- DATA -->
<div class="row-fluid">
<div class="span12">
	<h3 class="heading">Pengaturan Kepuasan</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('soal/add')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/add-item.png')">
				Tambah Soal</a></li>
			<li><a href="<?=site_url('dimensi/add')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/add-item.png')">
				Dimensi</a></li>
			<li><a href="<?=site_url('jawaban/konsumen')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/cassette.png')">
				Jawaban</a></li>
			<li><a href="<?=site_url('kesimpulan/index')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/shield.png')">
				Kesimpulan</a></li>
			<li><a href="<?=site_url('aturan')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/configuration.png')">
				MU Atturan</a></li>
			<li><a href="<?=site_url('mu')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/processing.png')">
				Keanggotaan</a></li>
		</ul>
	</div>
</div>
</div>
<!-- UTILITY -->
<div class="row-fluid">
<div class="span12">
	<h3 class="heading">Utilitas</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('ionauth')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/addressbook.png')">
				Doc Ionauth</a></li>
			<li><a href="<?=site_url('codeigniter')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/addressbook.png')">
				Doc CI</a></li>
			<li><a href="<?=site_url('manual')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/addressbook.png')">
				Doc Kepuasan</a></li>
			<li><a href="<?=site_url('widget/backup')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/database.png')">
				Backup</a></li>
			<li><a href="<?=site_url('widget/restore')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/database.png')">
				Restore</a></li>
			<li><a href="<?=site_url('widget/whoisonline')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/mouse.png')">
				<span class="label label-info"><?php echo $total_online;?></span>
				Online</a></li>
		</ul>
	</div>
</div>
</div>

