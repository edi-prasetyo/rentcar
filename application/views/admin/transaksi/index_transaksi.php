<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/transaksi'); ?>">Order Baru</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/proses'); ?>">Dalam Perjalanan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/selesai'); ?>">Selesai</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/batal'); ?>">Batal</a></li>
        </ul>
    </div>
    <div class="card-body">
        <!-- <div class="row">
            <div class="col-md-4">
                <?php echo form_open('admin/transaksi'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="order_id" class="form-control" placeholder="Masukan Order ID" value="<?php echo set_value('order_id'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div> -->
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th width="8%">Tgl Order</th>
                    <th> ID</th>
                    <th>Mobil</th>
                    <th>Device Type</th>
                    <th>Tanggal Jemput</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaksi as $transaksi) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td>
                        <?php echo date('d-m-Y', strtotime($transaksi->date_created)); ?><br>
                        <?php echo date('H:i', strtotime($transaksi->date_created)); ?> WIB
                    </td>

                    <td><?php echo $transaksi->order_id; ?></td>
                    <td><?php echo $transaksi->mobil_name; ?></td>
                    <td>
                        <?php if ($transaksi->user_id == 2) : ?>
                            <div class="badge badge-danger">User Admin</div>
                        <?php elseif ($transaksi->user_id == null) : ?>
                            <div class="badge badge-warning">User Unregistered</div>
                        <?php else : ?>
                            <div class="badge badge-success">User Registered</div>
                        <?php endif; ?>
                        <br>
                        <?php if ($transaksi->order_device == null) : ?>
                            <div class="badge badge-info">Order aplikasi</div>
                        <?php elseif ($transaksi->order_device == 1) : ?>
                            <div class="badge badge-warning">Order Web Desktop</div>
                        <?php elseif ($transaksi->order_device == 2) : ?>
                            <div class="badge badge-primary">Order Web Mobile</div>
                        <?php else : ?>
                            <div class="badge badge-danger">Order Marketing</div>
                        <?php endif; ?>

                    </td>
                    <td><?php echo $transaksi->tanggal_jemput; ?>
                        <?php if ($transaksi->status_read == 0) : ?>
                            <span class="right badge badge-danger">New Order</span>
                        <?php else : ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $transaksi->passenger_name; ?> </td>
                    <td><?php echo $transaksi->order_type; ?> </td>
                    <td>
                        <?php echo $transaksi->pembayaran; ?><br>
                        <?php if ($transaksi->status_pembayaran == "Lunas") : ?>
                            <div class="badge badge-success">Paid</div>
                        <?php else : ?>
                            <div class="badge badge-danger">Unpaid</div>
                        <?php endif; ?>

                    </td>
                    <td>
                        <?php if ($transaksi->stage == 1) : ?>
                            <div class="badge badge-warning">Pending</div>
                        <?php elseif ($transaksi->stage == 2) : ?>
                            <div class="badge badge-info">Konfirmasi Driver</div>
                        <?php elseif ($transaksi->stage == 3) : ?>
                            <div class="badge badge-primary">Dalam Pengantaran</div>
                        <?php elseif ($transaksi->stage == 4) : ?>
                            <div class="badge badge-success">Selesai</div>
                        <?php elseif ($transaksi->stage == 5) : ?>
                            <div class="badge badge-danger">Ditolak Driver</div>
                        <?php else : ?>
                        <?php endif; ?>
                    </td>

                    <td>Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></td>
                    <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                    <td>
                        <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>

                        <?php include "cancel.php";
                        ?>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>
    </div>
    <div class="card-footer bg-white border-top">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>