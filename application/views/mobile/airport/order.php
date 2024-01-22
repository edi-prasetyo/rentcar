<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
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
                    <div class="col-md-7">
                        <?php echo $airport_name; ?> - <?php echo $kota_name; ?> <?php echo $mobil_name; ?> <br>
                        <h3 class="font-weight-bold"> Rp <?php echo number_format($paket_price, 0, ",", "."); ?></h3>
                        <!-- <input type="text" name="grand_total" id="total" size="7" value="" readonly> -->

                        <!-- <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" value="1" onchange="total()"> -->
                    </div>
                    <div class="col-md-5 text-right">
                        <span class="h3"> <i class="fas fa-check-circle text-success"></i> <?php echo number_format($order_point, 0, ",", "."); ?> </span> Point<br>

                        <?php if ($this->session->userdata('id')) : ?>
                        <?php else : ?>
                            <a class="btn btn-primary btn-block my-2" href="#" data-toggle="modal" data-target="#loginModal"><i class="ti ti-lock"></i> Login</a>
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
                    Buat Pesanan
                </div>

                <div class="card-body">


                    <div class="row mb-3">
                        <label class="col-lg-4">Point Saya </label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block" onclick="myFunction()">Gunakan Point</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function myFunction() {
                            document.getElementById("myText").value = "<?php echo $total_pointku->nominal_point; ?>";
                        }
                    </script>

                    <?php echo form_open('airport/order',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <input type="hidden" name="mobil_name" value="<?php echo $mobil_name; ?>">
                    <input type="hidden" name="airpot_name" value="<?php echo $airport_name; ?> - <?php echo $airport_name; ?>">
                    <input type="hidden" name="kota_name" value="<?php echo $kota_name; ?> - <?php echo $kota_name; ?>">


                    <input type="hidden" name="start_price" value="<?php echo $paket_price; ?>">
                    <input type="hidden" name="order_point" value="<?php echo $order_point; ?>">
                    <input type="hidden" name="ketentuan_desc" value="<?php echo $ketentuan_desc; ?>">
                    <input type="hidden" name="paket_desc" value="<?php echo $paket_desc; ?>">
                    <input type="hidden" name="jumlah_mobil" value="1">
                    <input type="hidden" name="pembayaran" value="Transfer">

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Discount Point<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="text" id="myText" class="form-control" name="diskon_point" value="0" readonly>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Kode Promo
                        </label>
                        <div class="col-lg-8">
                            <select class="form-control form-control-chosen" name="promo_amount">
                                <option value="0">-- Kode Promo --</option>
                                <?php foreach ($promo as $promo) : ?>
                                    <option value='<?php echo $promo->price; ?>'><?php echo $promo->name; ?> <span class="text-success"> Rp. <?php echo number_format($promo->price, 0, ",", "."); ?></span></option>
                                <?php endforeach; ?>
                            </select>
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
                            <?php $hp = $user->user_phone;
                            $hp0 = substr_replace($hp, '0', 0, 2);
                            ?>
                            <input type="text" class="form-control" name="passenger_phone" placeholder="Nomor Handphone" value="<?php echo $hp0; ?>" required>
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
                            <input type="text" name="jam_jemput" class="form-control" value="<?php echo $jam_jemput; ?>" id="id_tanggal" readonly>
                            <div class="invalid-feedback">Jam Jemput harus di isi.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Metode Pembayaran<span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <select class="form-control" name="pembayaran" required>
                                <option value="">-- Pembayaran --</option>
                                <?php foreach ($pembayaran as $pembayaran) : ?>
                                    <option value='<?php echo $pembayaran->name; ?>'> <?php echo $pembayaran->name; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback">Pilih Lama Sewa.</div>
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
                        <label class="col-lg-4 col-form-label"> Syarat Ketentuan
                        </label>
                        <div class="col-lg-8">
                            <div class="alert alert-success">
                                <?php echo $ketentuan_desc; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label"> Batas Wilayah
                        </label>
                        <div class="col-lg-8">
                            <?php echo $paket_desc; ?>
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

<script type="text/javascript">
    function total() {
        var vphp = <?php echo $paket_price; ?> * parseInt(document.getElementById('lama_sewa').value);

        var jumlah_harga = vphp;

        document.getElementById('total').value = jumlah_harga;
    }
</script>