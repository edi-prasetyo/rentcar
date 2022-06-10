<?php $meta = $this->meta_model->get_meta(); ?>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> <?php echo $meta->title; ?>
                    <small class="float-right">INVOICE</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong><?php echo $meta->title; ?></strong><br>
                    <?php echo $meta->alamat; ?><br>
                    Phone: <?php echo $meta->telepon; ?><br>
                    Email: <?php echo $meta->email; ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong><?php echo $transaksi->passenger_name; ?></strong><br>
                    <?php echo $transaksi->alamat_jemput; ?><br>
                    Phone: <?php echo $transaksi->passenger_phone; ?><br>
                    Email: <?php echo $transaksi->passenger_email; ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Order ID:</b> <?php echo $transaksi->order_id; ?><br>
                <b>Tangga Jemput :</b> <?php echo $transaksi->tanggal_jemput; ?><br>
                <b>Jam Jemput :</b> <?php echo $transaksi->jam_jemput; ?><br>
                <b>Pembayaran :</b> <?php echo $transaksi->pembayaran; ?><br>
                <?php if ($transaksi->driver_id == 0) : ?>
                <?php else : ?>
                    <b>Driver :</b> <?php echo $transaksi->driver_name; ?><br>
                <?php endif; ?>
                <b>Status Pembayaran :</b> <?php echo $transaksi->status_pembayaran; ?><br>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Lama Sewa</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $transaksi->mobil_name; ?> <br>
                                <?php if ($transaksi->product_id == 1) : ?>
                                    <?php echo $transaksi->paket_name; ?> - <?php echo $transaksi->kota_name; ?>
                                <?php elseif ($transaksi->product_id == 2) : ?>
                                    <?php echo $transaksi->origin; ?> - <?php echo $transaksi->destination; ?>
                                <?php elseif ($transaksi->product_id == 3) : ?>
                                    <?php echo $transaksi->origin; ?> - <?php echo $transaksi->destination; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $transaksi->lama_sewa; ?> Hari<br>


                            </td>
                            <td>Rp. <?php echo number_format($transaksi->start_price, 0, ",", "."); ?></td>
                            <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <b>Rekening Pembayaran:</b><br>
                <?php foreach ($bank as $bank) : ?>
                    <?php echo $bank->bank_name; ?> <?php echo $bank->bank_number; ?> A/n <?php echo $bank->bank_account; ?>
                <?php endforeach; ?><br>
                <b>Syarat dan Ketentuan:</b><br>
                <?php echo $transaksi->ketentuan_desc; ?>
            </div>
            <!-- /.col -->
            <div class="col-6">


                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Point</th>
                            <td>-<?php echo number_format($transaksi->diskon_point, 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Diskon</th>
                            <td>Rp. <?php echo number_format($transaksi->promo, 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-12">
                <a href="<?php echo base_url('admin/transaksi/invoice/' . $transaksi->id); ?>" rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print Invoice</a>
                <?php if ($transaksi->driver_id == 0) : ?>
                    <a href="<?php echo base_url('admin/transaksi/pilih_driver/' . $transaksi->id); ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-user"></i> Pilih Driver
                    </a>
                <?php else : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if ($transaksi->driver_id == 0) : ?>
<?php else : ?>
    <div class="card">
        <div class="card-header">Info Driver</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">Nomor Hp</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $transaksi_driver->name; ?></td>
                        <td><?php echo $transaksi_driver->user_phone; ?></td>
                        <td><?php echo $transaksi->status; ?></td>
                        <td>
                            <?php if ($transaksi->status == "Selesai") : ?>
                            <?php else : ?>
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/transaksi/finish/' . $transaksi->id); ?>">Selesaikan Order</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>