<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?=$title;?></title>
        <!-- Bootstrap framework -->
        <?= css('bootstrap.min.css')?>
        <?= css('bootstrap-responsive.min.css')?>
        <!-- breadcrumbs-->
        <link rel="stylesheet" href="<?=asset_url()?>lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- gebo dark theme-->
        <?= css('dark.css')?>
         <!-- jQuery UI theme-->
         <link rel="stylesheet" href="<?=asset_url();?>lib/jquery-ui/css/Aristo/Aristo.css" />
        <!-- notifications -->
        <link rel="stylesheet" href="<?=asset_url();?>lib/sticky/sticky.css" />
        <!-- splashy icons -->
        <link rel="stylesheet" href="<?=asset_url();?>img/splashy/splashy.css" />
		<!-- enhanced select -->
        <link rel="stylesheet" href="<?=asset_url()?>lib/chosen/chosen.css" />
        <!-- tooltips-->
        <link rel="stylesheet" href="<?=asset_url()?>lib/qtip2/jquery.qtip.min.css" />
      	<!-- datepicker -->
        <link rel="stylesheet" href="<?=asset_url()?>lib/datepicker/datepicker.css" />
		<!-- nice form elements -->
        <link rel="stylesheet" href="<?=asset_url();?>lib/uniform/Aristo/uniform.aristo.css" />
		<!-- main styles -->
        <?= css('style.css')?>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
	
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?=asset_url();?>img/favicon.ico">
		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <?= js('html5.js')?>
            <?= js('respond.min.js')?>
            <?= js('excanvas.min.js')?>
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
                            <a class="brand" href="<?php echo base_url();?>">Dashboard Panel</a>
                            <ul class="nav user_menu pull-right">
                            <li class="divider-vertical hidden-phone hidden-tablet"></li>
                            	<li class="dropdown">
                                	<div class="btn-group pull-right">
										<button class="btn btn-inverse"><i class="icon-user icon-white"></i> <?php echo $welcome;?></button>
										<button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
										</button>
                                    <ul class="dropdown-menu">
										<li><a href="<?=site_url('auth/change_password');?>"><i class="splashy-contact_blue_edit"></i> Ubah Password</a></li>
										<li><a href="<?=site_url('user');?>"><i class="splashy-view_list"></i> Manajemen User</a></li>
										<li class="divider"></li>
										<li><a href="<?=site_url('auth/logout');?>"><i class="icon-off"></i> Log Out</a></li>
                                    </ul>
           							</div>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                    	 <li>
                                            <a href="<?=site_url();?>"><i class="icon-home icon-white"></i> Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <i class="icon-th icon-white"></i> Master Umum <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdwon">
                                                	<a href="#"><i class="splashy-contact_grey"></i> Data Pengguna<b class="caret-right"></b></a>
                                                	<ul class="dropdown-menu">
                                                		<li><a href="<?=site_url('user');?>"><i class="splashy-document_a4_okay"></i> All User</a>
                                                        <li><a href="<?=site_url('user/new_user');?>"><i class="splashy-contact_grey_add"></i> New User</a>
                                                        <li><a href="<?=site_url('group/add');?>"><i class="splashy-group_grey_add"></i> New Group</a>
                                                		<li><a href="<?=site_url('user/aktif');?>"><i class="splashy-contact_grey_new"></i> Active User</a>
                                                		<li><a href="<?=site_url('user/nonaktif');?>"><i class="splashy-contact_grey_remove"></i> Nonactive User</a>
                                                	</ul>
                                                </li>
                                                <li><a href="<?=site_url('perawat');?>"><i class="splashy-contact_grey_add"></i> Data Perawat</a></li>
                                                <li><a href="<?=site_url('pelanggan');?>"><i class="splashy-contact_grey_add"></i> Data Pelanggan</a></li>
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                                            <i class="splashy-document_letter"></i> Master Kepuasan <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?=site_url('soal')?>"><i class="splashy-document_a4_add"></i> Data Pertanyaan</a></li>
                                                <li><a href="<?=site_url('dimensi')?>"><i class="splashy-document_a4_add"></i> Data Dimensi</a></li>
                                                <li><a href="<?=site_url('jawaban')?>"><i class="splashy-document_a4_add"></i> Data Hasil</a></li>
                                                <li><a href="<?=site_url('kesimpulan')?>"><i class="splashy-document_a4_add"></i> Data Kesimpulan</a></li>
                                                
                                                <!--
                                                <li class="dropdown">
                                              		<a href="#">Data Questioner<b class="caret-right"></b></a>
                                              		<ul class="dropdown-menu">
                                              			<li><a href="#">Submenu</a>
                                              		</ul>
                                              	</li>
                                              	-->
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                                            <i class="icon-book icon-white"></i> Manual Book <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?=base_url()?>ionauth"><i class="splashy-application_windows_edit"></i> Ion Auth</a></li>
                                                <li><a href="<?=base_url()?>codeigniter"><i class="splashy-application_windows_edit"></i> Codeigniter</a></li>
                                                <li><a href="<?=base_url()?>manual"><i class="splashy-application_windows_edit"></i> Kepuasan</a></li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div> <!-- end navbar navbar-fixed-top -->
            </header>
            
            <!-- main content -->
             <div id="contentwrapper">
                <div class="main_content">
				<nav>
					<div id="jCrumbs" class="breadCrumb module">
					<?= '<a href="#"><i class="icon-home"></i></a>'.' > '.set_breadcrumb()?>
					</div>
				</nav>
				<?php 
 					$this->load->view($module.'/'.$view);
 				?>
                </div>
                    
            <!--  Place Sidebar Here! -->

            <!-- ttip_r -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
							<div class="sidebar_inner">
							<!-- search action -->
								<form id="cse-search-box" action="http://google.com/cse" class="input-append" method="post" >
									<input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Google search.. " />
									 <input type="hidden" name="cx" value="YOUR SEARCH ENGINE ID goes here" />
								  	 <input type="hidden" name="ie" value="UTF-8" />
									<button type="submit" name="sa" class="btn"><i class="icon-search"></i></button>
								</form>
								<div id="side_accordion" class="accordion">
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-th"></i> Start Information
											</a>
										</div>
										<div class="accordion-body collapse in" id="collapseFour">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li class="nav-header">System</li>
														<li class="active">Browser: <?=$agen['agent'];?></li>
														<li>OS: <?=$agen['platform']?></li>
														<li>IP Address: <?php 
															$domain = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
															echo "<strong>$domain</strong>";
														?>
														</li>
													<li class="nav-header">Application</li>
														<li><a href="javascript:void(0)"><?=$lisensi;?></a></li>
														<li><a href="javascript:void(0)">Places: <?=$perusahaan;?></a></li>
														<li><a href="javascript:void(0)">Author: <?=$programmer;?></a></li>
													<li class="divider"></li>
													<li><a href="javascript:void(0)">Version: <?=$version;?></a></li>
													<li><a href="javascript:void(0)"></a></li>
												</ul>
											</div>
										</div>
									</div>
										<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseLong" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-th"></i> End Information
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseLongs">
											<div class="accordion-inner">
												Some text to show sidebar scroll bar<br>
												Duis auctor varius risus vitae commodo. Fusce nec odio massa, ut dapibus justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus, mauris sit amet feugiat tempor, nulla diam gravida magna, in facilisis sapien tellus non ligula. Mauris sapien turpis, sodales ac lacinia sit amet, porttitor in lacus. Pellentesque tincidunt malesuada magna, in egestas augue sodales vel. Praesent iaculis sapien at ante sodales facilisis.
											</div>
										</div>
									</div>
								</div>
								
								<div class="push"></div>
							</div> <!-- END SIDEBAR INNER -->
							
							
