<div id="loading_layer" style="display:none"><?= img('ajax_loader.gif')?></div>
<p>Login sebagai <?php echo ucfirst($this->session->userdata('email'));?> </p>

<p><a href="<?php echo base_url('/index.php/auth/logout');?>">Keluar</a></p>
<p><a href="<?php echo base_url('/index.php/user/manajer/test');?>">Tambah Pelanggan</a></p>
