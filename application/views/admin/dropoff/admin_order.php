<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
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
                            <?php echo $kota_asal_name; ?> - <?php echo $kota_tujuan_name; ?> <?php echo $mobil_name; ?> <br>

                            <!-- <input type="text" name="grand_total" id="total" size="7" value="" readonly> -->

                            <!-- <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" value="1" onchange="total()"> -->
                        </div>
                        <div class="col-md-5 text-right">

                            <h3 class="font-weight-bold"> Rp <?php echo number_format($paket_price, 0, ",", "."); ?></h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Buat Pesanan
                </div>

                <div class="card-body">
                    <?php echo form_open('admin/admindropoff/order',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <input type="hidden" name="order_device" value="<?php echo $order_device; ?>">
                    <input type="hidden" name="mobil_name" value="<?php echo $mobil_name; ?>">
                    <input type="hidden" name="kota_name" value="<?php echo $kota_asal_name; ?> - <?php echo $kota_tujuan_name; ?>">

                    <input type="hidden" name="ketentuan_desc" value="<?php echo $ketentuan_desc; ?>">
                    <input type="hidden" name="paket_desc" value="<?php echo $paket_desc; ?>">
                    <input type="hidden" name="jumlah_mobil" value="1">
                    <!-- <input type="hidden" name="pembayaran" value="Transfer"> -->
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>Harga Paket<span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="start_price" value="<?php echo $paket_price; ?>" required>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Nama Lengkap<span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_name" placeholder="Nama Lengkap" required>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Email <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_email" placeholder="Email" required>
                            <div class="invalid-feedback">Email harus di isi.</div>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Nomor Handphone <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_phone" placeholder="Nomor Handphone" required>
                            <div class="invalid-feedback">Nomor Handphone harus di isi.</div>

                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-lg-4 col-form-label">Alamat Penjemputan <span class="text-danger">*</span>
                            </label>

                            <textarea class="form-control" name="alamat_jemput" placeholder="Alamat penjemputan" required></textarea>
                            <div class="invalid-feedback">Silahkan masukan Alamat Penjemputan.</div>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Tanggal Jemput <span class="text-danger">*</span></label>

                            <input type="text" name="tanggal_jemput" class="form-control" value="<?php echo $tanggal_sewa; ?>" readonly>
                            <div class="invalid-feedback">Tanggal Jemput harus di isi.</div>

                        </div>
                        <div class="form-group col-md-4">
                            <label>Jam Jemput <span class="text-danger">*</span></label>

                            <input type="text" name="jam_jemput" class="form-control" value="<?php echo $jam_sewa; ?>" readonly>
                            <div class="invalid-feedback">Jam Jemputharus di isi.</div>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Metode Pembayaran<span class="text-danger">*</span>
                            </label>

                            <select class="form-control" name="pembayaran" required>
                                <option value="">-- Pembayaran --</option>

                                <option value='Cash'> Cash</option>
                                <option value='Transfer'> Transfer</option>


                            </select>
                            <div class="invalid-feedback">Pilih Lama Sewa.</div>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Jumlah Mobil<span class="text-danger">*</span>
                            </label>
                            <div class="">
                                <select class="form-control" name="jumlah_mobil" required>
                                    <option value="">-- Jumlah Mobil --</option>
                                    <option value='1'> 1 </option>
                                    <option value='2'> 2 </option>
                                    <option value='3'> 3 </option>
                                    <option value='4'> 4 </option>
                                    <option value='5'> 5 </option>
                                    <option value='6'> 6 </option>
                                    <option value='7'> 7 </option>
                                    <option value='8'> 8 </option>
                                    <option value='9'> 9 </option>
                                    <option value='10'> 10 </option>
                                </select>
                                <div class="invalid-feedback">Pilih Jumlah Mobil.</div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Permintaan Khusus <span class="text-success">* Optional</span>
                            </label>

                            <input type="text" class="form-control" name="permintaan_khusus" placeholder="Permintaan Khusus" value="">


                        </div>


                        <div class="col-md-12 alert alert-success">

                            <h5> Biaya Tambahan <span class="text-warning"> ( Kosongkan jika tidak ada penambahan biaya) </span> </h5>

                        </div>

                        <div class="form-group col-md-4">
                            <label>BBM <span class="text-success">Optional</span>
                            </label>
                            <input type="text" class="form-control" name="fuel_money" placeholder="BBM">
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Uang Makan <span class="text-success">Optional</span>
                            </label>
                            <input type="text" class="form-control" name="meal_allowance" placeholder="uang makan">
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Uang Inap <span class="text-success">Optional</span>
                            </label>
                            <input type="text" class="form-control" name="accommodation_fee" placeholder="uang Inap">
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Uang DP <span class="text-success">Optional</span>
                            </label>
                            <input type="text" class="form-control" name="down_payment" placeholder="Dp">
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Diskon <span class="text-success">Optional</span>
                            </label>
                            <input type="text" class="form-control" name="promo_amount" placeholder="Promo">
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label> Syarat Ketentuan
                            </label>

                            <div class="alert alert-success">
                                <?php echo $ketentuan_desc; ?>
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label> Batas Wilayah
                            </label>

                            <?php echo $paket_desc; ?>

                        </div>
                        <div class="form-group col-md-12">

                            <button type="submit" class="btn btn-primary btn-block">Order Sekarang</button>

                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>