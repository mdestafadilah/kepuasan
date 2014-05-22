<!DOCTYPE html>
<html lang="en" class="error_page">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo  $heading."\n"; ?></title>
		<!-- Bootstrap framework -->
		<style type="text/css">@import url("<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>");</style>
       	<style type="text/css">@import url("<?php echo base_url() . 'assets/css/bootstrap-responsive.min.css'; ?>");</style>
		
		<!-- main styles -->
		<style type="text/css">@import url("<?php echo base_url() . 'assets/css/style.css'; ?>");</style>
		<!-- IF ONLINE -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Jockey+One" />
            
	</head>
	<body>

		<div class="error_box">
			<h1>File not found</h1>
			<?php echo  $message; ?>
			<a href="javascript:history.back()" class="back_link btn btn-small">Kembali</a>
		</div>

	</body>
</html>