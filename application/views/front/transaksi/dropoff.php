<?php
$user_id    = $this->session->userdata('id');
$user = $this->user_model->detail($user_id);
?>


<?php echo form_open('transaksi/dropoff',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

<input type="hidden" name="product_id" value="2">


<div class="countainer my-3 pb-5">
    <div class="col-md-4 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat Jemput</label>
                                    <textarea class="form-control" name="origin" placeholder="Alamat Jemput" required></textarea>
                                    <div class="invalid-feedback">Silahkan Masukan Alamat Tujuan</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat Tujuan</label>
                                    <textarea class="form-control" name="destination" placeholder="Alamat  Tujuan" required></textarea>
                                    <div class="invalid-feedback">Silahkan Masukan Alamat Tujuan</div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="total_price" placeholder="Harga" required>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Penumpang</label>
                                    <input type="text" class="form-control" name="passenger_name" placeholder="Nama Penumpang" required>
                                    <div class="invalid-feedback">Silahkan Masukan Nama Penumpang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP <small class="text-success"></small> </label>
                                    <input type="text" class="form-control" name="passenger_phone" placeholder="Nomor HP Penumpang" required>
                                    <div class="invalid-feedback">Silahkan Masukan Nomor Handphone</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <small class="text-success">(Boleh di kosongkan)</small></label>
                                    <input type="text" class="form-control" name="passenger_email" placeholder="Email Penumpang">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Kirim Permintaan</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>


<!-- Script -->
<script src="<?php echo base_url(); ?>assets/template/admin/plugins/jquery/jquery.min.js"></script>

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