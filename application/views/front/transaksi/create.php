<?php
$user_id    = $this->session->userdata('id');
$user = $this->user_model->detail($user_id);
?>



<div class="container my-5">

    <div class="col-md-12">
        <div class="list-bullet"><i class="fas fa-stop"></i> <?php echo $origin; ?></div>
        <div class="list-bullet"><i class="fa fa-map-marker-alt"></i> <?php echo $address; ?></div>
    </div>


    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="font-weight-bold"> Rp. <?php echo number_format($total_price, 0, ",", "."); ?></h3>
                <span class="text-muted"><?php echo $jarak; ?> KM</span>
            </div>
        </div>
    </div>

    <?php echo form_open('transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

    <input type="hidden" name="product_id" value="1">


    <div class="col-md-12 pb-5 my-3">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->userdata('id')) : ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Penumpang</label>
                                    <input type="text" class="form-control" name="passenger_name" value="<?php echo $user->name; ?>" required>
                                    <div class="invalid-feedback">Silahkan Masukan Nama Penumpang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control" name="passenger_phone" value="<?php echo $user->user_phone; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="passenger_email" value="<?php echo $user->email; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Permintaan Khusus</label>
                                    <input type="text" class="form-control" name="permintaan_khusus" placeholder="Permintaan Khusus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Lanjutkan</button>
                <?php else : ?>
                    <a class="btn btn-primary btn-block my-2" href="#" data-toggle="modal" data-target="#loginModal"><i class="ti ti-lock"></i> Login Untuk melanjutkan</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<?php echo form_close(); ?>





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