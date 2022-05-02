<?php
$meta      = $this->meta_model->get_meta();


?>


<div class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow text-muted">
   <div class="row">
      <div class="col <?php if ($this->uri->segment(1) == "") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url(); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="fa-solid fa-house"></i></p>
            Home
         </a>
      </div>


      <div class="col <?php if ($this->uri->segment(1) == "rental-mobil") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url('rental-mobil'); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="fa-solid fa-bag-shopping"></i></p>
            Order
         </a>
      </div>




      <div class="col <?php if ($this->uri->segment(1) == "berita") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url('berita'); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="fa-solid fa-fire-flame-curved"></i></p>
            News
         </a>
      </div>

      <?php if ($this->session->userdata('email')) : ?>

         <div class="col <?php if ($this->uri->segment(1) == "myaccount") {
                              echo 'selected text-info';
                           } ?>">

            <a href="<?php echo base_url('myaccount') ?>" class="text-dark small font-weight-bold text-decoration-none">
               <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
               Akun
            </a>

         </div>

      <?php else : ?>

         <div class="col <?php if ($this->uri->segment(1) == "auth") {
                              echo 'selected text-info';
                           } ?>">

            <a href="<?php echo base_url('auth') ?>" class="text-dark small font-weight-bold text-decoration-none">
               <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
               Akun
            </a>

         </div>

      <?php endif; ?>
   </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/template/mobile/'); ?>js/slick.min.js"></script>
<script src="<?php echo base_url('assets/template/mobile/'); ?>js/main.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script>
   $(function() {
      var minDate = new Date();
      minDate.setDate(minDate.getDate() + 1);

      $('#id_tanggal').datetimepicker({
         locale: 'id',
         format: 'D MMMM YYYY',
         minDate: minDate
      });
   });
   $("#id_tanggal").keydown(false);
   // $('.form-control-chosen').chosen({});
   // $('#timepicker').timepicker();
</script>

<script>
   $(function() {
      $('#id_tanggal_bayar').datetimepicker({
         locale: 'id',
         format: 'D MMMM YYYY'
      });
   });
</script>

<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->


<!-- Gambar -->
<script>
   $('input[type="file"]').each(function() {
      // Refs
      var $file = $(this),
         $label = $file.next('label'),
         $labelText = $label.find('span'),
         labelDefault = $labelText.text();

      // When a new file is selected
      $file.on('change', function(event) {
         var fileName = $file.val().split('\\').pop(),
            tmppath = URL.createObjectURL(event.target.files[0]);
         //Check successfully selection
         if (fileName) {
            $label
               .addClass('file-ok')
               .css('background-image', 'url(' + tmppath + ')');
            $labelText.text(fileName);
         } else {
            $label.removeClass('file-ok');
            $labelText.text(labelDefault);
         }
      });

      // End loop of file input elements
   });
</script>




<script>
   // Example starter JavaScript for disabling form submissions if there are invalid fields
   (function() {
      'use strict';
      window.addEventListener('load', function() {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
               if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
               }
               form.classList.add('was-validated');
            }, false);
         });
      }, false);
   })();
</script>

</body>

</html>