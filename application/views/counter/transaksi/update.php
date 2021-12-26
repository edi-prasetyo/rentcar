<?php echo form_open('counter/transaksi/update/' . $transaksi->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
<div class="row">


    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Paket</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Tujuan Pengiriman :</legend>

                            <div class="row">
                                <!-- Tujuan Pengiriman -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control select2bs4" id='sel_provinsi' name="provinsi_id" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            <?php
                                            foreach ($provinsi as $provinsi) {
                                                echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Provinsi.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select class="form-control select2bs4" id='sel_kota' name="kota_id" required>
                                            <option value="">-- Pilih Kota --</option>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Kota.</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Barang :</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kategori Barang</label>
                                        <select class="custom-select" name="category_id" required>
                                            <?php foreach ($category as $category) : ?>
                                                <option value="<?php echo $category->id; ?>" <?php if ($transaksi->category_id == $category->id) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $category->category_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Kategori Barang.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paket</label>
                                        <select class="custom-select" name="product_id" required>
                                            <option value="">-- Pilih Paket --</option>
                                            <?php foreach ($product as $product) : ?>
                                                <option value="<?php echo $product->id; ?>" <?php if ($transaksi->product_id == $product->id) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $product->product_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Jenis Paket.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama barang</label>
                                        <input type="text" class="form-control" name="nama_barang" value="<?php echo $transaksi->nama_barang; ?>" required>
                                        <div class="invalid-feedback">Silahkan Masukan Nama Barang.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat *Kg</label>
                                        <input type="number" class="form-control" name="berat" value="<?php echo $transaksi->berat; ?>" required>
                                        <div class="invalid-feedback">Silahkan Masukan Berat Barang.</div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah koli</label>
                                        <input type="number" class="form-control" name="koli" value="<?php echo $transaksi->koli; ?>" required>
                                        <div class="invalid-feedback">Silahkan Masukan Berapa koli paket.</div>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Berat Volume
                                    </a>
                                    <div class="collapse" id="collapseExample">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Panjang *cm</label>
                                                        <input type="number" class="form-control" name="panjang" value="<?php echo $transaksi->panjang; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Lebar *cm</label>
                                                        <input type="number" class="form-control" name="lebar" value="<?php echo $transaksi->lebar; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>tinggi *cm</label>
                                                        <input type="number" class="form-control" name="tinggi" value="<?php echo $transaksi->tinggi; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" id="inputku" name="harga" value="<?php echo $transaksi->harga; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                                        <!-- <input type="text" class="form-control" id="rupiah" name="harga" placeholder="Rp. .." required> -->
                                        <div class="invalid-feedback">Silahkan Masukan Harga Paket.</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Asuransi</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline mr-5">
                                                <input type="radio" name="asuransi" value="0" <?php if ($transaksi->asuransi == 0) {
                                                                                                    echo "checked";
                                                                                                } ?> id="radioSuccess1" required>
                                                <label for="radioSuccess1"> Tidak
                                                </label>
                                                <div class="invalid-feedback">Silahkan Pilih Asuransi.</div>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="asuransi" value="1" id="radioSuccess2">
                                                <label for="radioSuccess2"> Ya
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="hit-a"></div>
                                    <div class="hit-b" style="display: none">

                                        <div class="form-group">
                                            <label>Nilai Barang</label>
                                            <input type="text" class="form-control" id="inputku" name="nilai_barang" value="<?php echo $transaksi->nilai_barang; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                        </div>

                                        <div class="form-group">
                                            <label>Nilai Asuransi * 0,25% dari nilai barang</label>
                                            <input type="text" class="form-control" id="inputku" name="nilai_asuransi" value="<?php echo $transaksi->nilai_asuransi; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            <!-- <input type="text" class="form-control" id="rupiah" name="asuransi" placeholder="Rp. .." required> -->
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>


                    <!-- Data Pengirim dan Penerima -->

                    <div class="col-md-6">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Pengirim:</legend>

                            <div class="form-group">
                                <label>Nama Pengirim</label>
                                <input type="text" class="form-control" name="nama_pengirim" value="<?php echo $transaksi->nama_pengirim; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                            </div>
                            <div class="form-group">
                                <label>No. Telpon Pengirim</label>
                                <input type="number" class="form-control" name="telp_pengirim" value="<?php echo $transaksi->telp_pengirim; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Nomor HP Pengirim.</div>
                            </div>
                            <div class="form-group">
                                <label>Email Pengirim <span class="text-success">* Boleh di kosongkan</span></label>
                                <input type="text" class="form-control" name="email_pengirim" value="<?php echo $transaksi->email_pengirim; ?>">
                            </div>

                            <div class="form-group">
                                <label>Alamat Pengirim</label>
                                <textarea class="form-control" rows="3" name="alamat_pengirim"><?php echo $transaksi->alamat_pengirim; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Alamat Pengiriman.</div>
                            </div>

                            <div class="form-group">
                                <label>Kode Pos Pengirim <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="kodepos_pengirim" value="<?php echo $transaksi->kodepos_pengirim; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Kode Pos.</div>
                            </div>


                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Penerima:</legend>
                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" class="form-control" name="nama_penerima" value="<?php echo $transaksi->nama_penerima; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan nama penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>No. Telpon Penerima</label>
                                <input type="number" class="form-control" name="telp_penerima" value="<?php echo $transaksi->telp_penerima; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Nomor HP Penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>Email Penerima <span class="text-success">* Boleh di kosongkan</span></label>
                                <input type="text" class="form-control" name="email_penerima" value="<?php echo $transaksi->email_penerima; ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat Penerima</label>
                                <textarea class="form-control" rows="3" name="alamat_penerima" required><?php echo $transaksi->alamat_penerima; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Alamat Penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>Kode Pos Penerima <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="kodepos_penerima" value="<?php echo $transaksi->kodepos_penerima; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan KOde Pos Penerima.</div>
                            </div>
                        </fieldset>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Update Resi</button>
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