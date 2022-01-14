<?php
$meta      = $this->meta_model->get_meta();
// $link      = $this->link_model->get_link();
// $page      = $this->page_model->get_page();

?>


<div class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow mt-5">
   <div class="row">
      <div class="col <?php if ($this->uri->segment(1) == "") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url('driver/dashboard'); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="ri-home-2-line"></i></p>
            Home
         </a>
      </div>


      <div class="col <?php if ($this->uri->segment(1) == "rental-mobil") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url('driver/topup'); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="ri-wallet-3-line"></i></p>
            Top Up
         </a>
      </div>




      <div class="col <?php if ($this->uri->segment(2) == "riwayat") {
                           echo 'selected text-info';
                        } ?>">
         <a href="<?php echo base_url('driver/transaksi/riwayat'); ?>" class="text-dark small font-weight-bold text-decoration-none">
            <p class="h4 m-0"><i class="ri-history-line"></i></p>
            Riwayat
         </a>
      </div>

      <?php if ($this->session->userdata('email')) : ?>

         <div class="col <?php if ($this->uri->segment(1) == "profile") {
                              echo 'selected text-info';
                           } ?>">

            <a href="<?php echo base_url('driver/profile') ?>" class="text-dark small font-weight-bold text-decoration-none">
               <p class="h4 m-0"><i class="ri-user-line"></i></p>
               Profile
            </a>

         </div>

      <?php else : ?>

         <div class="col <?php if ($this->uri->segment(1) == "auth") {
                              echo 'selected text-info';
                           } ?>">

            <a href="<?php echo base_url('auth') ?>" class="text-dark small font-weight-bold text-decoration-none">
               <p class="h4 m-0"><i class="ri-user-line"></i></p>
               Profile
            </a>

         </div>

      <?php endif; ?>
   </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/template/mobile/'); ?>js/slick.min.js"></script>
<script src="<?php echo base_url('assets/template/mobile/'); ?>js/main.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js"></script>





<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->






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