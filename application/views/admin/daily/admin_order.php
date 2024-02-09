<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>



<div class="col-md-10 mx-auto">
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
                    <?php echo $tanggal_sewa; ?>
                    <div class="row">
                        <div class="col-md-7">
                            <?php echo $kota_name; ?> - <?php echo $mobil_name; ?> - <?php echo $paket_name; ?> <br>

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

                    <?php echo form_open('admin/admindaily/order',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

                    <div class="row">

                        <input type="hidden" name="order_device" value="<?php echo $order_device; ?>">
                        <input type="hidden" name="mobil_name" value="<?php echo $mobil_name; ?>">
                        <input type="hidden" name="kota_id" value="<?php echo $kota_id; ?>">
                        <input type="hidden" name="kota_name" value="<?php echo $kota_name; ?>">
                        <input type="hidden" name="paket_name" value="<?php echo $paket_name; ?>">
                        <input type="hidden" name="order_point" value="<?php echo $order_point; ?>">
                        <input type="hidden" name="ketentuan_desc" value="<?php echo $ketentuan_desc; ?>">
                        <input type="hidden" name="paket_desc" value="<?php echo $paket_desc; ?>">

                        <!-- <input type="hidden" name="pembayaran" value="Transfer"> -->

                        <div class="form-group col-md-12">
                            <label class="form-label">Harga Sewa<span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="start_price" value="<?php echo $paket_price; ?>" required>
                            <div class="invalid-feedback">Harga Sewa harus di isi.</div>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Lama Sewa<span class="text-danger">*</span>
                            </label>
                            <div class="">
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
                            <label>Nama Lengkap<span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_name" placeholder="Nama Lengkap" required>
                            <div class="invalid-feedback">Nama Penumpang harus di isi.</div>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Email <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_email" placeholder="Email" required>
                            <div class="invalid-feedback">Email harus di isi.</div>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Nomor Whatsapp <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" name="passenger_phone" placeholder="No. Whatsapp" required>
                            <div class="invalid-feedback">Nomor Whatsapp harus di isi.</div>

                        </div>
                        <div class="form-group col-md-12">
                            <label>Alamat Penjemputan <span class="text-danger">*</span>
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

                        <div class="form-group col-md-12">
                            <label>Permintaan Khusus <span class="text-success">* Optional</span>
                            </label>
                            <input type="text" class="form-control" name="permintaan_khusus" placeholder="Permintaan Khusus" value="">
                        </div>

                        <div class="col-md-12">
                            <h4> Biaya Tambahan</h4>
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




                        <div class="col-lg-4">
                            <label style="visibility: hidden;">U</label>
                            <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-default">
                                Syarat Ketentuan
                            </button>
                        </div>
                        <div class="col-lg-4">
                            <label style="visibility: hidden;">U</label>
                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-default2">
                                Batas Wilayah
                            </button>
                        </div>

                        <div class="form-group col-md-12">

                            <button type="submit" class="btn btn-primary btn-block">Order Sekarang</button>

                        </div>

                    </div>
                    <?php echo form_close(); ?>

                </div>

            </div>
        </div>


    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Syarat ketentuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <?php echo $ketentuan_desc; ?>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Batas Wilayah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <?php echo $paket_desc; ?>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>