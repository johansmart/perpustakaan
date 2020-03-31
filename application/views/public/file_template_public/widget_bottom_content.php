
		<?php
			$this->load->model('m_widget');
			$widget_bottom_content= $this->m_widget->widget_bottom_content();
			if(count($widget_bottom_content)>0)
				{
				?>
				
				<div class="about">	
					<div class="about-head">
						<div class="container">
					
					<?php
					foreach($widget_bottom_content as $widget_bottom_content)
					{	
						echo"<div class='blog-list'>
								<h4>".$widget_bottom_content->nama_widget."</h4>
								<p>
								".$widget_bottom_content->isi_widget."
								</p>
								
								<div class='clearfix'> </div>
							 </div>";
							
						
					}
					?>
						</div>
					</div>
					<!---->
				</div>
				<?php
				}
		?>