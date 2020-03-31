
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url("index.php/admin/"); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>menu</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>MENU</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
			
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
		 
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			
			
				
		
			<li class="dropdown notifications-menu">
			
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="glyphicon glyphicon-calendar"></i>
				 <?php  $today=date('Y-m-d');
				 echo"$today";
				 ?>
                  <span class="label label-info">
				
				  </span>
                </a>
              
				
				 
				 
              <!-- Messages: style can be found in dropdown.less-->
				
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="glyphicon glyphicon-user"></i>
                  <span class="hidden-xs"><b >
				  <?php echo"".$this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-user').""; ?>
				  
				  </b></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  
                  <!-- Menu Body -->
                  <li class="user-body" style="background:#d3e9f6;">
                   <center><p><font size=5> <?php echo $this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-jenis'); ?></font>
                    </p></center>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer" style="background:#61b0dd;">
                    <div class="pull-left">
                      <a href="<?php echo base_url('index.php/admin/profile');?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('index.php/cpanel_login/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
			  
			    <li class="dropdown user user-menu">
                <a href="<?php echo"".base_url('index.php/perpus/absen')." ";?>" target='_blank' >
                 <i class="glyphicon glyphicon-globe"></i>
                  <span class="hidden-xs"><b >
				  Kunjungan
				  
				  </b></span>
                </a>
			  </li>
              <!-- Control Sidebar Toggle Button -->
            
            </ul>
          </div>
        </nav>
      </header>