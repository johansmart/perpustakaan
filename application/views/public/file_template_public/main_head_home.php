<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1>
				<a>
				Perpus
				</a>
				</h1>
			</div>
		<!--//logo-->
		<div class="top-nav">
			<?php
			if($this->session->userdata('alumni1sesithissite-01') != ""){
			?>
			<ul class="right-icons">
				<!--
				<li><a href='<?php echo base_url('index.php/alumni'); ?>'><i class='btn btn-default'>Alumni</i></a></li>
				<li><a href='<?php echo base_url('index.php/lowongan'); ?>'><i class='btn btn-default'>Lowongan</i></a></li>
				<li><a href='<?php echo base_url('index.php/informasi'); ?>'><i class='btn btn-default'>Informasi</i></a></li>
				<li><a href='<?php echo base_url('index.php/guestbook'); ?>'><i class='btn btn-default'>Guestbook</i></a></li>
				!-->
				<li><a href='<?php echo base_url('index.php/akun'); ?>'><i class='btn btn-default'>Akun</i></a></li>
				<li><a href='<?php echo base_url('index.php/login/logout'); ?>'><i class='btn btn-default'>Logout</i></a></li>
				
			<?php
			}
			else
			{
			?>
			<ul class="right-icons">
				<!--
				<li><a href='<?php echo base_url('index.php/alumni'); ?>'><i class='btn btn-default'>Alumni</i></a></li>
				<li><a href='<?php echo base_url('index.php/lowongan'); ?>'><i class='btn btn-default'>Lowongan</i></a></li>
				<li><a href='<?php echo base_url('index.php/informasi'); ?>'><i class='btn btn-default'>Informasi</i></a></li>
				<li><a href='<?php echo base_url('index.php/guestbook'); ?>'><i class='btn btn-default'>Guestbook</i></a></li>
				!-->
				<li><a href='<?php echo base_url('index.php/login'); ?>'><i class='btn btn-default'>login</i></a></li>
				<li><a href='<?php echo base_url('index.php/register'); ?>'><i class='btn btn-default'>Register</i></a></li>
			<?php
			}
			?>
			<!--
				<li><span ><i class="glyphicon glyphicon-phone"> </i>+1384 757 546</span></li>
				<li><a  href="<?php echo base_url('index.php/login'); ?>"><i class="glyphicon glyphicon-user"> </i>Login</a></li>
				
				<li>
				<?php
				?>
				<form action='<?php echo base_url('index.php/pages/alumni_search');?>' method='get'>
				<input type="text" class="form-search_head" name="search"  value="" required="" placeholder="Search...">
				
				</li>
				<li>
				<input type="submit" class="form-search_head_submit"  value="Search">
				</form>
				</li>
				
				-->
				
			</ul>
			<div class="nav-icon">
				<div class="hero fa-navicon fa-2x nav_slide_button" id="hero">
						<a href="#"><i class="glyphicon glyphicon-menu-hamburger"></i> </a>
					</div>	
				<!---
				<a href="<?php echo base_url('#'); ?>" class="right_bt" id="activator"><i class="glyphicon glyphicon-menu-hamburger"></i>  </a>
			--->
			</div>
			
		<div class="clearfix"> </div>
			<!---pop-up-box---->
			   
				<link href="<?php echo base_url('assets/template_public/css/popuo-box.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
				<script src="<?php echo base_url('assets/template_public/js/jquery.magnific-popup.js'); ?>" type="text/javascript"></script>
			<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
					    <!----- tabs-box ---->
				<div class="sap_tabs">	
				     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item " aria-controls="tab_item-0" role="tab"><span>Search</span></li>
							  <div class="clearfix"></div>
						  </ul>				  	 
						  <div class="resp-tabs-container">
						  		<h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span>All Homes</h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
								 	<div class="facts">
									  	<div class="login">
										 <form action='<?php echo base_url('index.php/pages/article_search');?>' method='get'>
											<input type="text" name="search" value="Search article - post" 
											onfocus="this.value = '';" 
											onblur="if (this.value == '') {this.value = 'Search article - post';}">		
									 		<input type="submit" value="">
											</form>
									 	</div>        
							        </div>
						  		</div>
							    
					      </div>
					 </div>
					 <script src="<?php echo base_url('assets/template_public/js/easyResponsiveTabs.js'); ?>" type="text/javascript"></script>
				    	<script type="text/javascript">
						    $(document).ready(function () {
						        $('#horizontalTab').easyResponsiveTabs({
						            type: 'default', //Types: default, vertical, accordion           
						            width: 'auto', //auto or any width like 600px
						            fit: true   // 100% fit in a container
						        });
						    });
			  			 </script>	
				</div>
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>
					
	
		</div>
		<div class="clearfix"> </div>
		</div>	
</div>
<!--//-->	