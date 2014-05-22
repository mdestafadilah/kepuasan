<?php 
	$data = array(
			'class' => "form-horizontal well",
	);
	echo form_open_multipart('pelanggan/save',$data);
?>
	<fieldset>
		<p class="f_legend">Tambah Data Pelanggan</p>
		<div class="control-group">
			<label class="control-label">Nama Depan</label>
			<div class="controls">
				<input type="text" class="span10" /> <span class="help-block">*nama depan</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Belakang</label>
			<div class="controls">
				<input type="text" class="span10" /> <span class="help-block">*nama belakang</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"> Foto </label>
			<div data-fileupload="image" class="fileupload fileupload-new"><input type="hidden" />
				<div style="width: 50px; height: 50px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/50x50/EFEFEF/AAAAAA" alt="" /></div>
				<div style="width: 50px; height: 50px; line-height: 50px;" class="fileupload-preview fileupload-exists thumbnail"></div>
				<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" /></span>
				<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Lahir</label>
			<div class="input-append date" id="dp2" data-date-format="dd/mm/yyyy">
				<input class="span6" type="text" readonly="readonly" /><span class="add-on"><i class="splashy-calendar_day"></i></span>
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Alamat Tinggal</label>
			<div class="controls">
				<textarea cols="30" rows="5" class="span10"></textarea>
				<span class="help-block">*Selengkap-lengkapnya</span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button class="btn" type="submit">Form button</button>
			</div>
		</div>
	</fieldset>
<?php echo form_close();?>

