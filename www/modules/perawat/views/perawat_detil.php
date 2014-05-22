<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Profile Perawat</h3>
		<div class="row-fluid">
			<div class="span12">
				<div class="vcard">
					<?php
						
					?>
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
							<?php
									echo $user->email;
									// tricky tampilan aja, masih error, hee
									// dump($this->db->last_query());
							?>
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
								?>								</div>
						</li>
						<li><span class="item-key">Hak Akses:</span>
							<div class="vcard-item">
								<ul class="list_a">
									<li>Mengakses Sistem</li>
									<li>Mengubah Password</li>
									<li>Mengubah Profile Pengguna</li>
									<li>Melihat Hasil Kepuasan</li>
								</ul>
							</div>
						</li>
						<li class="v-heading">Personal Information</li>
						<li>
						<?php	
							echo "<span class='item-key'>Nama Depan</span>
					 		<div class='vcard-item'>".ucfirst($user->first_name)."</div>";
					 		echo "<li><span class='item-key'>Nama Belakang</span>
					 		<div class='vcard-item'>".ucfirst($user->last_name)."</div></li>";
					 		echo "<li><span class='item-key'>Tanggal Lahir</span>
					 		<div class='vcard-item'>".ucfirst($user->dob)."</div></li>";
					 		echo "<li><span class='item-key'>Jenis Kelamin</span>
					 		<div class='vcard-item'>".ucfirst($user->sex)."</div></li>";
					 		echo "<li><span class='item-key'>Ijasah</span>
					 		<div class='vcard-item'>".'Not Avaliable';"</div></li>";
					 		echo "<li><span class='item-key'>Jenis</span>
					 		<div class='vcard-item'>".'Not Avaliable'."</div></li>";
					 		echo "<li><span class='item-key'>Alamat</span>
					 		<div class='vcard-item'>".ucfirst($user->address)."</div></li>";
					 		?>
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
