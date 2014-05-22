<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Edit Level Pengguna</h3>
			<div class="row-fluid">
			<div class="span8">
				<?php echo $message;?>
				<?= form_open("group/edit/".$group->id,'class="form-vertikal"');?>
				     <fieldset>
				     <div class="control-group formSep">
				      		<label class="control-label">Level Name: </label>
							<div class="controls">
							<?php $n = array(
										'type' => 'text',
										'name' => 'name',
										'class'=> 'span4',
										'id' => 'name',	
										'value' => $group->name,
									);
							?>
								<?= form_input($n);?>
							</div>
				      </div>			     
				      	  <div class="control-group formSep">
				      		<label class="control-label">Level Description: </label>
							<div class="controls">
							<?php $d = array(
										'type' => 'text',
										'name' => 'description',
										'class'=> 'span4',
										'id' => 'description',	
										'value' => $group->description,
									);
							?>
								<?= form_input($d);?>
							</div>
				      </div>
				      <?php echo form_hidden(array('id'=>$group->id)); ?>
				      	<div class="controls">
							<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
							<a href="<?=site_url('group');?>" class="btn">Cancel</a>
						</div>
				</fieldset>
				<?= form_close();?>
		</div>
		</div>
	</div>
</div>