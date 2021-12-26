<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group clearfix">
                        <div class="icheck-success d-inline mr-5">
                            <input type="radio" name="asuransi" value="0" id="radioSuccess1">
                            <label for="radioSuccess1"> Penambahan Saldo
                            </label>
                            <div class="invalid-feedback">Silahkan Pilih Asuransi.</div>
                        </div>
                        <div class="icheck-success d-inline">
                            <input type="radio" name="asuransi" value="1" id="radioSuccess2">
                            <label for="radioSuccess2"> Pengurangan saldo
                            </label>

                        </div>
                    </div>
                </div>
                <div class="hit-a" style="display: none">
                    <?php echo form_open('admin/counter/tambah_saldo/' . $counter->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <div class="form-group">
                        <label> Penambahan Saldo</label>
                        <input type="text" class="form-control" id="inputku" name="pemasukan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                        <div class="invalid-feedback">Silahkan Masukan Nominal Penambahan Saldo.</div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" required></textarea>
                        <div class="invalid-feedback">Silahkan Isi Keterangan.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Tambah Saldo</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="hit-b" style="display: none">
                    <?php echo form_open('admin/counter/potong_saldo/' . $counter->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

                    <div class="form-group">
                        <label> Pengurangan Saldo</label>
                        <input type="text" class="form-control" id="inputku" name="pengeluaran" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                        <div class="invalid-feedback">Silahkan Masukan Nominal Pengurangan Saldo.</div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" required></textarea>
                        <div class="invalid-feedback">Silahkan Isi Keterangan.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Potong Saldo</button>
                    <?php echo form_close(); ?>

                </div>
            </div>


        </div>
    </div>
</div>

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