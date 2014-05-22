<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
    
        <!-- Bootstrap framework -->
        <?= css('bootstrap.min.css')?>
        <?= css('bootstrap-responsive.min.css')?>
           
        <!-- gebo blue theme-->
        <?= css('green.css')?>
            
        <!-- tooltips-->
        <?= css('jquery.qtip.min.css')?>
        
        <!-- main styles -->
        <?= css('style.css')?>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <?= js('html5.js')?>
            <?= js('respond.min.js')?>
        <![endif]-->
		
		<script>
			//* hide all elements & show preloader
			document.getElementsByTagName('html')[0].className = 'js';
		</script>
    </head>
    <body>
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="#"><i class="icon-home icon-white"></i> Admin Panel</a>
                            <ul class="nav user_menu pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another Action</a></li>
										<li class="divider"></li>
										<li><a href="#">Another Action</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> menu <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> menu <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> menu <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
					<?php 
	 					$this->load->view($module.'/'.$view);
	 				?>
                </div>
            </div>
            
            <!-- BOOTSTRAP ENGINGE -->
            
            <?= js('jquery.min.js')?>
			<!-- smart resize event -->
			<?= js('jquery.debouncedresize.min.js')?>
			<!-- hidden elements width/height -->
			<?= js('jquery.actual.min.js')?>
			<!-- js cookie plugin -->
			<?= js('jquery.cookie.min.js')?>
			<!-- main bootstrap js -->
			<?= js('bootstrap.min.js')?>
			<!-- tooltips -->
			<?= js('jquery.qtip.min.js')?>
			<!-- fix for ios orientation change -->
			<?= js('ios-orientationchange-fix.js')?>
			<!-- scrollbar -->
			<?= js('antiscroll.js')?>
			<?= js('jquery-mousewheel.js')?>
			
			<!-- common functions -->
			<?= js('gebo_common.js')?>
	
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div>
	</body>
</html>