<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('m_admin');
	 	if($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id') == ""){
	  		redirect(base_url('index.php/pages'),"refresh");
		}
 	}
	public function index()	{
		$this->dashboard();
	}
	public function dashboard()	{
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/home');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	}
	
	public function user_admin()	{
		$this->load->library('pagination');
		$config['base_url']        = site_url('admin/user_admin');
		$config['total_rows']      = $this->m_admin->jumlah_admin();
		$config['per_page']        = $per_page = $this->db->query('select paging from set_paging')->row()->paging;
		$config['uri_segment']     = 3;
		$config['full_tag_open']   = "<ul class='pagination'>";
		$config['full_tag_close']  ="</ul>";
		$config['num_tag_open']    = '<li>';
		$config['num_tag_close']   = '</li>';
		$config['cur_tag_open']    = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close']   = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open']   = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open']   = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open']  = "<li>";
		$config['first_tagl_close']= "</li>";
		$config['last_tag_open']   = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['paging']            = $this->pagination->create_links();
		$page 			   		   = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
	    $data['admin'] 	   		   = $this->m_admin->admin($per_page,$page);
		$dari		 	    	   = ($this->pagination->cur_page - 1) * $per_page + 1 ;
		$kee		        	   = $dari+$per_page-1;
		$totaaal	        	   = $this->pagination->total_rows;
		if(($kee > $totaaal) || ($kee < 1)){
			$kee = $totaaal;
		} 
		$data['dari']     		   = $dari;
		$data['keee']   		   = $kee;
		$data['total'] 		       = $totaaal;
		$data['jumlah_admin'] = $this->m_admin->jumlah_admin();
		
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/useradmin/admin',$data);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	
	}
		
	public function ubahpaging(){
		$url=$this->input->get('url');
		$this->m_admin->ubahpaging($url);
	}
	//profile
	public function profile(){
		$this->load->model('m_admin');
		$query['user_profile'] = $this->m_admin->user_profile($this->session->userdata('mzgs-perpus-skl-1-2k15-sandi-I-id'));
				
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/profile',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	}
	public function profile_edit_proses(){
		$post_id=$this->input->post('id');
		$post_username=$this->input->post('unama');
		$post_username_lama=$this->input->post('unama_awal');
		$post_nama=$this->input->post('nama');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');

		if($post_status=="" || $post_nama=="" || $post_username=="" )
		{
			echo "
				<script>
				alert('isikan semua data dengan lengkap');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		
		else 
		{
			
			$this->load->model('m_admin');
			$query = $this->m_admin->cekusername_edit($this->input->post('unama'),$this->input->post('unama_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Username telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_admin');
				$query = $this->m_admin->profile_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/admin/profile"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			
		}
		
		
	}
	public function profile_ganti_password(){
	
		$post_id=$this->input->post('id');
		$post_pass_lama=$this->input->post('pass_lama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');

		if($post_pass=="" || $post_pass2=="" || $post_pass_lama=="" )
		{
			echo "
				<script>
				alert('isikan password');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else if($post_pass!=$post_pass2)
		{
			echo "
				<script>
				alert('Password baru tidak sama');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else 
		{
			$this->load->model('m_admin');
			$query = $this->m_admin->cekpassword($post_id, $post_pass_lama);
			if($query->num_rows > 0)
			{
				
				$this->load->model('m_admin');
				$query = $this->m_admin->gantipassword($this->input->post('username'), $this->input->post('passbaru'));
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/admin/profile"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			else
			{
				echo "
				<script>
				alert('password lama salah');
				window.location.href='javascript:history.back(1);'
				</script>";
			}
			
		}
		
		
	}
	//end profile
	public function useradmin_add(){
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/useradmin/adminadd');
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	}
	public function useradmin_add_proses(){
		$post_email=$this->input->post('email');
		$post_username=$this->input->post('unama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');
		$post_nama=$this->input->post('nama');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');

		if($post_email=="" || $post_username=="" || $post_pass=="" || $post_pass2=="" || $post_nama=="")
		{
			echo "
				<script>
				alert('isikan semua data dengan lengkap');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else if($post_pass!=$post_pass2)
		{
			echo "
				<script>
				alert('Password baru tidak sama');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else 
		{
			
			$this->load->model('m_admin');
			$query = $this->m_admin->cekusername($this->input->post('unama'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Username telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_admin');
				$query = $this->m_admin->useradmin_add();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/admin/user_admin"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			
		}
		
	}
	
	public function useradmin_edit(){
			$this->load->model('m_admin');
			$query['user'] = $this->m_admin->useradmin_edit($this->input->get('id'));
			
		$this->load->view('template_admin/include/config');
		$this->load->view('template_admin/include/head');
		$this->load->view('template_admin/include/header');
		$this->load->view('template_admin/include/sidebar');
		$this->load->view('admin/useradmin/adminedit',$query);
		$this->load->view('template_admin/include/footer');
		$this->load->view('template_admin/include/tabpanes');
	}
	public function useradmin_edit_proses(){
		$post_id=$this->input->post('id');
		$post_username=$this->input->post('unama');
		$post_username_lama=$this->input->post('unama_awal');
		$post_nama=$this->input->post('nama');
		$post_pass=$this->input->post('pass');
		$post_pass2=$this->input->post('pass2');
		$post_status=$this->input->post('status');
		$post_jenis=$this->input->post('jenis');

		if($post_status=="" || $post_nama=="" || $post_username=="" || $post_pass2=="" || $post_pass=="")
		{
			echo "
				<script>
				alert('isikan semua data dengan lengkap');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else if($post_pass!=$post_pass2)
		{
			echo "
				<script>
				alert('Password baru tidak sama');
				window.location.href='javascript:history.back(1);'
				</script>";
		}
		else 
		{
			
			$this->load->model('m_admin');
			$query = $this->m_admin->cekusername_edit($this->input->post('unama'),$this->input->post('unama_awal'));
			if($query->num_rows > 0)
			{
				echo "
					<script>
					alert('Username telah digunakan');
					window.location.href='javascript:history.back(1);'
					</script>";
			}
			else
			{
				$this->load->model('m_admin');
				$query = $this->m_admin->useradmin_edit_proses();
				
				if($query)
				{
					?>
					<script>
					alert('sukses');
					window.location.href='<?php  echo base_url("index.php/admin/user_admin"); ?>'
					</script><?php 
					
				}
				else
				{
					echo "
					<script>
					alert('Gagal');
					window.location.href='javascript:history.back(1);'
					</script>";
				}
				//$query->free_result();
			}
			
		}
		
		
	}
	public function useradmin_delete(){
		$this->load->model('m_admin');
		$query = $this->m_admin->useradmin_delete($this->input->get('id'));
			
		$this->user_admin();
		
	}
	
	//ajax
		
	public function useradmin_email(){
		
		if($this->input->get('email')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekemail' class='alert alert-danger' role='alert'>isikan email dengan benar</div>";
			echo json_encode($data);
		}
		else{
			$this->load->library('form_validation');
			if (!filter_var($this->input->get('email'), FILTER_VALIDATE_EMAIL))
			{	
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekemail' class='alert alert-danger' role='alert'>Format email salah. isikan email dengan benar.</div>";
			echo json_encode($data);
			}
			else 
			{
		
				$this->load->model('m_admin');
				$datai = $this->m_admin->cekuseradmin_email($this->input->get('email'));
			
				if($datai->num_rows > 0)
				{
					$data["hasil"] = "gagal";
					$data["ket"] = "<div id='cekemail' class='alert alert-danger' role='alert'>email sudah digunakan</div>";
				}
				else
				{
					$data["hasil"] = "berhasil";
					$data["ket"] = "<div id='cekemail' class='alert alert-danger' role='alert'></div>";
				}
				echo json_encode($data);
			}
		
		}
		
	}
	
	public function useradmin_username(){
		
		if($this->input->get('username')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'>isikan username dengan benar</div>";
			echo json_encode($data);
		}
		else
		{
			
		
				$this->load->model('m_admin');
				$datai = $this->m_admin->cekuseradmin_username($this->input->get('username'));
			
				if($datai->num_rows > 0)
				{
					$data["hasil"] = "gagal";
					$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'>username sudah digunakan</div>";
				}
				else
				{
					$data["hasil"] = "berhasil";
					$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'></div>";
				}
				echo json_encode($data);
			
		
		}
		
	}
	

	//cek password
	public function cek_password()
	{
		if($this->input->get('password')=="")
		{
			$data["hasil"] = "cek";
			$data["ket"] = "<br><div id='valpassword'><p><span class='alert alert-danger'>isikan password</span><p></div>";
			echo json_encode($data);
		}
		else
		{		
			$jumlahchar_password=strlen($this->input->get('password'));
			if($jumlahchar_password<=7) 
			{
				$data["hasil"] = "password";
				$data["ket"] = "<br><div id='valpassword'><p><span class='alert alert-danger'> gunakan password lebih dari  = 8 (min 8 char) karakter</span><p></div>";
				echo json_encode($data);
			}
			else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $this->input->get('password'))) 
			{
	
				$data["hasil"] = "password";
				$data["ket"] = "<br><div id='valpassword'><p><span class='alert alert-danger'>password harus ada angka dan huruf</span><p></div>";
				echo json_encode($data);
			}
			
			else {
				$data["hasil"] = "password";
				$data["ket"] = "<div id='valpassword'></div>";
				echo json_encode($data);
			}
			
		}
	}
	public function cek_password2()
	{
		if($this->input->get('password')=="")
		{
			$data["hasil"] = "password1";
			$data["ket"] = "<br><div id='valpassword'><p><span class='alert alert-danger'>isikan password pertama dulu</span><p></div>";
			echo json_encode($data);
		}
		else if($this->input->get('password2')=="")
		{
			$data["hasil"] = "cek";
			$data["ket"] = "<br><div id='valpassword2'><p><span class='alert alert-danger'>isikan ulang password </span><p></div>";
			echo json_encode($data);
		}
		
		else
		{	
			$jumlahchar_password2=strlen($this->input->get('password2'));
			if($jumlahchar_password2<=7) 
			{
				$data["hasil"] = "password2";
				$data["ket"] = "<br><div id='valpassword2'><p><span class='alert alert-danger'> gunakan password lebih dari = 8 (min 8 char) karakter</span><p></div>";
				echo json_encode($data);
			}
			else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $this->input->get('password2'))) 
			{
	
				$data["hasil"] = "password2";
				$data["ket"] = "<br><div id='valpassword2'><p><span class='alert alert-danger'>password harus ada angka dan huruf</span><p></div>";
				echo json_encode($data);
			}
			else if ($this->input->get('password2')!=$this->input->get('password'))
			{
				$data["hasil"] = "password2";
				$data["ket"] = "<br><div id='valpassword2'><p><span class='alert alert-danger'> password tidak sama</span><p></div>";
				echo json_encode($data);
			}
			else {
				$data["hasil"] = "password2";
				$data["ket"] = "<div id='valpassword2'></div>";
				echo json_encode($data);
			}
			
		}
	}
	//cek password
	

	public function useradmin_usernameedit(){
		
		if($this->input->get('username')==""){
			$data["hasil"] = "cek";
			$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'>isikan username dengan benar</div>";
			echo json_encode($data);
		}
		else
		{
			
		
				$this->load->model('m_admin');
				$datai = $this->m_admin->cekuseradmin_usernameedit($this->input->get('username0'),$this->input->get('username'));
			
				if($datai->num_rows > 0)
				{
					$data["hasil"] = "gagal";
					$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'>username sudah digunakan</div>";
				}
				else
				{
					$data["hasil"] = "berhasil";
					$data["ket"] = "<div id='cekusername' class='alert alert-danger' role='alert'></div>";
				}
				echo json_encode($data);
			
		
		}
		
	}
	

	
}

?>