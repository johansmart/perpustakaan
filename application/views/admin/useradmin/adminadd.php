

 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/admin');?>"></i> Admin</a></li>
            <li class="active">Tambah Admin</li>
          </ol>
        </section>
			
       
            
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tambah Admin</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email admin</label>
				
			
					  <form action='<?php echo base_url('index.php/admin/useradmin_add_proses');?>' method='post'>
					   
					  
                      <input type='email' name='email'  id='email' onkeyup='Function_email()' class='form-control' placeholder='Enter email'>
					  <div id='cekemail'></div>
                    </div>
                    <div class='form-group'>
                      <label for='exampleInputPassword1'>Username Admin</label>
                      <input type='text' name='unama' class='form-control'  id='username' onkeyup='Function_username()' placeholder='username'>
					  <div id='cekusername'></div>
				   </div>
					
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Password</label>
                      <input type='password' name='pass' id='password' onkeyup='Function_password()'  class='form-control'  placeholder='Password'>
						 <div id='valpassword'></div>
					</div>
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Password Lagi</label>
                      <input type='password' name='pass2' id='password2' onkeyup='Function_password2()' class='form-control' placeholder='Password'>
						 <div id='valpassword2'></div>
					</div>
					
                     <div class='form-group'>
                      <label for='exampleInputPassword1'>Nama Lengkap Admin</label>
                      <input type='text' name='nama' class='form-control'   id='exampleInputPassword1' placeholder='Nama lengkap'>
                    </div>
					
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Jenis Admin</label>
                    <select name='jenis' class='form-control'>
							<option>Super Administrator</option>
							<option>Administrator</option></select> 
                    </div>
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Status Admin</label>
                  <select name='status' class='form-control'>
							<option>aktif</option>
							<option>tidak aktif</option></select> 
                    </div>
					
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Submit</button>
                    <a href='<?php echo base_url('index.php/admin/user_admin');?>' class='btn btn-primary' title='batal atau kembali'><b>Batal</b></a>
                  </div>
                </form>
              </div><!-- /.box -->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      


<script type="text/javascript">


function Function_email() {

    var eml = document.getElementById("email");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/admin/useradmin_email?email="+eml.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#cekemail").html("");
					
					}
					else 
					{
					$("#cekemail").html(response.ket);
					$("#email").focus();
					}
                	 
                }
            });

			
			return false;
	}



function Function_username() {

    var eml = document.getElementById("username");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/admin/useradmin_username?username="+eml.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
						$("#cekusername").html("");
					
					}
					else 
					{
					$("#cekusername").html(response.ket);
					$("#username").focus();
					}
                	 
                }
            });

			
			return false;
	}
//val password
	function Function_password() {

    var ps = document.getElementById("password");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/admin/cek_password?password="+ps.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
					$("#valpassword").html(response.ket);
					}
					else 
					{
                	$("#password").focus();
					$("#valpassword").html(response.ket);
					}
                	 
                }
            });

			
			return false;
	}
	function Function_password2() {

    var ps = document.getElementById("password");
    var ps2 = document.getElementById("password2");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/admin/cek_password2?password="+ps.value+"&password2="+ps2.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil')
                    {
					$("#valpassword2").html(response.ket);
					}
					else if (response.hasil=='password1')
                    {
					$("#password").focus();
					$("#password2").val("");
					$("#valpassword2").html(response.ket);
					}
					else 
					{
					
                	$("#password2").focus();
					$("#valpassword2").html(response.ket);
					}
                	 
                }
            });

			
			return false;
	}

	//end val password
	
</script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
