
<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Profile Pengguna</h3>
		<div class="row-fluid">
			<div class="span12">
				<div class="vcard">
					<img class="thumbnail" src="foto" alt="" />
					<ul>
						<li class="v-heading">Login Information</li>
						<?php $data= $this->ion_auth->user()->row();?>
						<?php $grup= $this->ion_auth->group()->row();?>
						<li><span class="item-key">Username</span>
							<div class="vcard-item">
								<?php echo $data->username;?>
							</div>
						</li>
						<li><span class="item-key">Email</span>
							<div class="vcard-item">
								<?php echo $data->email; ?>
							</div>
						</li>
						<li><span class="item-key">Level</span>
							<div class="vcard-item">Manajer</div>
						</li>
						<li><span class="item-key">Hak Akses:</span>
							<div class="vcard-item">
								<ul class="list_a">
									<li>CRUD Pengguna Sistem</li>
									<li>CRUD Pelanggan PT. Narendra Krida</li>
									<li>CRUD Perawat PT. Narendra Krida</li>
									<li>CRUD Pertanyaan Sistem</li>
								</ul>
							</div>
						</li>

						<li class="v-heading">Personal Information</li>
						<li>
							<div class="sepH_a item-list clearfix">
								<?php
								if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('manajer') || $this->ion_auth->in_group('direktur'))
								{
									echo "Not Avaliable";
								}else{
									// some action
								}
								?>
							</div>
						</li>
						<li class="v-heading">Aktifitas Login <span> (latest 24 hours)</span>
						</li>
						<li>
							<ul class="unstyled sepH_b item-list">
								<li>
								<li><i class="splashy-contact_grey_edit sepV_b"></i> Aktif pada: <?php echo date('r',$data->created_on);?></li>
								<li><i class="splashy-smiley_amused sepV_b"></i> Terakhir login: <?php echo date('r',$data->last_login);?></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
