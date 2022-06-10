<?php
$meta      = $this->meta_model->get_meta();
?>

<!-- FOOTER -->
<footer class="footer">
    <div class="container bottom_border">
        <div class="row">
            <div class="col-md-4">
                <h5 class="headin5_amrc col_white_amrc pt2">Customer Service</h5>
                <div class="row">
                    <div class="col-md-4 col-6"><img class="img-fluid" src="<?php echo base_url('assets/img/galery/customer.png'); ?>" /></div>
                    <div class="col-md-7 col-6">
                        <div style="color:#fff;">
                            <i class="fa fa-phone"></i> <?php echo $meta->telepon; ?><br>
                            <i class="fab fa-whatsapp"></i> <?php echo $meta->whatsapp; ?><br>
                            <i class="fa fa-envelope"></i> <?php echo $meta->email; ?>
                        </div>

                    </div>
                    <ul class="social_footer_ul">
                        <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.youtube.com"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <h5 class="headin5_amrc col_white_amrc pt2">Kota</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul_amrc">
                    <li><a href="<?php echo base_url(); ?>">Rental Mobil DKI Jakarta</a></li>
                    <li><a href="<?php echo base_url(); ?>">Rental Mobil Tangerang</a></li>
                    <li><a href="<?php echo base_url(); ?>">Rental Mobil Bogor</a></li>
                    <li><a href="<?php echo base_url(); ?>">Rental Mobil Depok</a></li>
                    <li><a href="<?php echo base_url(); ?>">Rental Mobil Bekasi</a></li>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>

            <div class="col-md-2 col-6">
                <h5 class="headin5_amrc col_white_amrc pt2">Mobil Populer</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul_amrc">
                    <li><a href="<?php echo base_url(); ?>">Sewa mobil Avanza</a></li>
                    <li><a href="<?php echo base_url(); ?>">Sewa mobil Innova</a></li>
                    <li><a href="<?php echo base_url(); ?>">Sewa mobil Xpander</a></li>
                    <li><a href="<?php echo base_url(); ?>">Sewa mobil Hiace</a></li>
                    <li><a href="<?php echo base_url(); ?>">Sewa mobil Ertiga</a></li>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>

            <div class="col-md-2">
                <h5 class="headin5_amrc col_white_amrc pt2">Perusahaan</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul_amrc">
                    <li><a href="<?php echo base_url(); ?>">Tentang Kami</a></li>
                    <li><a href="<?php echo base_url(); ?>">Hubungi Kami</a></li>
                    <li><a href="<?php echo base_url(); ?>">Syarat dan ketentuan</a></li>
                    <li><a href="<?php echo base_url(); ?>">Kebijakan Privasi</a></li>
                    <li><a href="<?php echo base_url(); ?>">FAQ</a></li>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>





        </div>
    </div>

    <div class="container">
        <p style="color:ddd;text-align:center;" class="pt-5"><?php echo $meta->description; ?></p>
    </div>

</footer>
<section class="disclaimer bg-light border">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 ">
                <small>
                </small>
            </div>
        </div>
    </div>
</section>
<section class="copyright">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 pt-3">
                <p class="text-muted">Copyright © 2021 <?php echo $meta->title; ?> - <?php echo $meta->tagline; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Load javascript Jquery -->
<!-- <script src="<?php echo base_url() ?>assets/template/front/js/jquery.js" type="text/javascript"></script> -->
<!-- <script src="<?php echo base_url() ?>assets/template/front/js/jquery-1.11.3.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/assets/js/vendor/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>







<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->

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
    $('.form-control-chosen').chosen({});
    $('#timepicker').timepicker();
</script>



<script>
    $(document).on('click', '.number-spinner button', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
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