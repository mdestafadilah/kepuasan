<div id="loading_layer" style="display:none"><?= img('ajax_loader.gif')?></div>

<h1>Pengguna</h1>
<div class="heading clearfix">
	<h3 class="pull-left">Daftar Pengguna Sistem</h3>
	<span class="pull-right label label-important">NOTIF PENGGUNA LAGI ONLINE</span>
</div>
<table class="table table-bordered table-striped">
			<thead><tr style="background-color:#000000; color:#FFFFFF;"><td colspan="9" height="15" style="text-align: center">MASTER PENGGUNA</td></tr></thead>
				<thead>
				<tr style="color:#000;" align="center">
					<th style="text-align: center;">No</th>
					<th style="text-align: center;">Username</th>
					<th style="text-align: center;">Email</th>
					<th style="text-align: center;">Last Login</th>
					<th style="text-align: center;">Groups</th>
					<th style="text-align: center;">Status</th>
					<th style="text-align: center;" colspan="3"><a href="<?php echo base_url(); ?>user/new_user" id="btn-add"><i class="splashy-document_letter_add"></i> Tambah Data</a></th>
				</tr>
				</thead>
	<?php $i = 0;?>
	<?php foreach ($users as $user):?>
		<tbody>
		<tr>
			<td style="width:40px"><?php echo ++$i; ?></td> 
			<td><?php echo ucfirst($user->username);?></td>
			<td><?php echo $user->email;?></td>
			<td><?php echo date('r',$user->last_login);?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo ucfirst($group->name);?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? 'Aktif' : 'Tidak Aktif';?></td>
			
			<td width="80"><a href="<?php echo base_url(); ?>user/detail/<?php echo $user->id; ?>" class="cbpelanggan" id="btn-edit"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="70"><a href="<?php echo base_url(); ?>user/edit/<?php echo $user->id; ?>" class="cbpelanggan" id="btn-edit"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?php echo base_url(); ?>user/hapus/<?php echo $user->id; ?>" onclick="return confirm('Anda yakin?');" id="btn-delete"><i class="icon-trash"></i> Hapus</a></td>
			<?php /*echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Tidak Aktif') : anchor("auth/activate/". $user->id, 'Aktif'); */?>
			
		</tr>
		</tbody>
	<?php endforeach;?>
</table>
	<?php echo $pagination;?>
	<p><a href="<?php echo site_url('user/admin/newUser');?>">Create a new user</a> | <a href="<?php echo site_url('auth/logout');?>">Keluar</a></p>
	