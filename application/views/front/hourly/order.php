<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>
<div class="container my-5">
    <div class="col-md-7 mx-auto">
        <div class="text-center">
            <?php echo $this->session->flashdata('message');
            unset($_SESSION['message']);
            ?>
        </div>
        <div class="card mb-3">
            <div class="card-header">Pesanan</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php echo $kota_name; ?> - <?php echo $mobil_name; ?> - <?php echo $paket_name; ?> <br>
                        <h3 class="font-weight-bold"> Rp <?php echo number_format($paket_price, 0, ",", "."); ?></h3>

                        <!-- <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" value="1" onchange="total()"> -->
                    </div>
                    <div class="col-md-4">
                        <span class="h3"> <i class="fas fa-check-circle text-success"></i> <?php echo number_format($order_point, 0, ",", "."); ?> </span> Point<br>

                        <?php if ($this->session->userdata('id')) : ?>
                        <?php else : ?>
                            <p>Silahkan Login</p>
                            <a class="btn btn-primary btn-block" href="#" data-toggle="modal" data-target="#loginModal"><i class="ti ti-lock"></i> Login</a>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php if ($this->session->userdata('id')) : ?>
        <div class="col-md-7 mx-auto">
            <div class="card">
                <div class="card-header">
                    Info Pelanggan
                </div>
                <div class="card-body">
                    <h3> Point Saya : <?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?></h3><br>
                    <button class="btn btn-success" onclick="myFunction()">Pakai</button>

                    <script>
                        function myFunction() {
                            document.getElementById("myText").value = "<?php echo $total_pointku->nominal_point; ?>";
                        }
                    </script>
                    <?php echo form_open('hourly/order',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <input type="hidden" name="mobil_name" value="<?php echo $mobil_name; ?>">
                    <input type="hidden" name="kota_id" value="<?php echo $kota_id; ?>">
                    <input type="hidden" name="kota_name" value="<?php echo $kota_name; ?>">
                    <input type="hidden" name="paket_name" value="<?php echo $paket_name; ?>">
                    <input type="hidden" name="start_price" value="<?php echo $paket_price; ?>">
                    <input type="hidden" name="ketentuan_desc" value="<?php echo $ketentuan_desc; ?>">

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Discount Point<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" id="myText" class="form-control" name="diskon_point" value="" readonly>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Lama Sewa<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" id="myText" class="form-control" name="lama_sewa" value="<?php echo $paket_name; ?>" readonly>
                            <div class="invalid-feedback">Pilih Lama Sewa.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Jumlah Mobil<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <select class="form-control" name="jumlah_mobil" value="" required>
                                <option value="">-- Jumlah Mobil --</option>
                                <option value='1'> 1 Mobil</option>
                                <option value='2'> 2 Mobil</option>
                                <option value='3'> 3 Mobil</option>
                                <option value='4'> 4 Mobil</option>
                            </select>
                            <div class="invalid-feedback">Pilih Jumlah Mobil.</div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Lengkap<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="passenger_name" placeholder="Nama Lengkap" value="<?php echo $user->name; ?>" required>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Email <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="passenger_email" placeholder="Email" value="<?php echo $user->email; ?>" required>
                            <div class="invalid-feedback">Email harus di isi.</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nomor Handphone <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="passenger_phone" placeholder="Nomor Handphone" value="<?php echo $user->user_phone; ?>" required>
                            <div class="invalid-feedback">Nomor Handphone harus di isi.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Alamat Penjemputan <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <textarea class="form-control" name="alamat_jemput" placeholder="Alamat penjemputan" required></textarea>
                            <div class="invalid-feedback">Silahkan masukan Alamat Penjemputan.</div>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tanggal Jemput <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="tanggal_jemput" class="form-control" value="<?php echo date('d/m/Y', strtotime($tanggal_sewa)); ?>" id="id_tanggal" readonly>
                            <div class="invalid-feedback">Tanggal Jemput harus di isi.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Jam Jemput <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="jam_jemput" class="form-control" value="<?php echo $jam_sewa; ?>" id="id_tanggal" readonly>
                            <div class="invalid-feedback">Jam Jemputharus di isi.</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Permintaan Khusus <span class="text-success">* Optional</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="permintaan_khusus" placeholder="Permintaan Khusus" value="">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Pembayaran<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <select class="form-control" name="pembayaran" value="" required>
                                <option value="">-- Pembayaran --</option>
                                <option value='Transfer'> Transfer</option>
                                <option value='Cash'> Cash Ke Driver</option>
                            </select>
                            <div class="invalid-feedback">Pilih Tipe Pembayaran</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label"> Syarat Ketentuan
                        </label>
                        <div class="col-lg-8">
                            <?php echo $ketentuan_desc; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">
                        </label>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-block">Order Sekarang</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    <?php else : ?>

    <?php endif; ?>


</div>

<script type="text/javascript">
    function total() {
        var hargaSewa = <?php echo $paket_price; ?> * parseInt(document.getElementById('harga_sewa').value);
        var number_string = hargaSewa.toString(),
            sisa = number_string.length % 3,
            jumlah_harga = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            jumlah_harga += separator + ribuan.join('.');
        }

        document.getElementById('total').value = jumlah_harga;
    }
</script>


<!-- <script>
    var bilangan = 23456789;

    var number_string = hargaSewa.toString(),
        sisa = number_string.length % 3,
        jumlah_harga = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? '.' : '';
        jumlah_harga += separator + ribuan.join('.');
    }

    document.write(jumlah_harga); 
</script> -->