<?php
$meta      = $this->meta_model->get_meta();


?>




<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/template/mobile/'); ?>js/slick.min.js"></script>
<script src="<?php echo base_url('assets/template/mobile/'); ?>js/main.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/mobile/js/chosen.jquery.min.js"></script>

<script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script>
   // Chosen touch support.
   if ($('.chosen-container').length > 0) {
      $('.chosen-container').on('touchstart', function(e) {
         e.stopPropagation();
         e.preventDefault();
         // Trigger the mousedown event.
         $(this).trigger('mousedown');
      });
   }
</script>

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