<!-- 							<div class="sidebar_info"> -->
<!-- 								<ul class="unstyled"> -->
<!-- 									<li> -->
<!-- 										<span class="act act-warning">65</span> -->
<!-- 										<strong>Soal Terjawab</strong> -->
<!-- 									</li> -->
<!-- 									<li> -->
<!-- 										<span class="act act-success">10</span> -->
<!-- 										<strong>Total Soal Aktif</strong> -->
										
<!-- 									</li> -->
<!-- 									<li> -->
<!-- 										<span class="act act-danger">85</span> -->
<!-- 										<strong>Total apa ajah</strong> -->
<!-- 									</li> -->
<!-- 								</ul> -->
<!-- 							</div> -->
							
						</div> <!-- End Antiscroll-content -->
					</div> <!-- End Antriscroll-intent -->
				</div>
			</div>
            <!--  End Of Sidebar! -->
            
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
			<!-- fix for ios orientation change -->
			<?= js('ios-orientationchange-fix.js')?>
			<!-- jBreadcrumbs -->
			<script type="text/javascript" src="<?=asset_url();?>lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
			<!-- sticky messages -->
            <script type="text/javascript" src="<?=asset_url();?>lib/sticky/sticky.min.js"></script>
            
			<!-- Jquery UI -->
			<script type="text/javascript" src="<?=asset_url();?>lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
			<!-- touch events for jquery ui-->
            <script src="<?=asset_url();?>js/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- masked inputs -->
            <script src="<?=asset_url();?>js/forms/jquery.inputmask.min.js"></script>
            <!-- autosize textareas -->
            <script src="<?=asset_url();?>js/forms/jquery.autosize.min.js"></script>
            <!-- textarea limiter/counter -->
            <script src="<?=asset_url();?>js/forms/jquery.counter.min.js"></script>
            <!-- animated progressbars -->
            <script src="<?=asset_url();?>js/forms/jquery.progressbar.anim.js"></script>
             <!-- input spinners -->
            <script src="<?=asset_url();?>js/forms/jquery.spinners.min.js"></script>
			
			<!-- datepicker -->
            <script src="<?=asset_url();?>lib/datepicker/bootstrap-datepicker.min.js"></script>
            <!-- timepicker -->
            <script src="<?=asset_url();?>lib/datepicker/bootstrap-timepicker.min.js"></script>
            <!-- tag handler -->
            <script src="<?=asset_url();?>lib/tag_handler/jquery.taghandler.min.js"></script>
            
			<!-- scrollbar -->
			<script type="text/javascript" src="<?=asset_url();?>lib/antiscroll/antiscroll.min.js"></script>
			<script type="text/javascript" src="<?=asset_url();?>lib/antiscroll/jquery-mousewheel.js"></script>
			
			<!-- styled form elements -->
            <script type="text/javascript" src="<?=asset_url();?>lib/uniform/jquery.uniform.min.js"></script>
			
			<!-- multiselect -->
            <script type="text/javascript" src="<?=asset_url();?>lib/multiselect/js/jquery.multi-select.min.js"></script>
            <!-- enhanced select (chosen) -->
            <script type="text/javascript" src="<?=asset_url();?>lib/chosen/chosen.jquery.min.js"></script>
         	
         	<!-- file upload js -->
         
			<!-- common functions -->
			<?= js('gebo_common.js')?>
			
			<!-- form functions -->
            <?= js('gebo_forms.js')?>
			
			<!-- jquery validation -->
			<script type="text/javascript" src="<?=asset_url();?>lib/validation/jquery.validate.min.js"></script>
			
			<!-- validation functions -->
			<?= js('gebo_validations.js')?>
			
			<!-- buttons functions -->
			<?= js('gebo_btns.js')?>
	
            <!-- notifications functions -->
            <?= js('gebo_notifications.js');?>
            
            <!-- datatable -->
			<script src="<?=asset_url();?>lib/datatables/jquery.dataTables.min.js"></script>
			<!-- additional sorting for datatables -->
			<script src="<?=asset_url();?>lib/datatables/jquery.dataTables.sorting.js"></script>
			<!-- tables functions -->
			<?= js('gebo_tables.js');?>			
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		  </div>
    </div>

	</body>
</html>