<h1>Add to admin</h1>
<p>Are you sure you want to deactivate the user '<?php echo $user->username; ?>'</p>
	
<?php echo form_open("user/add_to_admin/".$user->id);?>

  <p>
  	<label for="confirm">Admin:</label>
    <input type="radio" name="group" value="admin" checked="checked" />
  	<label for="confirm">Direktur:</label>
    <input type="radio" name="group" value="direktur" />
  </p>
  
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p><?php echo form_submit('submit', 'Submit');?></p>

<?php echo form_close();?>