  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo"".base_url('index.php/perpus')."";?>" class="navbar-brand"><b>Aplikasi</b>Perpustakaan</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li ><a href="<?php echo"".base_url('index.php/perpus')."";?>">Home <span class="sr-only">(current)</span></a></li>
                  <li ><a href="<?php echo"".base_url('index.php/perpus/absen')."";?>">Absensi <span class="sr-only">(current)</span></a></li>       
                  <li ><a href="<?php echo"".base_url('index.php/perpus/buku')."";?>">Buku <span class="sr-only">(current)</span></a></li>               
            </div><!-- /.navbar-collapse -->
          
          </div><!-- /.container-fluid -->
        </nav>
      </header>
	  
