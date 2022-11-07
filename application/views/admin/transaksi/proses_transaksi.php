<div class="card">
    <div class="card-header">

        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link " href="<?php echo base_url('admin/transaksi'); ?>">Order Baru</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/transaksi/proses'); ?>">Dalam Perjalanan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/selesai'); ?>">Selesai</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/batal'); ?>">Batal</a></li> -->
        </ul>
    </div>

    <div class="card-body">

    </div>


    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Mobil</th>
                    <th>Tanggal Jemput</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaksi as $transaksi) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $transaksi->order_id; ?></td>
                    <td><?php echo $transaksi->mobil_name; ?></td>
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

                    <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
                    <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                    <td>
                        <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Cancel
                        </a>
                        <?php //include "cancel.php"; 
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