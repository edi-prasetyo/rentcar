<?php
$user_id    = $this->session->userdata('id');
$user = $this->user_model->detail($user_id);
?>

<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>


<div class="col-md-12">

    <div class="list-wrapper">
        <div class="red-line"></div>
        <div class="list-item-wrapper">
            <div class="list-bullet bg-primary"><i class="ri-stop-fill"></i></div>
            <div class="list-item">
                <div class="list-text"><?php echo $origin; ?></div>
            </div>
        </div>

        <div class="list-item-wrapper">
            <div class="list-bullet bg-success"><i class="ri-map-pin-2-fill"></i></div>
            <div class="list-item">
                <div class="list-text"><?php echo $address; ?></div>
            </div>
        </div>
    </div>
</div>




<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-body text-center">
            <h3 class="font-weight-bold"> Rp. <?php echo number_format($total_price, 0, ",", "."); ?></h3>
            <span class="text-muted"><?php echo $jarak; ?> KM</span>
        </div>
    </div>
</div>

<?php echo form_open('counter/transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

<input type="hidden" name="product_id" value="1">
<input type="hidden" name="destination" value="<?php echo $address; ?>">
<input type="hidden" name="jarak" value="<?php echo $jarak; ?>">

<div class="col-md-12 pb-5 my-3">
    <div class="card">
        <div class="card-body">
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
                            <label>Email</label>
                            <input type="text" class="form-control" name="passenger_email" placeholder="Email Penumpang">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Lanjutkan</button>

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