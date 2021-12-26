<div class="container my-3">
    <div class="col-md-7 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <div class="text-center">
                    <div style="font-size:20px"><i class="fa fa-ticket-alt"></i> Point Saya</div>
                    <div class="text-success" style="font-size:60px;font-weight:bold;"><?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Point
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Order ID</th>
                            <th>Point</th>
                            <th>Status</th>
                            <th>Tanggal Expired</th>
                        </tr>
                    </thead>
                    <?php $no = 1;
                    foreach ($point as $data) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data->order_id; ?></td>
                            <td><?php echo number_format($data->nominal_point, 0, ",", "."); ?></td>
                            <td>
                                <?php $tanggal_sekarang = date("Y-m-d"); ?>

                                <?php if ($data->expired <= $tanggal_sekarang) : ?>
                                    <div class="badge badge-danger">Expired</div>
                                <?php elseif ($data->point_status == 0) : ?>
                                    <div class="badge badge-danger">Used</div>
                                <?php else : ?>
                                    <div class="badge badge-success">Active</div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date("j F Y", strtotime($data->expired)); ?></td>
                        </tr>
                    <?php $no++;
                    }; ?>
                </table>
            </div>
        </div>
    </div>
</div>