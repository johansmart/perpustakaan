
      <!-- Control Sidebar -->      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->
 <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/temp/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/temp/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/temp/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('assets/temp/plugins/fastclick/fastclick.min.js'); ?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/temp/dist/js/app.min.js'); ?>" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/temp/dist/js/demo.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/temp/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
  </body>
</html>

            <script src="<?php echo base_url().'assets/datepicker/js/bootstrap-datepicker.js'; ?>"></script>
<link href="<?php echo base_url();?>assets/select2/select2.css" rel="stylesheet"/><!--instalasi style select2-->
		<script src="<?php echo base_url();?>assets/select2/select2.js"></script> <!--instalasi select2-->
			<!--inisialisasi select2-->
		<script>
			$(document).ready(function() { 
				$("select.select").select2(); 
        $('.select2').select2();
        $('.select2inventory').select2();
        function addInputNumberPrint() {
          $('form#multiple-print-book-barcode input[type="number"],form#multiple-print-book-barcode label').remove();
          let valueSelected = [$('form#multiple-print-book-barcode select').val()];
          $.each(valueSelected[0], function (index, value) {
            $('form#multiple-print-book-barcode').append(`
              <label for="buku`+ (index+1) +`">Jumlah Buku `+(index+1)+`</label>
                <input type="number" class="form-control" name="book_`+ (index+1) +`" id="buku`+ (index+1) +`" placeholder="" required>
              `);
          });
        }
        $('form#multiple-print-book-barcode select.select2inventory').change(function () {
          addInputNumberPrint();
        });

        function deleteValueSubmit(e,form) {
          e.preventDefault();
          form.submit();
          $('form#multiple-print-book-barcode select option:selected').remove();
          $('form#multiple-print-member-barcode select option:selected').remove();
        }
        $('form#multiple-print-book-barcode').submit(function (e) {
          deleteValueSubmit(e,this);
        });

        $('form#multiple-print-member-barcode').submit(function (e) {
          deleteValueSubmit(e,this);
        });
			});
		</script>
		
		
