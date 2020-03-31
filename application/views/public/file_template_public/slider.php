<div class=" header-right">
		<div class=" banner">
			 <div class="slider">
			    <div class="callbacks_container">
			      <ul class="rslides" id="slider">		       
					<?php
					$this->load->model('m_slider');
					$list_slider = $this->m_slider->list_slider();
						if(count($list_slider)>0)
						{
							foreach($list_slider as $list_slider)
							{
							echo"<li>
									 <div>
									 <img src='".base_url('assets/images/slider/'.$list_slider->image_slider.'')."' class='img-responsive zoom-img' alt=''/>
							
										<div class='caption'>
											<h3>".$list_slider->nama_slider."</h3>
											<p>".$list_slider->ket_slider."</p>
										</div>
									</div>
								 </li>";
							}
						}
					?>
					
					 
					
			      </ul>
			  </div>
			</div>
		</div>
	</div>
	 