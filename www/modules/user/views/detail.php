
<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Profile Pengguna</h3>
		<div class="row-fluid">
			<div class="span12">
				<div class="vcard">
					<img class="thumbnail" src="<?=img_url();?>none.jpg" alt="foto" />
									<ul>
						<li class="v-heading">Login Information</li>
				
						<li><span class="item-key">Username</span>
							<div class="vcard-item">
								<?php echo ucfirst($user->username);?>
							</div>
						</li>
						<li><span class="item-key">Email</span>
							<div class="vcard-item">
								<?php echo $user->email; ?>
							</div>
						</li>
						<li><span class="item-key">Level</span>
							<div class="vcard-item">
							<?php
									$user_groups = $this->ion_auth->get_users_groups($user->id)->result();
									foreach ($user_groups as $gr)
									{
										echo ucfirst($gr->name);
									}
								?>		
							</div>
						</li>
						<li><span class="item-key">Hak Akses:</span>
							<div class="vcard-item">
								<ul class="list_a">
									<li>Akses Sistem</li>
									<li>Akses Data</li>
								</ul>
							</div>
						</li>

						<li class="v-heading">Personal Information</li>
						<li>
							<div class="sepH_a item-list clearfix">
								<p>Jika admin, direktur && manajer maka tidak tampil </p>					
								<p>Jika perawat && pelanggan maka tampil </p>
							</div>
						</li>
						<li class="v-heading">Aktifitas Login <span> (latest 24 hours)</span>
						</li>
						<li>
							<ul class="unstyled sepH_b item-list">
								<li>
								<li><i class="splashy-contact_grey_edit sepV_b"></i> Aktif pada: <?php echo date('r',$user->created_on);?></li>
								<li><i class="splashy-smiley_amused sepV_b"></i> Terakhir login: <?php echo date('r',$user->last_login);?></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>