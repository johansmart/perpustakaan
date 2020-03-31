		
		
		
		<link href="<?php echo base_url('assets/editor/editor.css');?>" type="text/css" rel="stylesheet"/>
		
		<script src="<?php echo base_url('assets/editor/editor.js');?>"></script>

		<title>LineControl | v1.1.0</title>
		<script type="text/javascript">
				$(document).ready( function() {
					
				 $("#editor").Editor();                    
				 
			});
		  </script>
		<script type="text/javascript">
			  $(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor_cp');
				//bootstrap WYSIHTML5 - text editor
				$(".textarea").Editor();
			  });
			</script>