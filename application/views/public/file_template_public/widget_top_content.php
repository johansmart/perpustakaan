
		<?php
			$this->load->model('m_widget');
			$widget_top_content= $this->m_widget->widget_top_content();
			if(count($widget_top_content)>0)
				{
				?>
				
				<div class="about">	
					<div class="about-head">
						<div class="container">
					
					<?php
					foreach($widget_top_content as $widget_top_content)
					{	
						echo"<div class='blog-list'>
								<h4>".$widget_top_content->nama_widget."</h4>
								<p>
								".$widget_top_content->isi_widget."
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
		