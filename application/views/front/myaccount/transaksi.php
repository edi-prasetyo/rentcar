<div class="container my-3">
    <div class="col-md-9 mx-auto">
        <div class="card">
            <div class="card-header">
                Transaksi Saya
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <?php $no = 1;
                    foreach ($transaksi_saya as $data) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data->order_id; ?></td>
                            <td><?php echo $data->order_type; ?></td>
                            <td>
                                <?php if ($data->status == 'Pending') : ?>
                                    <div class="badge badge-warning"> <?php echo $data->status; ?></div>
                                <?php elseif ($data->status == 'Dikonfirmasi') : ?>
                                    <div class="badge badge-info"> <?php echo $data->status; ?></div>
                                <?php else : ?>
                                    <div class="badge badge-success"> <?php echo $data->status; ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                Rp. <?php echo number_format($data->total_price, 0, ",", "."); ?>
                            </td>

                            <td>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('myaccount/detail_transaksi/' . md5($data->id)); ?>">Detail</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Cancel">
                                    Cancel
                                </button>
                            </td>
                        </tr>

                    <?php $no++;
                    }; ?>
                </table>
            </div>
            <div class="card-footer bg-white">
                <div class="pagination col-md-12 text-center">
                    <?php if (isset($pagination)) {
                        echo $pagination;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal modal-danger fade" id="Cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembatalan Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Silahkan Hubungi Customer Service untuk pengajuan pembatalan Order</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->