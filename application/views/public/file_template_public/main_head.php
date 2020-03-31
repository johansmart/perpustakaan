<?php
$this->load->model('m_banner');
$banner = $this->m_banner->banner();
if(count($banner)>0)
{
foreach($banner as $banner)
{
echo"
<div  >
<img src='".base_url('assets/images/banner/'.$banner->isi_banner.'')."' height=150 width=100%>	";
}
}
?>
	<div class=" container">
	<h3>
	</h3> 
	<!---->
	
	<div class="menu-right">
		 <ul class="menu">
			
		</ul>
	</div>
	
	<div class="clearfix"> </div>
		<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
      		
	</div>
</div>