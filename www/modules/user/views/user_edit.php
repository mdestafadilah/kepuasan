<?php echo $message;?>
<?php 
echo form_open(uri_string());
?>
<fieldset>
	<p class="f_legend">Edit Pengguna</p>
	<div class="control-group">
		<label class="control-label">Level: </label>
		<div class="controls">
			<?php foreach ($groups as $group):?>
			<label class="checkbox"> <?php
			$gID=$group['id'];
			$checked = null;
			$item = null;
			foreach($currentGroups as $grp) {
				if ($gID == $grp->id) {
					$checked= ' checked="checked"';
					break;
				}
			}
			?> <input type="checkbox" name="groups[]"
				value="<?php echo $group['id'];?>" <?php echo $checked;?>> <?php echo $group['name'];?>
			</label>
			<?php endforeach?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Username: </label>
		<div class="controls">
			<?php $u = array(
					'type' => 'text',
					'name' => 'username',
					'class'=> 'span4',
					'id' => 'username',
					'value' => $single->username,
			);
			?>
			<?= form_input($u);?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Email: </label>
		<div class="controls">
			<?php
			$e = array(
					'type' => 'text',
					'name' => 'email',
					'class'=> 'span4',
					'id' => 'email',
					'value' => $single->email,
			);
			?>
			<?= form_input($e);?>
		</div>
	</div>
	<?php echo form_hidden(array('id', $single->id)); ?>
	<?php //echo form_hidden($csrf); ?>
	<br />
	<div class="controls">
		<button type="submit" class="btn btn-inverse" id="sticky_b">
			<i class="splashy-check"></i> Simpan
		</button>
		| <a href="<?=site_url('user');?>" class="btn">Cancel</a>
	</div>
</fieldset>
<?php echo form_close(); ?>
