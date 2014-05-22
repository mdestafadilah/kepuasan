<?php echo $message; ?>
<div class="row-fluid">
<div class="span12">
	<h3 class="heading">Hak Pelanggan</h3>
	<div class="span12">
		<ul class="pull-left dshb_icoNav tac">
			<li><a href="<?=site_url('auth/change_password')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/configuration.png')">
				Change Pass</a></li>
			<li><a href="<?=site_url('user/konsumen/profile')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/agent.png')">
				Profile</a></li>
			<li><a href="<?=site_url('soal/tampil')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/edit.png')">
				Questioner</a></li>
			<li><a href="<?=site_url('jawaban/soal')?>"
				style="background-image: url('<?=asset_url();?>img/gCons/addressbook.png')">
				Results</a></li>
		</ul>
	</div>
</div>
</div>