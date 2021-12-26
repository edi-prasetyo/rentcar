<!-- Timelime example  -->
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <div>
                <i class="fas fa-stop-circle bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> </span>
                    <h3 class="timeline-header no-border"><?php echo $origin; ?></h3>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-map-marker-alt bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> </span>
                    <h3 class="timeline-header no-border"><?php echo $address; ?></h3>
                </div>
            </div>
            <!-- END timeline item -->
        </div>
    </div>
</div>



<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-body text-center">
            <h3 class="font-weight-bold"> Rp. <?php echo number_format($total_price, 0, ",", "."); ?></h3>
            <span class="text-muted"><?php echo $jarak; ?> KM</span>
        </div>
    </div>
</div>

<?php echo form_open('counter/transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Order</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Penumpang</label>
                                    <input type="text" class="form-control" name="passenger_name" placeholder="Nama Penumpang" required>
                                    <div class="invalid-feedback">Silahkan Masukan Nama Penumpang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control" name="passenger_phone" placeholder="Nomor HP Penumpang">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control" name="passenger_email" placeholder="Email Penumpang">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Lanjutkan</button>
                </div>
            </div>
        </div>

    </div>

</div>




<?php echo form_close(); ?>


<!-- Script -->
<script src="<?php echo base_url(); ?>assets/template/admin/plugins/jquery/jquery.min.js"></script>

<script type='text/javascript'>
    // baseURL variable
    var baseURL = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        // Provinsi change
        $('#sel_provinsi').change(function() {
            var provinsi = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url() ?>admin/wilayah/getKota',
                method: 'post',
                data: {
                    <?= $this->security->get_csrf_token_name(); ?>: "<?= $this->security->get_csrf_hash(); ?>",
                    provinsi: provinsi
                },
                dataType: 'json',
                success: function(response) {

                    // Remove options 
                    $('#sel_kecamatan').find('option').not(':first').remove();
                    $('#sel_kota').find('option').not(':first').remove();

                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_kota').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                    });
                }
            });
        });

        // Kota change
        $('#sel_kota').change(function() {
            var kota = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url() ?>admin/wilayah/getKecamatan',
                method: 'post',
                data: {
                    kota: kota
                },
                dataType: 'json',
                success: function(response) {

                    // Remove options
                    $('#sel_kecamatan').find('option').not(':first').remove();

                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_kecamatan').append('<option value="' + data['id'] + '">' + data['kecamatan_name'] + '</option>');
                    });
                }
            });
        });

    });
</script>



<script type="text/javascript">
    function tandaPemisahTitik(b) {
        var _minus = false;
        if (b < 0) _minus = true;
        b = b.toString();
        b = b.replace(".", "");
        b = b.replace("-", "");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
                c = b.substr(i - 1, 1) + "." + c;
            } else {
                c = b.substr(i - 1, 1) + c;
            }
        }
        if (_minus) c = "-" + c;
        return c;
    }

    function numbersonly(ini, e) {
        if (e.keyCode >= 49) {
            if (e.keyCode <= 57) {
                a = ini.value.toString().replace(".", "");
                b = a.replace(/[^\d]/g, "");
                b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
                ini.value = tandaPemisahTitik(b);
                return false;
            } else if (e.keyCode <= 105) {
                if (e.keyCode >= 96) {
                    //e.keycode = e.keycode - 47;
                    a = ini.value.toString().replace(".", "");
                    b = a.replace(/[^\d]/g, "");
                    b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                    ini.value = tandaPemisahTitik(b);
                    //alert(e.keycode);
                    return false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else if (e.keyCode == 48) {
            a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
            b = a.replace(/[^\d]/g, "");
            if (parseFloat(b) != 0) {
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        } else if (e.keyCode == 95) {
            a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
            b = a.replace(/[^\d]/g, "");
            if (parseFloat(b) != 0) {
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        } else if (e.keyCode == 8 || e.keycode == 46) {
            a = ini.value.replace(".", "");
            b = a.replace(/[^\d]/g, "");
            b = b.substr(0, b.length - 1);
            if (tandaPemisahTitik(b) != "") {
                ini.value = tandaPemisahTitik(b);
            } else {
                ini.value = "";
            }

            return false;
        } else if (e.keyCode == 9) {
            return true;
        } else if (e.keyCode == 17) {
            return true;
        } else {
            //alert (e.keyCode);
            return false;
        }

    }
</script>



<script>
    $(document).ready(function() {
        $('input[name=asuransi]:radio').change(function(e) {
            let value = e.target.value.trim()

            $('[class^="hit"]').css('display', 'none');

            switch (value) {
                case '0':
                    $('.hit-a').show()
                    break;
                case '1':
                    $('.hit-b').show()
                    break;
                default:
                    break;
            }
        })
    })
</script>