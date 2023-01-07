<style>
    @media print {
        .noprint {
            display: none;
        }
    }
</style>

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
        <h4>Laporan</h4>
    </div>
    <div class="card-body">
        <div class="noprint">
            <?php echo form_open('admin/report'); ?>

            <div class="row">






                <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Awal:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#reservationdate" />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Akhir:</label>
                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                        <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#reservationdate2" />
                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="text-white">O</label>
                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                        <button type="submit" class="btn btn-primary btn-block">Lihat</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="text-white">O</label>
                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                        <a href="<?php echo base_url('admin/report/export'); ?>" type="submit" class="btn btn-success btn-block">Export Excel</a>
                    </div>
                </div>
            </div> -->










                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Awal:</label>

                        <input type="date" name="start_date" class="form-control datetimepicker-input" data-target="#" />

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Akhir:</label>

                        <input type="date" name="end_date" class="form-control datetimepicker-input" data-target="#" />

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="text-white">O</label>
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <button type="submit" class="btn btn-primary btn-block">Lihat</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="text-white">O</label>
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <!-- <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                        <input type="hidden" name="end_date" value="<?php echo $end_date; ?>"> -->
                            <a href="<?php echo base_url('admin/report/export/' . $start_date . '/' . $end_date); ?>" type="submit" class="btn btn-success btn-block"><i class="fa-regular fa-file-excel"></i> Export Excel</a>
                        </div>
                    </div>
                </div>

            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
    <?php if ($start_date == null && $end_date == null) : ?>
    <?php else : ?>
        <div class="col-md-12 mx-auto">
            <div class="alert alert-success"> Data Transaksi dari Tanggal <?php echo $start_date; ?> Sampai Tanggal <?php echo $end_date; ?></div>
        </div>
    <?php endif; ?>

    <?php if ($start_date == null && $end_date == null) : ?>

    <?php else : ?>

        <div id="printarea">
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead class="thead-white">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Order ID</th>
                            <th>Mobil</th>
                            <th>Tanggal Jemput</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Harga</th>

                        </tr>
                    </thead>
                    <?php $no = 1;
                    foreach ($transaksi as $transaksi) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?></td>
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

                        </tr>
                    <?php $no++;
                    }; ?>
                </table>
                <div class="noprint">
                    <div class="card-body">
                        <a href="javascript:;" onclick="window.print()" rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>