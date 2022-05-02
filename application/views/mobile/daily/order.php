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



<div class="container my-3">
    <div class="col-md-7 mx-auto">
        <div class="text-center">
            <?php echo $this->session->flashdata('message');
            unset($_SESSION['message']);
            ?>
        </div>
        <div class="card mb-3 shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7 text-center">
                        <?php echo $kota_name; ?> - <?php echo $paket_name; ?> <br>
                        <h4><?php echo $mobil_name; ?></h4>
                    </div>

                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">
                    <div class="col-6">
                        <h5 class="font-weight-bold"> Rp <?php echo number_format($paket_price, 0, ",", "."); ?></h5>
                    </div>

                    <div class="col-6 text-right">
                        <span class="h6"> <i class="fas fa-check-circle text-success"></i> <?php echo number_format($order_point, 0, ",", "."); ?> </span> Point<br>

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
        <div class="col-md-7 mx-auto mb-5 pb-5">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    Form Pesanan
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

                    <?php echo form_open('daily/order',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <input type="hidden" name="mobil_name" value="<?php echo $mobil_name; ?>">
                    <input type="hidden" name="kota_id" value="<?php echo $kota_id; ?>">
                    <input type="hidden" name="kota_name" value="<?php echo $kota_name; ?>">
                    <input type="hidden" name="paket_name" value="<?php echo $paket_name; ?>">
                    <input type="hidden" name="start_price" value="<?php echo $paket_price; ?>">
                    <input type="hidden" name="order_point" value="<?php echo $order_point; ?>">
                    <input type="hidden" name="ketentuan_desc" value="<?php echo $ketentuan_desc; ?>">
                    <input type="hidden" name="paket_desc" value="<?php echo $paket_desc; ?>">
                    <input type="hidden" name="jumlah_mobil" value="1">

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
                            <select class="form-control" name="lama_sewa" id="lama_sewa" value="" onchange="total()" required>
                                <option value="">-- Lama Sewa --</option>
                                <option value='1'> 1 hari</option>
                                <option value='2'> 2 Hari</option>
                                <option value='3'> 3 Hari</option>
                                <option value='4'> 4 Hari</option>
                            </select>
                            <div class="invalid-feedback">Pilih Lama Sewa.</div>
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



                    <a class="btn btn-danger btn-block mb-3" data-toggle="collapse" href="#syaratKetentuan" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Syarat Ketentuan Sewa</a>

                    <div class="collapse multi-collapse" id="syaratKetentuan">
                        <div class="alert alert-danger">
                            <?php echo $ketentuan_desc; ?>
                        </div>
                    </div>

                    <a class="btn btn-warning btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Batas Penggunaan</a>

                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="alert alert-warning">
                            <?php echo $paket_desc; ?>
                        </div>
                    </div>




                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">
                        </label>
                        <div class="col-lg-8">
                            <div style="z-index: 9999;" class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow">
                                <button type="submit" name="submit" class="btn-order-block"> <i class="fa-solid fa-arrow-right"></i> Order Sekarang</button>
                            </div>
                            <!-- <button type="submit" class="btn btn-primary btn-block">Order Sekarang</button> -->
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