
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <li><a href="<?php echo base_url('index.php/admin/profile');?>"></i> Profile</a></li>
            <li class="active">Profile</li>
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
                  <h3 class="box-title">Update Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Profile</label>
					 <?php
					
						if(count($user_profile->result_array())>0){
						foreach($user_profile->result_array() as $usr)
						{
				  
						
							
			
					
					  echo"<form action='".base_url('index.php/admin/profile_edit_proses')."' method='post'>
					   <input type='hidden'  name='id' value='".$usr['id_admin']."'>
					 <input type='hidden'  id='username0' name='username_awal' value='".$usr['username_admin']."'>
					 <input type='hidden'  name='email_awal' value='".$usr['email_admin']."'>
					  
                      <input type='email' name='email' class='form-control'  value='".$usr['email_admin']."' id='exampleInputEmail1' placeholder='Enter email' disabled>
                    </div>
                    <div class='form-group'>
                      <label for='exampleInputPassword1'>Username Admin</label>
                      <input type='text' name='unama' class='form-control' value='".$usr['username_admin']."' id='username' onkeyup='Function_username()' placeholder='username' >
					 <div id='cekusername'></div>                   
				   </div>
					
				
					
                     <div class='form-group'>
                      <label for='exampleInputPassword1'>Nama Lengkap Admin</label>
                      <input type='text' name='nama' class='form-control'  value='".$usr['nama_lengkap_admin']."' id='exampleInputPassword1' placeholder='nama lengkap'>
                    </div>
					
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Jenis Admin</label>
                    <select name='jenis' class='form-control'>
							<option>".$usr['jenis_admin']."</option>
							<option disabled>---</option>
							<option>Super Administrator</option>
							<option>Administrator</option></select> 
                    </div>
					<div class='form-group'>
                      <label for='exampleInputPassword1'>Status Admin</label>
                  <select name='status' class='form-control'>
							<option>".$usr['status_admin']."</option>
							<option disabled>---</option>
							<option>aktif</option>
							<option>tidak aktif</option></select> 
                    </div>
					
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' onclick=\"return confirm('Anda yakin ingin mengupdate data profile anda ?');\" class='btn btn-primary'>Update</button>
                  </div>
                </form>";
				?>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
			
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Ganti Password</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="box-body">
                    <div class="form-group">
                     
					 <?php
					
					
					  echo"<form action='".base_url('index.php/admin/profile_ganti_password')."' method='post'>
					  
					   
                      <label for='exampleInputPassword1'>Password Lama</label>
                      <input type='password' name='pass_lama' class='form-control' value='' id='exampleInputPassword1' placeholder='Password lama'>
                    </div>
					 <div class='form-group'>
					 <label for='exampleInputEmail1'>Password Baru</label>
					  <input type='hidden'  name='id' value='".$usr['id_admin']."'>
					  
                      <input type='password' name='pass' class='form-control' value='' id='password' onkeyup='Function_password()' placeholder='Password baru'>
                 <div id='valpassword'></div>
				</div>
                   
				
					
                     <div class='form-group'>
                      <label for='exampleInputPassword1'>Ulangi Password</label>
                      <input type='password' name='pass2' class='form-control' value='' id='password2' onkeyup='Function_password2()' placeholder='Password baru'>
                     <div id='valpassword2'></div>
					</div>
					
					
                   
                  </div><!-- /.box-body -->

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-primary'>Ganti Password</button>
                  </div>
                </form>";
				
				}
				}
				?>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
                
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		  
	  
      </div><!-- /.content-wrapper -->
      

<script type="text/javascript">





function Function_username() {

    var eml0 = document.getElementById("username0");
    var eml = document.getElementById("username");
    
	$.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/admin/useradmin_usernameedit?username0="+eml0.value+"&username="+eml.value,
                type: 'POST',
                dataType: "json",
                success: function(response){
					if (response.hasil=='berhasil'){
						$("#cekusername").html("");
					}
					else{
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